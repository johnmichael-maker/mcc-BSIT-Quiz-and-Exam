<?php
// Assuming you're already connected to the database and $ip_address is set
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get IP address (for testing, it could be localhost)
$ip_address = $_SERVER['REMOTE_ADDR'];  // This gets the IP address of the user

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
    </style>
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

    
    <!-- Check if valid latitude and longitude are available before embedding the map -->
    <?php if ($latitude && $longitude): ?>
        <div id="map"></div>
        <script>
            // Initialize the Google Map
            function initMap() {
                var location = { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> };
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: location
                });

                // Add a marker at the location
                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    title: 'IP Location'
                });
            }
        </script>
    <?php else: ?>
        
    <?php endif; ?>

    <script>
        // Function to get the current geolocation using JavaScript
        function getGeolocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    
                    // Fill the latitude and longitude in the textboxes
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;

                    // Optional: You can also display the map using these coordinates
                    var location = { lat: latitude, lng: longitude };
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 10,
                        center: location
                    });
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map,
                        title: 'Your Current Location'
                    });
                }, function(error) {
                    alert('Geolocation error: ' + error.message);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        // Call the geolocation function on page load
        window.onload = getGeolocation;
    </script>

    <?php require __DIR__ . '/./partials/footer.php'; ?>

</body>
</html>
