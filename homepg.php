<html>
<style>
div{
    height:100px;
    width:100px;
	border:1px solid#000;
	float:left;
	margin-left:25px;
    text-align:center;
    margin-top:50px;
}
</style>
<body>
<h1>Choose a Category</h1>
<div id="Books" onclick="location.href='category.php?id='+ this.id"> Books
</div>
<div id="Electronics" onclick="location.href='category.php?id='+ this.id"> Electronics
</div>
<div id="Cycles" onclick="location.href='category.php?id='+ this.id"> Cycles
</div>
<div id="Furniture" onclick="location.href='category.php?id='+ this.id"> Furniture
</div>
<div id="Stationary" onclick="location.href='category.php?id='+ this.id"> Stationary
</div><span style="display:inline-block; width: 500px;"></span>
<a href="submit1.php">Submit an Ad</a><br><br><br><br><br><br><br><br><br>
<br><p>Recommendations:</p><br>
<body>
</html>
<?php
$servername = "localhost";
                $username = "root";
                $pass = "";
                $dbname = "project";				
				
                $conn = new mysqli($servername, $username, $pass, $dbname);
                if ($conn->connect_error) 
                  {
                        die("Connection failed: " . $conn->connect_error);
                  } 
				  
				  
				  if ($stmt = $conn->prepare("SELECT title, price, profilepath, id FROM ad ORDER BY visits DESC LIMIT 3")) 
				{
 
                         
                         $stmt->execute();
                         $result = $stmt->get_result();
                         while ($row = $result->fetch_assoc())
						 { echo "<br>";
						   echo '<html><img src = "'.$row["profilepath"].'" height = 50 px width=50 px></img></html>';
                           echo "<br> Title:" . $row["title"] . "Price:"." ".$row["price"]."<br>";
						  
                           $link = "product.php?id=".$row["id"];						   
						   echo '<html><a href="'.$link.'">Check This Out</a></html>';
						   
                         }
						 
						 $stmt->close();
						 
						 
    
                }

				
				
               $conn->close();
?>
