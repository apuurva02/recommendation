 <?php 
    
    include('v.php');

?>	

<html>

<head>

<title> Registration Form </title>

<script>
function validate()
  {
    
	 var name = document.regForm.Name;
	 var username = document.regForm.userName;
	 var password1 = document.regForm.pwd;
	 var password2 = document.regForm.repwd;
	 var phoneno = document.regForm.phoneNo;
	 
	 
	 
	   
	if (name.value == "")
    {  
      window.alert("Please enter your name.");
      name.focus();
      return false;	
	}	
	
		
    var chk = /[A-Za-z.]/;
    if (!chk.test(name.value))
    {
	  window.alert("Name must contain only alphabets!");
	  name.focus();
	  return false;
	  
	}

	if (name.value.length < 3 || name.value.length > 20)
	{
		window.alert("Name should be within 3-20 characters long");
		name.focus();
		return false;
	}
	
	if (username.value == "")
    {  
      window.alert("Please enter your username.");
      username.focus();
      return false;	
	}	
	
	if (username.value.length < 3 || username.value.length > 10)
	{
		window.alert("Username should be within 3-10 characters long");
		username.focus();
		return false;
	}
	    
	 if (password1.value != "" )
	 {
	   if(password1.value.length < 6)
	   {
	     window.alert("Please Enter a password of minimum 6 characters!");
		 password1.focus();
		 return false;
	   
	   }
	   
	   if(password1.value.length > 20)
	   {
	     window.alert("Please Enter a password of maximum 20 characters!");
		 password1.focus();
		 return false;
	   
	   }
	   
	   chk = /[0-9]/;
	   if(!chk.test(password1.value))
	   {
	     window.alert("Password must contain atleast one number (0-9)!");
		 password1.focus();
		 return false;
	   }
	   
	   chk = /[a-z]/;
	   if(!chk.test(password1.value))
	   {
	     window.alert("Password must contain atleast one Lowercase letter!");
		 password1.focus();
		 return false;
		}
		
		chk = /[A-Z]/;
	   if(!chk.test(password1.value))
	   {
	     window.alert("Password must contain atleast one Uppercase letter!");
		 password1.focus();
		 return false;
		}
					   
	 }
	 
	 else if (password1.value == "")
	 {
	   window.alert("Please Enter a Password!");
	   password1.focus();
	   return false;
	 }
	 
	 if(password2.value == "")
	 {
		 window.alert("Please Re-enter Password");
		 password2.focus();
		 return false;
	 }
	 
	 if(password2.value != password1.value)
	 {
		 window.alert("Please Re-enter Password correctly");
		 password2.focus();
		 return false;
	 }
	 
	 
	
	if (phoneno.value == "")
	 {
	   window.alert("Please Enter your Phone Number!");
	   phoneno.focus();
	   return false;
	 }
	 
	 if (phoneno.value <1000000000 || rollno.value > 9999999999)
	 {
	    window.alert("Please Enter a valid 10 digit Phone Number");
		phoneno.focus();
		return false;
	 }
	 
	 if (isNaN(phoneno.value ))
	 { 
	   window.alert("Please Enter a VALID Phone Number!!");
	   phoneno.focus();
	   return false;
	   }
	 	 	  
	 return true;
	 }
	 
</script>

<body>



<form action="r.php" name="regForm" onsubmit="return (validate());" method="post" enctype="multipart/form-data">
   <H1 style="font-size:25px"> Please Fill up the form below and submit</H1>
   <table>
   
   <tr><td>Name:</td><td> <input type="text" name="Name" value="<?php echo $name; ?>" /> <?php echo $nameErr;?> </td>
   <tr><td>Username:</td><td> <input type="text" name="userName" value="<?php echo $username; ?>" /> <?php echo $usernameErr;?> </td>
  	<tr><td>Password:</td><td> <input type="password" id="password1" name="pwd" value="<?php echo $password1; ?>" /> <?php echo $passwordErr;?> </td></tr>
	<tr><td><input type="checkbox" onchange="document.getElementById('password1').type = this.checked ? 'text' : 'password'"> Show password</td></tr>
	<tr><td> Re-Enter Password:</td><td> <input type="password" id="password2" name="repwd" value="<?php echo $password2; ?>" /> <?php echo $repasswordErr;?> </td></tr>
<tr><td><input type="checkbox" onchange="document.getElementById('password2').type = this.checked ? 'text' : 'password'"> Show password</td></tr>
<tr><td>Phone Number:</td><td> <input type="text" name="phoneNo" value="<?php echo $phoneno; ?>"/> <?php echo $phonenoErr;?> </td></tr>
	</table>
	 
	<p><input type="submit" value="Submit" name="submit"></p> 
	
</form>

<?php

        $encpwd = sha1($password1);
	  
			if (isset($_POST['submit']) && $nameErr=="" && $phonenoErr=="" && $passwordErr=="" && $repasswordErr=="" && $usernameErr=="") 
			{   echo "<p style='color:green;font-size:20px;' >Form has been submitted successfully.</p>";
		        
				
				
				$servername = "localhost";
                $user = "root";
                $pass = "";
                $dbname = "project";
				
                $conn = new mysqli($servername, $user, $pass, $dbname);
                if ($conn->connect_error) 
                  {
                        die("Connection failed: " . $conn->connect_error);
                  } 
              	
				$stmt = $conn->prepare("INSERT INTO users (username, password, name, phoneno)
                                             VALUES (?, ?, ?, ?)");
											    $stmt->bind_param("ssss", $username, $encpwd, $name, $phoneno );
												 
												 $stmt->execute();
												 $stmt->close();
                                                 $conn->close();
				
				
				
				


			}
?>			

	
</body>

</head>
</html>