<?php
    require_once "db-connection.php";
    
    session_start();
    
    
    
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == "1") {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $article_id = $_POST["article_id"];
            $delete_article_query = "DELETE FROM `articles` WHERE `id`=".$article_id;
            if ($conn->query($delete_article_query)) {
                echo '<script>
                    alert("התוכן נמחק בהצלחה!");
                    window.location = "/includes/php/AddArticle.php";
                </script>';
            } else {
                echo "Connection error to DB";
            }
    
        }
    } else {
          echo '<script>
                alert("יש לבצע התחברות כאדמין!");
                window.location = "/includes/php/sign-up.php";
            </script>';
    }
    
    $conn->close();
?>