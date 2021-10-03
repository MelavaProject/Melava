<?php
    require_once "db-connection.php";
    session_start();
    
     if (isset($_SESSION['admin']) && $_SESSION['admin'] == "1") {
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_id = $_POST["product_id"];
            $delete_product_query = "DELETE FROM `products` WHERE `id`=".$product_id."";
            if ($conn->query($delete_product_query)) {
                echo '<script>
                    alert("המוצר נמחק בהצלחה!");
                    window.location = "/includes/php/AddProduct.php";
                </script>';
            } else {
                echo "Connection error to DB";
            }
    
        }
     }  else {
          echo '<script>
                alert("יש לבצע התחברות כאדמין!");
                window.location = "/includes/php/sign-up.php";
            </script>';
    }
    
    
    $conn -> close();
?>