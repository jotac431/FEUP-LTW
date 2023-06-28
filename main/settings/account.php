<?php function drawSettings() {
?>

<h1>Personal Information</h1>
<div class="content">
    <div id="account">
        <div id="fields">
            <form action="../actions/action_update_user.php" method="post" class="register_form">
                <label>Name</label>
                <input name="name" type="text" placeholder="Name" value="<?php echo htmlentities($_SESSION['userinfo']['Name']) ?>" required="required">
                <label>Username</label>
                <input name="username" type="text" placeholder="Username" value="<?php echo htmlentities($_SESSION['userinfo']['Username']) ?>" required="required">
                <span class="hint">At least 6 characters.</span>
                <label>Email</label>
                <input name="email" type="email" placeholder="Email" value="<?php echo htmlentities($_SESSION['userinfo']['Email']) ?>" required="required">
                <label>Password</label>
                <input name="currpassword" type="password" placeholder="Password" required="required">
                <span class="hint">At least 6 characters.</span>
                <label> Change password (Optional) </label>
                <input name="password" type="password" placeholder="New Password">
                <span class="hint">At least 6 characters.</span>
                <input name="passwordagain" type="password" placeholder="Repeat New Password">
                <span class="hint">Must match new password.</span>
                <input type="submit" name="Submit" value="Update">
            </form>
        </div>
    </div>
</div> 
<?php } ?>