<?php

session_start();

if (isset($_SESSION['id'])) {
  header("Location:../pages/home.php");
}

require_once('../contents/common.php');
drawHeader();
?>

<div class="login">

  <div class="register_content">
    <h1> Login </h1>
    <form action="../actions/action_login.php" method="post">
      <input type="text" name="username" placeholder="username" required="required">
      <input type="password" name="password" placeholder="password" required="required">
      <input type="submit" value="Login">
      <a href="signup.php" class="register_button"> Sign Up</a>
    </form>
  </div>
</div>

<?php
drawFooter();
?>