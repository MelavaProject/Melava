<?php
    require_once "db-connection.php";
    
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['user_id']) && $_SESSION['user_id']!="") {
        $productID = $_GET["id"];
        $sql = "SELECT id FROM `carts` WHERE `user_id`=".$_SESSION['user_id']. " AND status='active'";
        $result = $conn->query($sql);
		if ($result->num_rows==0) {
		    $sql = "INSERT INTO `carts`(user_id) VALUES(".$_SESSION['user_id']. ")";
            if(!$conn->query($sql)) {
                echo '<script>
                 alert("לא הצלחנו לייצר עבורך עגלת קניות. נסה שוב מאוחר יותר");
                 window.location = "/includes/php/Products.php";
                </script>';
                exit();
            }
            $user_cartID = $conn->insert_id;
		} else {
		    $row = $result->fetch_assoc();
		    $user_cartID = $row['id'];
		}
		$sql = "SELECT * FROM cartProducts WHERE cartID=$user_cartID AND productID=$productID";
	    $result = $conn->query($sql);
	    if ($result->num_rows==0) {
		    $sql = "INSERT INTO `cartProducts`(cartID,productID,numOfItems) VALUES($user_cartID, $productID, 1)";
            if($conn->query($sql)) {
                echo '<script>
                 alert("המוצר התווסף בהצלחה");
                 window.location = "/includes/php/Products.php?msgId=1";
                </script>';
            } else {
               
                  echo '<script>
                 alert("המוצר לא התווסף ");
                 window.location = "/includes/php/Products.php?msgId=11";
                </script>';
            }
            
		} else {
		    $row = $result->fetch_assoc();
		    //$rowId = $row[''];
		    $sql = "UPDATE cartProducts SET numOfItems=numOfItems+1 WHERE cartID=$user_cartID AND productID=$productID";
		    if($conn->query($sql)) {
                echo '<script>
                 alert("המוצר התווסף בהצלחה");
                 window.location = "/includes/php/Products.php?msgId=2";
                </script>';
            } else {
                 echo '<script>
                 alert("המוצר לא התווסף ");
                 window.location = "/includes/php/Products.php?msgId=21";
                </script>';
            }
		}   
    } else {
          echo '<script>
                alert("יש לבצע התחברות תחילה!");
                window.location = "/includes/php/sign-up.php";
            </script>';
    }
	
    $conn -> close();
?>