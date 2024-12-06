<?php
// Assuming you're already connected to the database
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get the real IP address
function getUserIpAddress() {
    // Check for the real IP from various headers
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // If there are multiple IPs, the first one is usually the real IP
        $ip_addresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ip_addresses[0]); // Take the first IP address
    } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // If the client IP is available, use it
        return $_SERVER['HTTP_CLIENT_IP'];
    } else {
        // If none of the above headers are found, fallback to REMOTE_ADDR
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Get the IP address of the user
$ip_address = getUserIpAddress();

// Prepare the SQL statement with a placeholder for IP address
$stmt = $conn->prepare("SELECT * FROM login_attempts WHERE ip_address = ?");
$stmt->bind_param("s", $ip_address);  // "s" means the parameter is a string
$stmt->execute();

// Fetch the result
$result = $stmt->get_result();
$attempts_data = $result->fetch_assoc();

// Check if the IP address is localhost (loopback) and skip geolocation
if ($ip_address === '127.0.0.1' || $ip_address === '::1') {
    $latitude = null;
    $longitude = null;
} else {
    $latitude = $attempts_data['latitude'] ?? null;
    $longitude = $attempts_data['longitude'] ?? null;
}
?>
<?php require __DIR__ . '/./partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Attempts</title>
    <link rel="stylesheet" href="styles.css"> <!-- External CSS -->

    <style>
        /* Body and general styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1, h2 {
            text-align: center;
            color: #2c3e50;
            padding-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #e6f7ff;
        }

        #map {
            width: 100%;
            height: 400px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: none;
        }

        p {
            text-align: center;
            font-size: 16px;
        }

        /* Status message styles */
        .status-blocked {
            color: #e74c3c;
            font-weight: bold;
        }

        .status-not-blocked {
            color: #2ecc71;
            font-weight: bold;
        }

        /* Textbox styling */
        .geolocation-box {
            display: inline-block;
            width: 45%;
            margin: 10px;
        }

        .geolocation-box input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        /* Button styling */
        .locate-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        .locate-button:hover {
            background-color: #2980b9;
        }
    </style>

    <!-- Include Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

</head>
<body>

    <h1>Login Attempt Details</h1>
    
    <?php if ($attempts_data): ?>
        <table>
            <thead>
                <tr>
                    <th>IP Address</th>
                    <th>Attempts</th>
                    <th>Last Attempt</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($attempts_data['ip_address']); ?></td>
                    <td><?php echo htmlspecialchars($attempts_data['attempts']); ?></td>
                    <td><?php echo htmlspecialchars($attempts_data['last_attempt']); ?></td>
                    <td>
                        <?php 
                        // Check if the IP is blocked
                        $attempt_limit = 3;
                        $time_limit = 1200;  // 20 minutes
                        $blocked_until = strtotime($attempts_data['blocked_until']); // Convert to timestamp

                        if ($attempts_data['attempts'] >= $attempt_limit && $blocked_until > time()) {
                            echo "<span class='status-blocked'>Blocked (Exceeded 3 failed attempts)</span>";
                        } elseif ($blocked_until && $blocked_until <= time()) {
                            // Reset blocked status if the time has passed
                            echo "<span class='status-not-blocked'>Not Blocked</span>";
                        } else {
                            echo "<span class='status-not-blocked'>Not Blocked</span>";
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>No login attempt data found for the given IP address.</p>
    <?php endif; ?>

    <!-- Button to show location on map -->
    <?php if ($latitude && $longitude): ?>
        <button class="locate-button" onclick="showMap()">View Location on Map</button>
    <?php else: ?>
        <p>No geolocation data available for this IP.</p>
    <?php endif; ?>

    <!-- OpenStreetMap Div -->
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <script>
        // Function to show the map when button is clicked
        function showMap() {
            var latitude = <?php echo $latitude ? $latitude : 'null'; ?>;
            var longitude = <?php echo $longitude ? $longitude : 'null'; ?>;

            if (latitude && longitude) {
                var map = L.map('map').setView([latitude, longitude], 13);

                // Add OpenStreetMap tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Add marker at the provided latitude and longitude
                L.marker([latitude, longitude]).addTo(map)
                    .bindPopup('IP Location')
                    .openPopup();

                // Show the map div
                document.getElementById('map').style.display = 'block';
            } else {
                alert('Geolocation data is not available for this IP address.');
            }
        }
    </script>

    <?php require __DIR__ . '/./partials/footer.php'; ?>

</body>
</html>
