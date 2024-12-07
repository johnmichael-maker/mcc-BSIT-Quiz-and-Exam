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

// Pagination settings
$limit = 10;  // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Get the current page from URL, default to 1
$offset = ($page - 1) * $limit;  // Calculate the OFFSET for SQL query

// Get the total number of records
$total_results_query = "SELECT COUNT(*) AS total FROM login_attempts";
$total_results = $conn->query($total_results_query);
$total_results = $total_results->fetch_assoc()['total'];

// Calculate the total number of pages
$total_pages = ceil($total_results / $limit);

// Prepare the SQL statement to fetch login attempts for the current page
$stmt = $conn->prepare("SELECT * FROM login_attempts LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();

// Fetch the results
$result = $stmt->get_result();
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

        /* Pagination Styles */
        .pagination {
            text-align: center;
            padding: 10px;
        }

        .pagination a {
            padding: 8px 12px;
            margin: 0 4px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #2980b9;
        }

        .pagination .active {
            background-color: #2980b9;
            font-weight: bold;
        }

        #map {
            width: 100%;
            height: 400px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: none;
        }

    </style>

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

                                <!-- Pagination Links -->
                                <div class="pagination">
                                    <?php if ($page > 1): ?>
                                        <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                    <?php endfor; ?>

                                    <?php if ($page < $total_pages): ?>
                                        <a href="?page=<?php echo $page + 1; ?>">Next</a>
                                    <?php endif; ?>
                                </div>

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
