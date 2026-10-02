<?php
session_start();

include "db.php";

$message = "";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == "" || $password == "") {
    $message = "Username and Password are required!";
  } else {
    $_SESSION['username'] = $username;

    header("Location: index.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login Form</title></head>
<body>

<h2>Login Form</h2>
<p style="color:red;"><?php echo $message; ?></p>

<form method="post">
  <label>Username:</label><br>
  <input type="text" name="username" size="30"><br><br>

  <label>Password:</label><br>
  <input type="password" name="password" size="30"><br><br>

  <button type="submit" name="login"
    style="background:#0d6efd; color:#fff; border:none; border-radius:6px; padding:8px 18px;">
    Login
  </button>
</form>
</body>
</html>
