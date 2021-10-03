<?php
    require_once "db-connection.php";
    session_start();
    
    if (isset($_SESSION['user_id']) && $_SESSION['user_id']!= "") {
        
        
        if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["product_id"]) && isset($_GET["cart_id"])) {
        
        
            $product_id = $_GET["product_id"];
            $cart_id = $_GET["cart_id"];
            
            $delete_product_query = "DELETE FROM `cartProducts` WHERE `productID`=".$product_id. " AND cartID=". $cart_id ;
            if ($conn->query($delete_product_query)) {
                echo '<script>
                    alert("המוצר נמחק בהצלחה!");
                    window.location = "/includes/php/Cart.php";
                </script>';
            } else {
                echo "שגיאת בסיס נתונים";
                echo $delete_product_query;
            }
        } else {
          echo "שגיאת פרמטרים";
          echo $_SERVER["REQUEST_METHOD"] ;
          echo isset($_GET["product_id"]);
        }
    } else {
          echo '<script>
                alert("יש לבצע התחברות תחילה!");
                window.location = "/includes/php/sign-up.php";
            </script>';
    }
    
    $conn -> close();
?>