<?php
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Pagination settings
$perPage = 10; // Number of logs per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startFrom = ($page - 1) * $perPage;

// SQL query for activity logs with pagination
$sql = "SELECT * FROM activity_logs ORDER BY timestamp DESC LIMIT $startFrom, $perPage";
$result = $conn->query($sql);

// Fetch all activity logs
if ($result->num_rows > 0) {
    $activityLogs = [];
    while ($row = $result->fetch_assoc()) {
        $activityLogs[] = $row;
    }
} else {
    $activityLogs = [];
}

// Get total number of activity logs for pagination
$sqlTotal = "SELECT COUNT(*) as total FROM activity_logs";
$totalResult = $conn->query($sqlTotal);
$totalRow = $totalResult->fetch_assoc();
$totalLogs = $totalRow['total'];
$totalPages = ceil($totalLogs / $perPage);
?>

<?php require __DIR__ . '/partials/header.php'; ?>

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
                                <h5><i class="bx bx-user"></i> Activity Logs</h5>
                            </div>

                            <div class="card-body">
                                <!-- Search Input for Admin Name -->
                                <div class="mb-3">
                                    <label for="searchInput" class="form-label">Search</label>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search Instructor Name">
                                </div>

                                <div class="table-responsive">
                                    <table id="adminTypeTwoTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Instructor Name</th>
                                                <th>Action</th>
                                                <th>Action Details</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody id="logTableBody">
                                            <?php
                                            if (!empty($activityLogs)) {
                                                foreach ($activityLogs as $log) {
                                                    // Fetch admin details from the database
                                                    $admin_id = $log['admin_id'];
                                                    $adminResult = $conn->query("SELECT firstName, middleName, lastName FROM admin WHERE admin_id = $admin_id");
                                                    $admin = $adminResult->fetch_assoc();

                                                    $fullName = $admin['firstName'] . ' ' . $admin['middleName'] . ' ' . $admin['lastName'];

                                                    // Display log data in table rows
                                                    echo "<tr class='logRow'>
                                                            <td>{$fullName}</td>
                                                            <td>{$log['action']}</td>
                                                            <td>{$log['action_details']}</td>
                                                            <td class='timestamp'>{$log['timestamp']}</td>
                                                          </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>No activity logs found.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="pagination">
                                    <ul class="pagination">
                                        <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                                        </li>

                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?= $page == $i ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Print Button -->
                                 <!-- Print Button -->
                                 <div class="mt-3">
                                    <button onclick="printTable()" class="btn btn-danger">Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to filter table based on admin name -->
<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        var filter = this.value.toLowerCase();
        var rows = document.querySelectorAll('#logTableBody .logRow');
        rows.forEach(function(row) {
            var adminName = row.cells[0].textContent.toLowerCase();
            if (adminName.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

     // Function to print only the table
     function printTable() {
        var printWindow = window.open('', '', 'height=600,width=800');
        var tableContent = document.getElementById('adminTypeTwoTable').outerHTML;

        printWindow.document.write('<html><head><title>Print Activity Logs</title>');
        printWindow.document.write('<style>body {font-family: Arial, sans-serif;} table {width: 100%; border-collapse: collapse;} th, td {border: 1px solid #000; padding: 8px; text-align: left;} th {background-color: #f2f2f2;} </style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h2>Activity Logs</h2>');
        printWindow.document.write(tableContent);
        printWindow.document.write('</body></html>');

        printWindow.document.close(); // Necessary for IE
        printWindow.print();
    }
    
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<?php require __DIR__ . '/./partials/footer.php' ?>
</body>
</html>
