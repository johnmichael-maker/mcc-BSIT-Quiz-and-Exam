<?php
session_start();

if (isset($_GET['logout'])) {
    // Get the user ID or some unique identifier for the user
    $user_id = $_SESSION['admin_id']; // Assuming the user ID is stored in session

    // Path where session files are stored (this could be any directory)
    $session_dir = __DIR__ . '/app/Sessions';

    // Get the list of all files in the session directory
    $session_files = glob($session_dir . "*.sess");

    // Loop through the session files and delete the ones matching the user's session ID
    foreach ($session_files as $file) {
        // Read the session data from the file to check if it belongs to this user
        $session_data = file_get_contents($file);
        
        if (strpos($session_data, "admin_id|s:" . strlen($user_id) . ":\"$user_id\"") !== false) {
            // Delete the session file if it belongs to this user
            unlink($file);
        }
    }

    // Destroy the current session
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
