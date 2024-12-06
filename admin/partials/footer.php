<?php
  if (isset($_GET['logout'])) {


    // Destroy the session and log out
    session_start();
    session_destroy();

    // Trigger the JavaScript logout success message and page refresh
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
