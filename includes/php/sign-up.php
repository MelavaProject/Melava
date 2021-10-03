<!DOCTYPE html>

<?php
    require_once "db-connection.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = trim($_POST["first_name"]);
        $last_name = trim($_POST["last_name"]);
        $email = trim($_POST["email"]);
        $birth_date = trim($_POST["birth_date"]);
        $password = trim($_POST["password"]);

        if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($birth_date)) {
            $error_messege = "All fields must not be empty";
        }
        
        if (!$error_messege) {
            $is_user_exist_query = "SELECT * FROM users WHERE email = '$email'";
            $is_user_exist_query_result = $conn->query($is_user_exist_query);
            // Check if email exists, if yes print error
            if ($is_user_exist_query_result->num_rows > 0) {
                $error_messege = "Email already exist";
            }
            
            if (!$error_messege) {
                $upper_case_validation = preg_match('@[A-Z]@', $password);
                $lower_case_validation = preg_match('@[a-z]@', $password);
                $number_validation    = preg_match('@[0-9]@', $password);
                $special_characters_validation = preg_match('@[^\w]@', $password);
            
                if (strlen($password) < 6 || !$upper_case_validation || !$lower_case_validation || !$number_validation || !$special_characters_validation) {
                    $error_messege ="Password must contain at least 6 characters <br> At least one upper case letter <br> At least one lower case letter <br> At least one number <br> At least one special character.";
                }
                
                
                if (!$error_messege) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $insert_user_query = "INSERT INTO users (first_name, last_name, email, birth_date, password) VALUES ('".$first_name."', '".$last_name."','".$email."','".$birth_date."','".$hashed_password."')";
                
                    if ($conn->query($insert_user_query) == FALSE) {
                        $error_messege = 'Error with inserting user to db. '.$conn->error;
                    } else {
                        $get_user_id_query = "SELECT * FROM users WHERE email = '$email'";
                        $get_user_id_query_result = $conn->query($get_user_id_query);
                        $user = $get_user_id_query_result->fetch_assoc();

                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["first_name"] = $first_name;
                        $_SESSION["last_name"] = $last_name;
                        $_SESSION["user_id"] = $user["id"];

                        echo '
                        <script>
                            sessionStorage.setItem("email","' . $_SESSION["email"]. '");
                            sessionStorage.setItem("first_name","' . $_SESSION["first_name"]. '");
                            sessionStorage.setItem("last_name","' . $_SESSION["last_name"]. '");
                            window.location = "https://adidg.mtacloud.co.il/";
                        </script>';
                    }
                }
            }
        }
    }
?>


<html lang="he">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/CSS/forms.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>הרשמה</title>
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
                                <h1>הרשמה</h1>
                            </div>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="registration">
                            <div class="form-group">
                                <label>שם פרטי</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="הכנס שם פרטי">
                            </div>
                            <div class="form-group">
                                <label>שם משפחה</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="הכנס שם משפחה">
                            </div>
                            <div class="form-group">
                                <label>אימייל</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="הכנס כתובת אימייל">
                            </div>
                           <div class="form-group">
                                <label>תאריך לידה</label>
                                <input type="date" min="2018-01-01" max="<?= date('Y-m-d') ?>" name="birth_date" class="form-control" id="birth_date">
                            </div> 
                            

                            <div class="form-group">
                                <label for="exampleInputEmail1">סיסמא</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    aria-describedby="emailHelp" placeholder="הכנס סיסמא">
                            </div>
                            <div class="col-md-12 text-center mb-3">
                                <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">הרשמה</button>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <p class="text-center"><a href="sign-in.php" id="signin">רשום כבר לאתר? התחבר עכשיו</a></p>
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