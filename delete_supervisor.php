<?php
include 'db.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete supervisor
    $sql = "DELETE FROM supervisor WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Supervisor deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

// Redirect back to supervisor management page
header("Location: supervisor_management.php");
exit();
?>
