<?php
    require_once "db-connection.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        
        if (empty($email) || empty($password)) {
            $error_messege = "All fields must not be empty";
        }
        
        if (!$error_messege) {
            $check_if_user_exist_query = "SELECT * FROM users WHERE email = '$email'";
            $check_if_user_exist_result = $conn->query($check_if_user_exist_query);
        
            if ($check_if_user_exist_result->num_rows > 0) {
                $row = $check_if_user_exist_result->fetch_assoc();
                $result_hashed_password = $row["password"];
                
                if (password_verify($password, $result_hashed_password)) {
                    session_start();
                    
                    $_SESSION["email"] = $email;
                    $_SESSION["first_name"] = $row["first_name"];
                    $_SESSION["last_name"] = $row["last_name"];
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["admin"] = $row["admin"];

                    echo '
                    <script>
                        sessionStorage.setItem("email","' . $_SESSION["email"]. '");
                        sessionStorage.setItem("first_name","' . $_SESSION["first_name"]. '");
                        sessionStorage.setItem("last_name","' . $_SESSION["last_name"]. '");
                        sessionStorage.setItem("user_id","' . $_SESSION["user_id"]. '");
                        sessionStorage.setItem("admin", "' .$row["admin"]. '");

                        window.location = "http://adidg.mtacloud.co.il/";
                    </script>';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/CSS/forms.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>התחברות</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>-->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="../../JS/load-common-html.js"></script>

</head>

<body>
    <div id="common-html"></div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto" style="padding-bottom: 30px;">
                    <div class="myform form ">
                        <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                                <h1>התחברות</h1>
                            </div>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="login">
                            <div class="form-group">
                                <label for="exampleInputEmail1">אימייל</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">סיסמא</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    aria-describedby="emailHelp" placeholder="Enter Password">
                            </div>

                            <div class="col-md-12 text-center mb-3">
                                <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">התחברות</button>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <p class="text-center"><a href="sign-up.php" id="signin">עדיין לא רשום לאתר? הירשם עכשיו</a></p>
                                </div>
                            </div>
                            
                            <span class="errorMessage"><?php echo $error_messege; ?></span>

                    </div>
                    </form>
            </div>
        </div>
    </div>

</body>
</html>