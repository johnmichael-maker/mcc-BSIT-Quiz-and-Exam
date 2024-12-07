<?php
// Assuming you're already connected to the database
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get the real IP address
function getUserIpAddress() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_addresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ip_addresses[0]);
    } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Function to detect device type based on User-Agent
function getDeviceInfo() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/mobile/i', $userAgent)) {
        return 'Mobile';
    } elseif (preg_match('/tablet/i', $userAgent)) {
        return 'Tablet';
    } elseif (preg_match('/(windows|mac|linux)/i', $userAgent)) {
        return 'Desktop';
    } else {
        return 'Unknown';
    }
}

// Get the IP address of the user
$ip_address = getUserIpAddress();

// Get the device info
$device_info = getDeviceInfo();

// Prepare the SQL statement to fetch all login attempts
$stmt = $conn->prepare("SELECT * FROM login_attempts");
$stmt->execute();

// Fetch all results
$result = $stmt->get_result();

// Store or update the device information for the current IP address
$stmt_check = $conn->prepare("SELECT * FROM login_attempts WHERE ip_address = ?");
$stmt_check->bind_param("s", $ip_address);
$stmt_check->execute();
$attempts_data = $stmt_check->get_result()->fetch_assoc();

if ($attempts_data) {
    // Update the device info if already exists
    $updateStmt = $conn->prepare("UPDATE login_attempts SET device_info = ? WHERE ip_address = ?");
    $updateStmt->bind_param("ss", $device_info, $ip_address);
    $updateStmt->execute();
} else {
    // Insert a new record if it doesn't exist
    $insertStmt = $conn->prepare("INSERT INTO login_attempts (ip_address, device_info) VALUES (?, ?)");
    $insertStmt->bind_param("ss", $ip_address, $device_info);
    $insertStmt->execute();
}
?>

<?php require __DIR__ . '/./partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Attempts</title>

    <style>
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
            width: 100%;
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

        .status-blocked {
            color: #e74c3c;
            font-weight: bold;
        }

        .status-not-blocked {
            color: #2ecc71;
            font-weight: bold;
        }

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

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            table {
                width: 100%;
                font-size: 12px;
            }

            table th, table td {
                padding: 8px;
            }

            .geolocation-box {
                width: 100%;
            }

            .locate-button {
                width: 100%;
                margin-top: 10px;
            }
        }
        
        /* For smaller devices */
        @media screen and (max-width: 480px) {
            h1, h2 {
                font-size: 18px;
            }

            .status-blocked,
            .status-not-blocked {
                font-size: 14px;
            }
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php require __DIR__ . '/partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0 overflow-y-auto" style="max-height: 100vh;">
            <?php require __DIR__ . '/partials/navbar.php'; ?>

            <div class="w-100 p-3">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 style="text-align: center;">Login Attempt Details</h3>

                                <table>
                                    <thead>
                                        <tr>
                                            <th>IP Address</th>
                                            <th>Attempts</th>
                                            <th>Last Attempt</th>
                                            <th>Status</th>
                                            <th>Device</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($attempts_data = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($attempts_data['ip_address']); ?></td>
                                                <td><?php echo htmlspecialchars($attempts_data['attempts']); ?></td>
                                                <td><?php echo htmlspecialchars($attempts_data['last_attempt']); ?></td>
                                                <td>
                                                    <?php 
                                                    $attempt_limit = 3;
                                                    $time_limit = 1200;  
                                                    $blocked_until = strtotime($attempts_data['blocked_until']);

                                                    if ($attempts_data['attempts'] >= $attempt_limit && $blocked_until > time()) {
                                                        echo "<span class='status-blocked'>Blocked</span>";
                                                    } elseif ($blocked_until && $blocked_until <= time()) {
                                                        echo "<span class='status-not-blocked'>Not Blocked</span>";
                                                    } else {
                                                        echo "<span class='status-not-blocked'>Not Blocked</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($attempts_data['device_info']); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>

                                <?php if ($latitude && $longitude): ?>
                                    <button class="locate-button" onclick="showMap()">View Location on Map</button>
                                <?php endif; ?>

                                <!-- OpenStreetMap Div -->
                                <div id="map"></div>

                                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                                <script>
                                    function showMap() {
                                        var latitude = <?php echo $latitude ? $latitude : 'null'; ?>;
                                        var longitude = <?php echo $longitude ? $longitude : 'null'; ?>;

                                        if (latitude && longitude) {
                                            var map = L.map('map').setView([latitude, longitude], 13);

                                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                            }).addTo(map);

                                            L.marker([latitude, longitude]).addTo(map)
                                                .bindPopup('IP Location')
                                                .openPopup();

                                            document.getElementById('map').style.display = 'block';
                                        } else {
                                            alert('Geolocation data is not available for this IP address.');
                                        }
                                    }
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/./partials/footer.php'; ?>

</body>
</html>
