<?php

$servername = "localhost";
$username = "u510162695_bsit_quiz";  
$password = "1Bsit_quiz";     
$dbname = "u510162695_bsit_quiz"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, first_name, last_name FROM instructors WHERE status = 'pending'";
$result = $conn->query($sql);

$pendingUsers = [];
$pendingCount = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pendingUsers[] = $row;
    }
    $pendingCount = count($pendingUsers);
}


?>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm dont-print" style="z-index: 1 !important;">
    <div class="container">

        <button class="navbar-toggler d-lg-none d-lg-block" id="sidebar-toggler">
            <i class="navbar-toggler-icon"></i>
        </button>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <img src="<?= htmlspecialchars($_SESSION['AUTH_IMG']) ?>" alt="image" style="width: 40px;" class="border rounded-circle py-1">
                    <?= htmlspecialchars($_SESSION['AUTH_KEY']) ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-item">
                        <a href="#" class="text-decoration-none text-dark" onclick="showDetails('John Michaelle Robles', 'North', 'johnmichaellerobles@gmail.com', '2024', 'Full Stack Developer');" data-bs-toggle="modal" data-bs-target="#developerModal">
                            <i class="bx bx-info-circle"></i> Developer Info
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="#" onclick="return showLogout()" class="text-decoration-none text-dark">
                            <i class="bx bx-log-out"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Notification Icon for Admin -->
            <?php if (isset($_SESSION['AUTH_UTYPE']) && $_SESSION['AUTH_UTYPE'] != 2): ?>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" data-bs-toggle="dropdown">
                    <i class="bx bx-bell"></i>
                    <span class="badge bg-danger" id="pending-count"><?= htmlspecialchars($pendingCount) ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <?php foreach ($pendingUsers as $user) : ?>
                        <li class="dropdown-item">
                            <p><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?> has registered</p>
                            <button class="btn btn-success" onclick="approveUser(<?= $user['id'] ?>)">Approve</button>
                            <button class="btn btn-danger" onclick="rejectUser(<?= $user['id'] ?>)">Reject</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="modal fade" id="developerModal" tabindex="-1" aria-labelledby="developerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="developerModalLabel">Developer Details:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Capstone project</h5>
                <p><strong>Name:</strong> John Michaelle Robles</p>
                <p><strong>Email:</strong> Johnmichaellerobles@gmail.com</p>
                <p><strong>Contact no:</strong> 09309333290</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Sidebar toggle functionality
    document.getElementById('sidebar-toggler').onclick = () => {
        document.getElementById('menu').classList.toggle('d-none');
    }

   
    function showLogout() {
        Swal.fire({
            title: "<strong>Are you sure you want to logout?</strong>",
            icon: "info",
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Yes',
            confirmButtonColor: "#d93645",
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "?logout";
            }
        });
    }

  
    function approveUser(userId) {
        $.ajax({
            url: 'approve_user.php',
            method: 'POST',
            data: { id: userId, action: 'approve' },
            success: function(response) {
                Swal.fire('Approved', 'The user has been approved.', 'success');
                location.reload(); 
            }
        });
    }

    
    function rejectUser(userId) {
        if (confirm("Are you sure you want to reject this user?")) {
            $.ajax({
                url: 'approve_user.php',
                method: 'POST',
                data: { id: userId, action: 'reject' },
                success: function(response) {
                    Swal.fire('Rejected', 'The user has been rejected.', 'error');
                    location.reload();
                }
            });
        }
    }
</script>
