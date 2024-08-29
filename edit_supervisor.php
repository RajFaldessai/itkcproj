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
        form {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type="text"], input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        input[type="submit"]:active {
            background-color: #1e6f98;
        }
        a {
            color: #3498db;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-top: 15px;
            display: inline-block;
        }
        a:hover {
            background-color: #3498db;
            color: #fff;
        }
        a:active {
            background-color: #2980b9;
        }
        @media (max-width: 768px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <h1>Edit Supervisor</h1>
    <form method="post" action="">
        Username: <input type="text" name="username" value="<?php echo $row['username']; ?>" required><br>
        First Name: <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>"><br>
        Last Name: <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>"><br>
        Email ID: <input type="email" name="email_id" value="<?php echo $row['email_id']; ?>"><br>
        <input type="submit" value="Update Supervisor">
    </form>
    <br>
    <a href="supervisor_management.php">Back to Supervisor Management</a>
</body>
</html>
