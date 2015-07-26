<?php
                $servername = "localhost";
                $user = "root";
                $pass = "";
                $dbname = "project";
				
                $conn = new mysqli($servername, $user, $pass, $dbname);
                if ($conn->connect_error) 
                  {
                        die("Connection failed: " . $conn->connect_error);
                  } 
				  
                session_start();
                $user_check=$_SESSION['login_user'];
				
				if ($stmt = $conn->prepare("SELECT title, category, description, price, profilepath FROM ad WHERE user_present=?")) 
				{
 
                         $stmt->bind_param("s", $user_check);
                         $stmt->execute();
                         $result = $stmt->get_result();
                         while ($row = $result->fetch_assoc())
						 { 
					       echo "<br>";
						   echo '<img src = "'.$row["profilepath"].'" height = 50 px width=50 px></img></html>';
                           echo "<br><b> Title</b>:" . $row["title"] . "<br><b>Category</b>:"." ".$row["category"]. "<br><b>Description</b>:"." ".$row["description"]."<br><b>Price</b>:"." ".$row["price"]."<br>";
						   
                         }
                     $stmt->close();   
                }
				
				
               $conn->close();

?>