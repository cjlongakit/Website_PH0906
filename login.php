<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login PH0906</title>
  <link rel="stylesheet" href="login.css" />
</head>
<body>
  <div class="login-container">
    <div class="header">
      <img src="ph0906logo.png" alt="Church Icon" class="icon" />
      <h1 class="header-title">
        HELLO,<br>
        <span class="highlight">PH0906!</span>
      </h1>
    </div>
    <form class="login-form" action="login_process.php" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
      </div>
      <button type="submit" class="login-button">Log In</button>
    </form>
  </div>
</body>
</html>