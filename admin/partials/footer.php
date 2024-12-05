<?php
// Logout logic: check if 'logout' parameter is set
if (isset($_GET['logout'])) {
    // Destroy the session
    session_start(); // Ensure session is started before destroying
    session_unset(); // Clear all session variables
    session_destroy(); // Destroy the session completely
    ?>

    <script>
        // Show a success message and redirect after logout
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Logged out successfully",
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            // Redirect to the homepage or any other page after logout
            window.location.href = "../index.php";
        });
    </script>

<?php
}
?>

<!-- Other scripts and page content -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/dataTable.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/admin.js"></script>

<script>
    $(document).ready(function(){
        // Initialize DataTable
        $("#dataTable").DataTable();
    });
</script>
</body>

</html>
