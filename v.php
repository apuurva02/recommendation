<?php

$nameErr = $phonenoErr = $passwordErr = $repasswordErr = $usernameErr = "";
$name = $phoneno = $password1 = $password2 = $username = "";  

if (isset($_POST['submit'])) 
{
	
	
   if (empty($_POST["Name"]))
   {
     $nameErr .= "Name is required";
    } 
    else 
	{
     $name = test_input($_POST["Name"]);
     
     if (!preg_match("/^[a-zA-Z .]*$/",$name)) 
	 {
       $nameErr .= "Only letters and white space and dot allowed"; 
     }
	 
     if (strlen($name) < 3 OR strlen($name) > 20)
		 {
			$nameErr .= " Name should be within 3-20 characters long.";
		}
   }
   
   if (empty($_POST["userName"]))
   {
     $usernameErr .= "Username is required";
    } 
    else 
	{
     $username = test_input($_POST["userName"]);
     
	 
     if (strlen($username) < 3 OR strlen($username) > 10)
		 {
			$usernameErr .= " username should be within 3-10 characters long.";
		}
   }
   
   
     
   if (empty($_POST["phoneNo"])) 
   {
     $phonenoErr .= "Phone Number is required";
   } 
   else 
   {
     $phoneno = test_input($_POST["phoneNo"]);
     
     if (!is_numeric($phoneno)) 
	 {
       $phonenoErr .= "Invalid Phone Number"; 
     }
	 
	 if (strlen($phoneno)!= 10)
	 {
		 $phonenoErr .= "Enter a 10 digit phone number";
	 }
   }

   if (empty($_POST["pwd"]))
   {
	   $passwordErr .= "Password is required";
   }
   else 
   {    
	   $password1 = test_input($_POST["pwd"]);
	   
	   if (strlen($password1) < 6)
	   {
		   $passwordErr .= "Enter at least a 6 character long password";
	   }
	   if( strlen($password1) > 20 ) 
	   {
	     $passwordErr .= "Password too long!";
       }

        if( !preg_match("#[0-9]+#", $password1) ) 
		{
	     $passwordErr .= "Password must include at least one number! ";
        }

        if( !preg_match("#[a-z]+#", $password1) ) 
		{
	      $passwordErr .= "Password must include at least one letter!";
        }

        if( !preg_match("#[A-Z]+#", $password1) )
		{
	      $passwordErr .= "Password must include at least one CAPS!";
		}
		   
   }	
   if (empty($_POST["repwd"]))
   {
	   $repasswordErr .= "Re-Enter Password! ";
   }
   else
   {
	  $password2 = test_input($_POST["repwd"]); 
	  if($password2 != $password1)
	  {
		  $repasswordErr .= "Re-Enter Password Correctly";
	  }
   }  

}



function test_input($data)
 {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }
 
 
?>