<?php

$adtitleErr = $categoryErr = $addescriptionErr = $priceErr = $nameErr = $emailErr = $phonenoErr = $captchaErr = $imageErr = "";
$adtitle = $category = $addescription = $price = $name = $email = $phoneno = "";  

if (isset($_POST['submit'])) 
{
	if (empty($_POST["AdTitle"]))
   {
     $adtitleErr .= "Title is required";
    } 
    else 
	{
     $adtitle = test_input($_POST["AdTitle"]);
     
	 
     if (strlen($adtitle) < 3 OR strlen($adtitle) > 50)
		 {
			$adtitleErr .= " Title should be within 3-50 characters long.";
		}
   }
   
   $category	= test_input($_POST["Category"]);
	if ($category == 0) 
   {
			$categoryErr .= "Please select a category";
	}
	
	if (empty($_POST["AdDescription"]))
   {
     $addescriptionErr .= "Description is required";
    } 
    else 
	{
     $addescription = test_input($_POST["AdDescription"]);
     
	 
     if (strlen($addescription) < 3 OR strlen($addescription) > 350)
		 {
			$nameErr .= " Description should be within 3-350 characters long.";
		}
   }
   
   if (empty($_POST["Price"])) 
   {
     $priceErr .= "Price is required";
   } 
   else 
   {
     $price = test_input($_POST["Price"]);
     
     if (!is_numeric($price)) 
	 {
       $priceErr .= "Price must only contain digits"; 
     }
	 
	 
   }
	
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
   
   if (empty($_POST["Email"])) 
   {
     $emailErr .= "Email is required";
   } 
   else 
   {
     $email = test_input($_POST["Email"]);
     
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	 {
       $emailErr .= "Invalid email format"; 
     }
   }
     
   if (empty($_POST["PhoneNo"])) 
   {
     $phonenoErr .= "Phone Number is required";
   } 
   else 
   {
     $phoneno = test_input($_POST["PhoneNo"]);
     
     if (!is_numeric($phoneno)) 
	 {
       $phonenoErr .= "Invalid Phone Number"; 
     }
	 
	 if (strlen($phoneno)!= 10)
	 {
		 $phonenoErr .= "Enter a 10 digit roll number";
	 }
   }
  
	
	
	
	

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


   if(!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name']))
	{
		$uploadOk = 0;
    echo 'No Profile picture uploaded';
    }
	else
	{
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) 
	  {
        
        $uploadOk = 1;
      } 
	  else 
	  {
        echo "File is not an image.";
        $uploadOk = 0;
      }
	



if ($_FILES["fileToUpload"]["size"] > 500000)
	{
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
   }

if(!($imageFileType == "jpg" ||$imageFileType == "JPG" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif" )) 
{
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0)
	{
      $imageErr .= "Please Upload your Profile picture";
    } 
	else 
 {
    if (!(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)))
		{
          
        echo "Sorry, there was an error uploading your file.";
    }
   }
	}   
	
	session_start();
	
	if(($_REQUEST['captcha'] == $_SESSION['vercode']))
   {
     $captchaErr = "";
    }
    else
	{
      $captchaErr .= "Please Enter the captcha correctly and re-upload the profile picture";
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