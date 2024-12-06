<?php
if (isset($_GET['logout'])) {
    session_start();
    
    // Destroy the session
    session_unset(); // Unsets all session variables
    session_destroy(); // Destroys the session
    
    // Optionally, you can clear session cookies too, for more security
    setcookie(session_name(), '', time() - 3600, '/');
    
    // Redirect after logout
    echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Logged out successfully',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = '../index'; 
        });
    </script>";
    exit(); // Make sure the script stops executing after the redirect
}
?>


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
