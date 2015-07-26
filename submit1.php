 <?php 
    
    include('validationPHP.php');
	
	
	function selected($category, $choice) 
	{
		if($category==$choice) echo "selected";
	}
		
     
?>	

<html>

<head>

<title> Submit an Ad </title>

<script>
function validate()
  {
     var adtitle = document.regForm.AdTitle; 
	 var category = document.regForm.Category;
	 var addescription = document.regForm.AdDescription;
	 var price = document.regForm.Price;
	 
	 
	 if (adtitle.value == "")
	 {
	   window.alert("Please Enter an Ad Title!");
	   adtitle.focus();
	   return false;
	 }
	 
	 
	 if (adtitle.value.length < 3 || adtitle.value.length > 20)
	{
		window.alert("Ad Title should be within 3-20 characters long");
		adtitle.focus();
		return false;
	}
	
	 
	 if(category.selectedIndex < 1)
	{
	   window.alert("Please Select a category!");
	   category.focus();
	   return false;
	}
	if (addescription.value == "")
	 {
	   window.alert("Please Enter an Ad Description!");
	   addescription.focus();
	   return false;
	 }
	 if (addescription.value.length > 350)
	{
		window.alert("Description should be within 350 characters!");
		addescription.focus();
		return false;
	}
	
	if (price.value == "")
	 {
	   window.alert("Please Enter the price!");
	   price.focus();
	   return false;
	 }
	 
	 if (isNaN(price.value ))
	 { 
	   window.alert("Price can contain only digits");
	   price.focus();
	   return false;
	   }
	  	 	 	  
	 return true;
	 }
	 
</script>

<body>



<form action="submit1.php" name="regForm" onsubmit="return (validate());" method="post" enctype="multipart/form-data">
   <H1 style="font-size:25px"> Please Fill up the form below and submit</H1>
   <table>
   <tr><td>Ad Title:</td><td> <input type="text" name="AdTitle" value="<?php echo $adtitle; ?>" /> <?php echo $adtitleErr;?> </td></tr>
   
   <tr><td>Category: </td>
       <td><select type="text" name="Category" value="<?php echo $category; ?>">
	        <option value="0" > Select a Category </option>
	        <option value="1" <?php selected($category, 1)?>> Books</option>
			<option value="2" <?php selected($category, 2)?>> Electronics </option>
			<option value="3" <?php selected($category, 3)?>> Cycles </option>
			<option value="4" <?php selected($category, 4)?>> Furniture </option>
			<option value="5" <?php selected($category, 5)?>> Stationary </option>
			</select>
	<?php echo $categoryErr;?> </td></tr>
	
	<tr><td>Ad Description:</td><td> <textarea rows="5" cols="50" name="AdDescription">
            <?php echo $addescription; ?>
</textarea> <?php echo $addescriptionErr;?> </td></tr>

<tr><td>Price:</td><td><input type="text" name="Price" value="<?php echo $price; ?>" /> <?php echo $priceErr;?> </td></tr>

</table>
<p>Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" ><?php echo $imageErr;?> </p>

	<input type="text" name="captcha" id="captcha" />
    <img src="captcha.php" /><br><p> <?php echo $captchaErr;?></p> 
	<p><input type="submit" value="Submit" name="submit"></p> 
	
</form>

<?php
      	$unique = time();  
		switch($category) {
			
			case 1 : $c = "Books";
			         break;
			case 2 : $c = "Electronics";
			         break;
			case 3 : $c = "Cycles";
                     break;
			case 4 : $c = "Furniture";
                     break;
			case 5 : $c = "Stationary";
                     break;
 			
			 } 
			 if(!isset($_SESSION)) 
              { 
                  session_start(); 
                } 
			 $tocheck = $_SESSION['login_user'];
		
			if (isset($_POST['submit']) && $adtitleErr=="" && $categoryErr=="" && $addescriptionErr=="" && $captchaErr == "" && $priceErr == "" && $imageErr =="") 
			{   echo "<p style='color:green;font-size:20px;'>Form has been submitted successfully.</p>";
		        
				
				
				$servername = "localhost";
                $username = "root";
                $pass = "";
                $dbname = "project";
				
                $conn = new mysqli($servername, $username, $pass, $dbname);
                if ($conn->connect_error) 
                  {
                        die("Connection failed: " . $conn->connect_error);
                  } 
				  
              	
				$stmt = $conn->prepare("INSERT INTO ad (id, title, category, description, price, profilepath, user_present)
                                             VALUES ( ?, ?, ?, ?, ?, ?,?)");
											 
												 $stmt->bind_param("sssssss", $unique, $adtitle, $c, $addescription, $price, $target_file, $tocheck );
												 $stmt->execute();
												 $stmt->close();
				
                
											 
			 
               
               $conn->close();
				
				
				
				


			}
?>			

	
</body>

</head>
</html>