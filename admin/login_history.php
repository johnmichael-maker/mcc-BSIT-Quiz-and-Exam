<?php
// Assuming you're already connected to the database
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the number of records per page
$records_per_page = 10;

// Get the current page number from the URL, default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;

// Prepare the SQL statement to fetch login history records with LIMIT and OFFSET for pagination
$stmt = $conn->prepare("SELECT * FROM login_history ORDER BY attempt_time DESC LIMIT ?, ?");
$stmt->bind_param("ii", $start_from, $records_per_page);
$stmt->execute();

// Fetch all results
$result = $stmt->get_result();

// Prepare SQL to get the total number of records
$stmt_count = $conn->prepare("SELECT COUNT(*) FROM login_history");
$stmt_count->execute();
$total_results = $stmt_count->get_result()->fetch_row()[0];

// Calculate the total number of pages
$total_pages = ceil($total_results / $records_per_page);
?>

<?php require __DIR__ . '/./partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login History</title>

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

        .status-blocked {
            color: #e74c3c;
            font-weight: bold;
        }

        .status-not-blocked {
            color: #2ecc71;
            font-weight: bold;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #3498db;
            padding: 8px 16px;
            margin: 0 5px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #3498db;
            color: white;
        }

        .pagination .disabled {
            color: #ccc;
            pointer-events: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }

            table th, table td {
                padding: 8px;
                font-size: 14px;
            }

            .pagination a {
                padding: 6px 12px;
                font-size: 14px;
            }
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
                                <h3 style="text-align: center;">Login History</h3>

                                <table>
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Reason</th>
                                            <th>Attempt Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($history_data = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($history_data['username']); ?></td>
                                                <td>
                                                    <?php 
                                                    if ($history_data['status'] == 'failure') {
                                                        echo "<span class='status-blocked'>Failed</span>";
                                                    } else {
                                                        echo "<span class='status-not-blocked'>Success</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($history_data['reason']); ?></td>
                                                <td><?php echo htmlspecialchars($history_data['attempt_time']); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>

                                <!-- Pagination Controls -->
                                <div class="pagination">
                                    <?php if ($page > 1): ?>
                                        <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                                    <?php else: ?>
                                        <span class="disabled">Previous</span>
                                    <?php endif; ?>

                                    <?php 
                                    for ($i = 1; $i <= $total_pages; $i++): 
                                        if ($i == $page): ?>
                                            <span class="disabled"><?php echo $i; ?></span>
                                        <?php else: ?>
                                            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        <?php endif; 
                                    endfor;
                                    ?>

                                    <?php if ($page < $total_pages): ?>
                                        <a href="?page=<?php echo $page + 1; ?>">Next</a>
                                    <?php else: ?>
                                        <span class="disabled">Next</span>
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
