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
        $price = trim($_POST["price"]);
        //echo "file to upload:$fileToUpload<br>";
        
        if (empty($name) || empty($content) || empty($devStage) || empty($age) || empty($price)) {
            $error_message = "Name,contact,age,devStage fields must not be empty";
        }
        //$error_message = "fileToUpload: $fileToUpload";
        
        if (save_file($res_message)) {
            $query = "INSERT INTO products(name, content, picture, devStage, age, price) VALUES('$name','$content','$fileToUpload', '$devStage', '$age', $price)";
            //$res_message.= "<br>query: $query<br>";
            //echo("query=".$query);
            $res = $conn->query($query);
            if($res == 1) {$res_message.= "המוצר הועלה בהצלחה!";} else {$res_message.= "שגיאה בהעלאת המוצר!";}
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
        && $imageFileType != "gif") {
          $msg .= "מצטערים, מקבלים רק קובץ תמונה.";
          $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
       
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
    <title>עריכת מוצרים</title>
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
                                <h1>הוספת מוצר</h1>
                            </div>
                        </div>
                        <form action="" method="post" name="addproduct" enctype="multipart/form-data">
                        <!--<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="login">-->
                            <div class="form-group">
                                <label for="name">שם המוצר</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    aria-describedby="emailHelp" placeholder="הוסיפו שם מוצר">
                            </div>
                            <div class="form-group">
                                <label for="content">תוכן המוצר</label>
                                <textarea name="content" id="content" class="form-control"
                                    aria-describedby="emailHelp" placeholder="הוסיפו תיאור מוצר"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="content">מחיר (בשקלים)</label>
                                <input type="number" name="price" id="price" class="form-control"
                                    aria-describedby="emailHelp" placeholder="הוסיפו מחיר" />
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
                                <label for="age">גיל (בחודשים)</label>
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
                            <span class="files"><?php //print_r($_FILES);?></span>
                        </form>
                    </div>
            </div>
        </div>
        
        
          <div id="manage-products-div" style="overflow-y: auto;">
            <div class="col-md-12 text-center">
                <h1>עריכת מוצרים</h1>
                <p>כאן אפשר לערוך מוצרים</p>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th>שם המוצר</th>
                    <th>מחיקת המוצר</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $get_products_query = "SELECT * FROM `products`";
                        if ($get_products_query_result = $conn->query($get_products_query)) {
                             while ($product_row = $get_products_query_result->fetch_assoc()) {
                                $product_name = $product_row["name"];
                                $product_id = $product_row["id"];

                                 echo '
                                       <tr class="table-row">
                                        <td>'.$product_name.'</td>
                                        <td><form action="DeleteProduct.php" method="post"><input name="product_id" type="text" style="display:none;" value="'.$product_id.'"><button style="margin: 0; padding: 4px; border: 1px solid black;" id="delete-button" type="submit" class="btn">לחצו למחיקה</button> </form></td>
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