<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    
    echo '
    <script>
        sessionStorage.removeItem("last_name");
        sessionStorage.removeItem("first_name");
        sessionStorage.removeItem("email");
        sessionStorage.removeItem("user_id");
        sessionStorage.removeItem("admin");
        window.location = "http://adidg.mtacloud.co.il/";
    </script>';
?>
