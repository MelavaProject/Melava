<?php
    require_once('db-connection.php');
    session_start();
    $res_message = "";
    if(!isset($_SESSION['admin']) || $_SESSION['admin'] != "1") {
        die("Not authorized");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $name = trim($_POST["name"]);
        $content = trim($_POST["content"]);
        $age = trim($_POST["age"]);
        $devStage = trim($_POST["devStage"]);
        $fileToUpload = trim($_FILES["fileToUpload"]["name"]);
        //echo "file to upload:$fileToUpload<br>";
        
        if (empty($name) || empty($content) || empty($devStage) || empty($age)) {
            $error_message = "Name,contact,age,devStage fields must not be empty";
        }
       
        
        if (save_file($res_message)) {
            $query = "INSERT INTO articles(name, content, file_path, date, devStage, age) VALUES('$name','$content','$fileToUpload', CURRENT_DATE(), '$devStage', '$age')";
            $res = $conn->query($query);
            if($res == 1) {$res_message.= "המאמר הועלה בהצלחה!";} else {$res_message.= "שגיאה בהעלאת המאמר!";}
        }
    }
    
    function save_file(&$msg) {
        $msg  = "";
        $target_dir = "/home/adidg/public_html/media/uploads/";
        $source_file = $_FILES["fileToUpload"]["tmp_name"];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        //$msg .= "target file: $target_file<br>";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if file already exists
        if (file_exists($target_file)) {
          $msg .= "מצטערים, הקובץ כבר קיים.";
          $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          $msg .= "מצטערים, הקובץ גדול מדי.";
          $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"  && $imageFileType != "pdf") {
          $msg .= "מצטערים, מקבלים רק קובץ תמונה או PDF.";
          $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
       
          //$msg .= "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        if ($uploadOk == 1) {
          if (move_uploaded_file($source_file, $target_file)) {
            //$msg .= "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            $uploadOk = 0;
            $msg .= "מצטערים, קרתה תקלה בהעלאת הקובץ.";
          }
        }
        return $uploadOk;
    }
   
?>
<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/CSS/forms.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>עריכת תכנים</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                <h1>הוספת מאמר</h1>
                            </div>
                        </div>
                        <form action="" method="post" name="addArticle" enctype="multipart/form-data">
                        <!--<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="login">-->
                            <div class="form-group">
                                <label for="name">שם המאמר</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    aria-describedby="emailHelp" placeholder="הוסיפו את שם המאמר">
                            </div>
                            <div class="form-group">
                                <label for="content">תוכן המאמר</label>
                                <textarea name="content" id="content" class="form-control"
                                    aria-describedby="emailHelp" placeholder="הוסיפו תיאור או תוכן מאמר"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="devStage">שלב התפתחות</label>
                                <select class="select form-control" id="devStage" name="devStage">
                                    <option selected disabled hidden style='display: none' value="">בחירה</option>
                                    <option value="זחילה">זחילה</option>
                                    <option value="זחילת גחון">זחילת גחון</option>
                                    <option value="התהפכות">התהפכות</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="age">גיל</label>
                                <select class="select form-control" id="age" name="age">
                                    <option selected disabled hidden style='display: none' value="">בחירה</option>
                                    <option value="0-3">0-3</option>
                                    <option value="3-6">3-6</option>
                                    <option value="6-9">6-9</option>
                                    <option value="9-12">9-12</option>
                                    <option value="12-18">12-18</option>
                                    <option value="18-24">18-24</option>
                                </select>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="fileToUpload">העלאת קובץ</label>
                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control"
                                    aria-describedby="emailHelp">
                            </div>

                            <div class="col-md-12 text-center mb-3">
                                <button type="submit" name="submit" class=" btn btn-block mybtn btn-primary tx-tfm">אישור</button>
                            </div>
                           
                            
                            <span class="errorMessage"><?= $error_message; ?></span>
                            <span class="resMessage"><?= $res_message; ?></span>
                            
                        </form>
                    </div>
            </div>
        </div>
        
        
        <div id="manage-articles-div" style="overflow-y: auto;">
            <div class="col-md-12 text-center">
                <h1>עריכת תכנים</h1>
                <p>כאן אפשר לערוך תכנים</p>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th>שם התוכן</th>
                    <th>מחיקת התוכן</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $get_articles_query = "SELECT * FROM `articles`";
                        if ($get_articles_query_result = $conn->query($get_articles_query)) {
                             while ($article_row = $get_articles_query_result->fetch_assoc()) {
                                $article_name = $article_row["name"];
                                $article_id = $article_row["id"];

                                 echo '
                                       <tr class="table-row">
                                        <td>'.$article_name.'</td>
                                        <td><form action="DeleteArticle.php" method="post"><input name="article_id" type="text" style="display:none;" value="'.$article_id.'"><button style="margin: 0; padding: 4px; border: 1px solid black;" id="delete-button" type="submit" class="btn">לחצו למחיקה</button> </form></td>
                                      </tr>
                                 ';
                             }
                        }
                    ?>
                    
                </tbody>
              </table>
        </div>
        
        
        
        
    </div>

</body>
</html>