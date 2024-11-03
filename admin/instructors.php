<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=u510162695_bsit_quiz', 'u510162695_bsit_quiz', '1Bsit_quiz');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    function getAdminsTypeTwo($db) {
        try {
            $stmt = $db->prepare("SELECT admin_id, username, email, created_at FROM admin WHERE userType = 2");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return []; 
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_id'])) {
        $admin_id = $_POST['admin_id'];

       
        $db->beginTransaction();
        try {
            
            $stmt = $db->prepare("SELECT email FROM admin WHERE admin_id = :admin_id AND userType = 2");
            $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
            $stmt->execute();
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin) {
                $email = $admin['email'];

                
                $stmt = $db->prepare("DELETE FROM admin WHERE admin_id = :admin_id");
                $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
                $stmt->execute();

               
                $stmt = $db->prepare("DELETE FROM instructors WHERE email = :email");
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();

                
                $db->commit();
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Admin not found.']);
            }
        } catch (PDOException $e) {
            $db->rollBack(); 
            echo json_encode(['status' => 'error', 'message' => 'Error during deletion: ' . $e->getMessage()]);
        }
        exit; 
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit; 
}

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
                                <h5><i class="bx bx-user"></i> Admins (User Type 2)</h5>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="adminTypeTwoTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $admins = getAdminsTypeTwo($db);
                                            if ($admins) {
                                                foreach ($admins as $row): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($row['admin_id']) ?></td>
                                                        <td><?= htmlspecialchars($row['username']) ?></td>
                                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= htmlspecialchars($row['admin_id']) ?>)">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;
                                            } else {
                                                echo "<tr><td colspan='8'>No admins found.</td></tr>";
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

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $("#adminTypeTwoTable").DataTable({
        "pageLength": 10,
        "order": [[0, "asc"]],
        "lengthMenu": [5, 10, 20, 50],
        "language": {
            "emptyTable": "No admins available"
        },
        "autoWidth": false 
    });
});

function confirmDelete(adminId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'delete_admin.php', 
                type: 'POST',
                data: { admin_id: adminId },
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        Swal.fire(
                            'Deleted!',
                            'The admin has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            res.message || 'There was a problem deleting the admin.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'There was a problem deleting the admin.',
                        'error'
                    );
                }
            });
        }
    });
}
</script>

<?php require __DIR__ . '/partials/footer.php'; ?>
