<?php
include 'db.php';

// Fetch supervisors from the database
$sql = "SELECT id, username, first_name, last_name, email_id FROM supervisor";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your stylesheet here -->
</head>
<body>
    <h1>Supervisor Management</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email ID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["first_name"] . "</td>
                            <td>" . $row["last_name"] . "</td>
                            <td>" . $row["email_id"] . "</td>
                            <td><a href='edit_supervisor.php?id=" . $row["id"] . "'>Edit</a></td>
                            <td><a href='delete_supervisor.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this supervisor?');\">Delete</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No supervisors found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="add_supervisor.php">Add Supervisor</a>
</body>
</html>
<?php
$conn->close();
?>
