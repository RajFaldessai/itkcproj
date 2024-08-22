<?php
include 'db.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch supervisor details
    $sql = "SELECT * FROM supervisor WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email_id = $_POST["email_id"];

    $sql = "UPDATE supervisor SET username='$username', first_name='$first_name', last_name='$last_name', email_id='$email_id' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Supervisor updated successfully";
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
    <title>Edit Supervisor</title>
</head>
<body>
    <h1>Edit Supervisor</h1>
    <form method="post" action="">
        Username: <input type="text" name="username" value="<?php echo $row['username']; ?>" required><br><br>
        First Name: <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>"><br><br>
        Last Name: <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>"><br><br>
        Email ID: <input type="email" name="email_id" value="<?php echo $row['email_id']; ?>"><br><br>
        <input type="submit" value="Update Supervisor">
    </form>
    <br>
    <a href="supervisor_management.php">Back to Supervisor Management</a>
</body>
</html>
