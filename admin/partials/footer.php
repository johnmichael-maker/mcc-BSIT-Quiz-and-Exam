<?php
  // Start the session at the beginning
  session_start(); 

  if (isset($_GET['logout'])) {

    // Destroy the session and log out
    $this->sessionDestroy(); // If this method handles session destruction

    // Alternatively, you can destroy the session directly
    // session_unset();  // Clears all session variables
    // session_destroy();  // Destroys the session

    // Trigger the JavaScript logout success message and page refresh
    echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Logged out successfully',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = '../index'; // Redirect to homepage or login page after logout
        });
    </script>";
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
