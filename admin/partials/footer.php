<?php
  // Logout logic: check for `logout` parameter in the URL
  if (isset($_GET['logout'])) {
    session_start();  // Ensure the session is started before calling session_destroy()
    session_destroy();  // Destroy the session data

    // Redirect to a login page or index.php after session destruction
    header("Location: ../index.php");  // Change this to your login page if needed
    exit();
  }
?>

<!-- HTML and SweetAlert logic for displaying a success message on logout -->
<?php if (isset($_GET['logout'])): ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Logged out successfully',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = "../index.php";  // Redirect to the home or login page
        });
    </script>
<?php endif; ?>

<!-- Footer and other scripts -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/dataTable.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/admin.js"></script>

<script>
    $(document).ready(function(){
        $("#dataTable").DataTable();
    });
</script>

</body>
</html>
