<?php
    require_once "db-connection.php";
    session_start();
   
    
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['user_id']) && $_SESSION['user_id']!= "") {
        $sql = "UPDATE carts SET status='archive' WHERE user_id=".$_SESSION['user_id'];
        if ($conn->query($sql)) {
            echo '<script>
                alert("הקנייה בוצעה בהצלחה!");
                window.location = "/includes/php/Products.php";
            </script>';
        } else {
            echo "שגיאת בסיס נתונים";
            //echo $sql;
        }

    } else {
          echo '<script>
                alert("יש לבצע התחברות תחילה!");
                window.location = "/includes/php/sign-up.php";
            </script>';
    }
    
    $conn -> close();
?>