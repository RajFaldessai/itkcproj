<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email_id = $_POST["email_id"];

    $sql = "INSERT INTO supervisor (username, password, first_name, last_name, email_id) VALUES ('$username', '$password', '$first_name', '$last_name', '$email_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New supervisor added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supervisor</title>
</head>
<body>
    <h1>Add Supervisor</h1>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        First Name: <input type="text" name="first_name"><br><br>
        Last Name: <input type="text" name="last_name"><br><br>
        Email ID: <input type="email" name="email_id"><br><br>
        <input type="submit" value="Add Supervisor">
    </form>
    <br>
    <a href="supervisor_management.php">Back to Supervisor Management</a>
</body>
</html>
