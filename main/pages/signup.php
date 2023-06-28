<?php 
  require_once('../contents/common.php');
  drawHeader();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Ticketry</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/style.css">
  </head>

  <body>
    <div class="register_header">
            <a href="login.php" class="register_button">Login</a>
    </div>  

    <div class="register_content for signup">
        <h1>Sign Up</h1>
        <form action = "../actions/action_signup.php" method="post">
            <input name="name" type="text" placeholder="Name" required="required">
            <input name="username" type="text" placeholder="Username" required="required">
            <span class="hint">At least 6 characters.</span>
            <input name="email" type="email" placeholder="Email" required="required">
            <input name="password" type="password" placeholder="Password">
            <span class="hint">At least 6 characters.</span>
            <input name="passwordagain" type="password" placeholder="Repeat Password">
            <span class="hint">Must match with password.</span>
            <input name="submit" type="submit" value="Sign Up">
        </form>
</html>

<?php 
  drawFooter();
?>