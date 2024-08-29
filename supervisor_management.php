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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        a {
            color: #3498db;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #3498db;
            color: #fff;
        }
        a:active {
            background-color: #2980b9;
        }
        .add-supervisor {
            display: inline-block;
            padding: 10px 15px;
            background-color: #2ecc71;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .add-supervisor:hover {
            background-color: #27ae60;
        }
        .add-supervisor:active {
            background-color: #1e8449;
        }
        .back-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: #2980b9;
        }
        .back-button:active {
            background-color: #1e69d2;
        }
        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }
            .add-supervisor, .back-button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h1>Supervisor Management</h1>
    <table>
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
    <a href="add_supervisorSignUp.php" class="add-supervisor">Add Supervisor</a>
    <a href="admin_dashboard2.php" class="back-button">Back to Admin Dashboard</a>
</body>
</html>
<?php
$conn->close();
?>
