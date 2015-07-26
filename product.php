<?php

  session_start();
  $user_check=$_SESSION['login_user']; 
  
    

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "project";
$unique = $_GET['id'];
$conn = new mysqli($servername, $username, $pass, $dbname);

                if ($conn->connect_error) 
                  {
                        die("Connection failed: " . $conn->connect_error);
                  } 
				  
				  if ($stmt = $conn->prepare("SELECT title, description, price, profilepath, name, phoneno,visits FROM ad, users WHERE id=? AND user_present = username")) 
				{
 
                         $stmt->bind_param("s", $unique);
                         $stmt->execute();
                         $stmt->bind_result($t, $d, $pr, $pp, $n, $ph, $v);
                         $stmt->fetch();
						 $stmt->close();
    
                }
				$stmt = $conn->prepare("INSERT INTO views (user_id, product_id)
                                             VALUES ( ?, ?)");
											 
												 $stmt->bind_param("ss", $user_check, $unique );
												 $stmt->execute();
												 $stmt->close();		
						
			$stmt = $conn->prepare("SELECT DISTINCT user_id, product_id FROM views WHERE product_id=?");
			$stmt->bind_param("s", $unique);
			$stmt->execute();
		    $result = $stmt->get_result();
            $rows = $result->num_rows;
					
				
			    if($stmt = $conn->prepare("UPDATE `project`.`ad` SET `visits` = ? WHERE `ad`.`id` = ?"))
				{
					
					 $stmt->bind_param("ss",$rows, $unique);
                         $stmt->execute();
				}

				$stmt->close();
					
				$conn->close();
											 
							
											 
				
				
?>
<html>

<img src ="<?php echo "$pp";?>" height ="300 px" width="300 px"></img><br>


</html>
				<?php echo $t . " " . $d . " " . $pr . " " . $n . " " . $ph ; ?>
