<?php 

$db = new PDO('mysql:host=localhost;dbname=mcc_bsit_quiz_and_exam', 'root', ''); 

// Function to retrieve instructors
function getInstructors($db) {
    $stmt = $db->prepare("SELECT * FROM instructors");
    $stmt->execute();
    return $stmt;
}

require __DIR__ . '/./partials/header.php'; ?>

<div class="container-fluid">
    <div class="row">

        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0 overflow-y-auto" style="max-height: 100vh;">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


            <div class="w-100 p-3">
                <div class="row g-3">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">
                                <h5><i class="bx bx-user"></i> Instructors</h5>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="instructorTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            try {
                                                // Assuming $db is your PDO connection
                                                $instructors = getInstructors($db); // Fetch instructors

                                                if ($instructors) {
                                                    // Loop through the result set and display each row
                                                    while ($row = $instructors->fetch()): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['id']) ?></td>
                                                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                                                            <td><?= htmlspecialchars($row['middle_name']) ?></td>
                                                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                                                            <td><?= htmlspecialchars($row['email']) ?></td>
                                                            <td><?= htmlspecialchars($row['phone']) ?></td>
                                                            <td><?= htmlspecialchars($row['address']) ?></td>
                                                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                                                        </tr>
                                                    <?php endwhile;
                                                } else {
                                                    echo "<tr><td colspan='8'>No instructors found.</td></tr>";
                                                }
                                            } catch (Exception $e) {
                                                echo "<tr><td colspan='8'>Error: " . $e->getMessage() . "</td></tr>";
                                            }
                                            ?>
                                        </tbody>

                                    </table>

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

<script>
    $(document).ready(function(){
        $("#instructorTable").DataTable({
            "pageLength": 10,    // Display 10 records per page
            "order": [[0, "asc"]],  // Order by the first column (ID) in ascending order
            "lengthMenu": [5, 10, 20, 50],  // Pagination options
            "language": {
                "emptyTable": "No instructors available"
            }
        });
    });
</script>
