<?php
include('login.php'); 

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>

<body>
<h2>Login</h2>
<form action="" method="post">
<label>UserName :</label>
<input name="un" type="text">
<label>Password :</label>
<input name="pd" type="password"><br>
<input name="submit" type="submit" value=" Login "><br>
<span><?php echo $error; ?></span>
</form>

</body>
</html>