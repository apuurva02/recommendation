<?php
session_start(); 
$error='';
if (isset($_POST['submit']))
 {
   if (empty($_POST['un']) || empty($_POST['pd']))
   {
     $error = "Username or Password is invalid";
   }
   else
  {

    $un=$_POST['un'];
    $pd=$_POST['pd'];
	$encpwd = sha1($pd);
	
	            $servername = "localhost";
                $user = "root";
                $pass = "";
                $dbname = "project";
				
                $conn = new mysqli($servername, $user, $pass, $dbname);
                if ($conn->connect_error) 
                  {
                        die("Connection failed: " . $conn->connect_error);
                  } 
              	
				if ($stmt = $conn->prepare("SELECT name, phoneno FROM users WHERE username=? AND password=?")) 
				{
 
                         $stmt->bind_param("ss", $un, $encpwd);
                         $stmt->execute();
						 $result = $stmt->get_result();
                         $rows = $result->num_rows;
						 if ($rows == 1) 
						 {
                             $_SESSION['login_user']=$un; 
                             header("location: profile.php"); 
                         }
						 else 
						 {
                           $error = "Username or Password is invalid";
                         }
    
                }


              mysql_close($connection); 
    }
  }
?>
<html>
<a href="r.php">Sign Up!</a>
</html>
