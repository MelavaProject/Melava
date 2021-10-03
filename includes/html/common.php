<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="he">
<head>
  <title>Bootstrap Theme Simply Me</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
      
      
  </script>
  <style>
  body {
    font: 20px Montserrat, sans-serif;
    line-height: 1.8;
    /*color: #f5f6f7;*/
    text-align: right;
  }
  p {font-size: 16px;}
  .margin {margin-bottom: 45px;}
  .bg-1 { 
    background-color: #fff3f0; 
    color: black;
  }
  .bg-2 { 
    background-color: #474e5d; /* Dark Blue */
    color: #ffffff;
  }
  .bg-3 { 
    background-color: #ffffff; /* White */
    color: #555555;
  }
  .bg-4 { 
    background-color: #2f2f2f; /* Black Gray */
    color: #fff;
  }
  .container-fluid {
    padding-top: 70px;
    padding-bottom: 70px;
  }
  .navbar {
    padding-top: 15px;
    padding-bottom: 15px;
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 12px;
    letter-spacing: 5px;
  }
  
  .navbar-default .navbar-nav>li>a {
      color: black;
  }
  a {
      color: black;
      padding: 10px 6px;

  }
  a:hover {
    color: #eb78b5 !important;
    text-decoration: none;
  }
  
  footer {
    background-color: #eaeaea;
    text-align: center;
    color: whitesmoke;
    position: fixed;
    width: 100%;
    bottom: 0;
    font-size: 17px;
    color: #6c757d;
    z-index: 999;
}
  </style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>

      <div class="navbar-brand" style="font-size: 12px;">

        <a href="/"><img src="/media/images/logo.png" style="display:inline; height: 34px;"></a>
        <a id="sign-up" href="/includes/php/sign-up.php">הרשמה</a>
        <a id="sign-in" href="/includes/php/sign-in.php">התחברות</a>
        <a id="sign-out" href="/includes/php/sign-out.php">התנתקות</a>
        <div id="message"></div>

      </div>

    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/">דף הבית</a></li>
        <li><a id="calendar" href="/includes/php/scheduler.php">יומן</a></li>
       <li><a href="/includes/php/Articles.php">תכנים</a></li>
      
        <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == "1"): ?>
            <li><a href="/includes/php/AddArticle.php">עריכת תכנים</a></li>
        <?php endif; ?>
        
        <li><a href="/includes/php/Products.php">קטלוג מוצרים</a></li>
        
        <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == "1"): ?>
            <li><a href="/includes/php/AddProduct.php">עריכת מוצרים</a></li>
        <?php endif; ?>
        
        <li><a href="/includes/php/About.php">אודות</a></li>

      </ul>
    </div>
  </div>
</nav>



<!-- Footer -->
<footer class="bg-4 text-center">
    <ul style="margin-top: 15px;">
        <a href="https://www.facebook.com/shevet.imahot/" target="_blank"><ion-icon size="large" name="logo-facebook"></ion-icon></a>
        <a href="https://www.instagram.com/shevet_imahot/" target="_blank"><ion-icon size="large" name="logo-instagram"></ion-icon></a>
    </ul>
    
</footer>

</body>
</html>
