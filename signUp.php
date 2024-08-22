<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>SUPERVISOR REGISTRATION</title>
  <link rel="stylesheet" href="signUp.css">
  <style type="text/css">
    body {
      background-image: url(home.jpeg);
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .confirm {
      background-color: black;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="confirm">
    <?php
    function isStrongPassword($password) {
      $minLength = 8;
      $hasUppercase = preg_match('/[A-Z]/', $password);
      $hasLowercase = preg_match('/[a-z]/', $password);
      $hasDigit = preg_match('/\d/', $password);
      $hasSpecialChar = preg_match('/[^A-Za-z0-9]/', $password);
  
      if (strlen($password) < $minLength || !$hasUppercase || !$hasLowercase || !$hasDigit || !$hasSpecialChar) {
        return false;
      }
      return true;
    }

    include 'db.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
      $fname = mysqli_real_escape_string($conn, $_POST['fname']);
      $lname = mysqli_real_escape_string($conn, $_POST['lname']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $con_pass = mysqli_real_escape_string($conn, $_POST['cpassword']);
      $sube = $_POST['submit_email'];

      $_SESSION['email'] = $email;
      $_SESSION['sub'] = $sube;

      if (isStrongPassword($password)) {
        if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
          if ($password === $con_pass) {
            $query = "INSERT INTO supervisor (first_name, last_name, username, email_id, password) VALUES ('$fname', '$lname', '$user_name', '$email', '$password')";
            if (mysqli_query($conn, $query)) {
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('Successfully signed up!');
              window.location.href='supervisor.html';
              </script>");
            } else {
              echo "<script>alert('Error: Could not execute query.');</script>";
            }
          } else {
            echo "<script>alert('Passwords do not match. Please try again.');</script>";
          }
        } else {
          echo "<script>alert('Please enter valid information!');</script>";
        }
      } else {
        echo "<script>alert('Enter a strong password! Must contain uppercase, lowercase, numbers, and special characters.');</script>";
      }
    }
    ?>
  </div>

  <div class="wrapper">
    <div class="registration_form">
      <div class="title">
        Sign Up for BOSS-BUSS Service
      </div>
      <form action="signUp.php" method="post">
        <div class="form_wrap">
          <div class="input_grp">
            <div class="input_wrap">
              <label for="fname">First Name</label>
              <input type="text" id="fname" name="fname" placeholder="First Name" required>
            </div>
            <div class="input_wrap">
              <label for="lname">Last Name</label>
              <input type="text" id="lname" name="lname" placeholder="Last Name" required>
            </div>
          </div>
          <div class="input_wrap">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
          </div>
          <div class="input_wrap">
            <label for="uname">Username</label>
            <input type="text" id="uname" name="user_name" placeholder="Username" required>
          </div>
          <div class="input_wrap">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
          </div>
          <div class="input_wrap">
            <label for="Confirm_password">Confirm Password</label>
            <input type="password" id="Confirm_password" name="cpassword" placeholder="Confirm Password" required>
          </div>
          <div class="input_wrap">
            <input type="submit" value="Register Now" name="submit_email" class="submit_btn">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
