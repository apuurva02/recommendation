



<?php
$servername = "localhost";
                $username = "root";
                $pass = "";
                $dbname = "project";
			    $chosen_id = $_GET['id'];
				
				echo($chosen_id);
                $conn = new mysqli($servername, $username, $pass, $dbname);
                if ($conn->connect_error) 
                  {
                        die("Connection failed: " . $conn->connect_error);
                  } 
				  
				  
				  if ($stmt = $conn->prepare("SELECT title, price, profilepath, id FROM ad WHERE category=?")) 
				{
 
                         $stmt->bind_param("s", $chosen_id);
                         $stmt->execute();
                         $result = $stmt->get_result();
                         while ($row = $result->fetch_assoc())
						 { echo "<br>";
						   echo '<html><img src = "'.$row["profilepath"].'" height = 50 px width=50 px></img></html>';
                           echo "<br> Title:" . $row["title"] . "Price:"." ".$row["price"]."<br>";
						  
                           $link = "product.php?id=".$row["id"];						   
						   echo '<html><a href="'.$link.'">Check This Out</a></html>';
						   
                         }
						 
						 
						 
						 
    
                }

				
				$stmt->close();
               $conn->close();
?>
