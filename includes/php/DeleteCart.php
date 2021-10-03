<?php
    require_once "db-connection.php";
    session_start();
   
    
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['user_id']) && $_SESSION['user_id']!= "") {
        $sql = "UPDATE carts SET status='deleted' WHERE user_id=".$_SESSION['user_id'];
        if ($conn->query($sql)) {
            echo '<script>
                alert("העגלה נמחקה בהצלחה!");
                window.location = "/includes/php/Products.php";
            </script>';
        } else {
            echo "שגיאת בסיס נתונים";
            //echo $sql;
        }

    }
    
    $conn -> close();
?>