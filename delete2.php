<?php
include("config.php");
if (isset($_GET['id'])) {
    $recordId = intval($_GET['id']);
    // Your database connection and deletion logic here
    $select_status = "DELETE FROM users WHERE id = '$recordId'";
    $result_status = mysqli_query($conn, $select_status);
    // Redirect back to the main page or show a success message
    echo '<script type = "text/javascript">';
    echo 'alert("Record with ID '.$recordId.' deleted!");';
    echo 'window.location.href = "user.php"';
    echo '</script>';
}
?>