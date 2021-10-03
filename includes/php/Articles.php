<?php
    require_once "db-connection.php";
     
    $sql="select * from articles order by date desc";

    $result = $conn->query($sql);
	$articles = "אין מאמרים להצגה";
	if ($result->num_rows>0)
	{
	    $articles = "<div id='articles'>";
		while ($row = $result->fetch_assoc())
		{
			$name = $row['name'];
		    $content = $row['content'];	
		    $file_path = $row['file_path'];
		    $date = $row['date'];
		    $age = $row['age'];
		    $devStage = $row['devStage'];
		    //echo "DEBUG $name";
		    $articles .= "<div class='article'><h3>$name</h3><div class='content'>$content<br>עלה בתאריך: $date<br> לטווח גילאים: $age<br> בשלב התפתחות: $devStage</div>";
		    if($file_path != "") {
		        $file_path = "/media/uploads/$file_path";
		         $articles .= "<a href='$file_path' target='_blank'><img src='/media/images/pdf_icon.jpg' width='40'></a>";
		    }
		    $articles .= "</div>";
			
		}
		$articles .= "</div>";
	
	}
	
?>
<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/CSS/forms.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>תכנים</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>-->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="../../JS/load-common-html.js"></script>

</head>

<body class="bg-1">
    <div id="common-html"></div>
    
    <div class="container-fluid bg-1 text-center">
        <h3 class="margin">תכנים - מאמרים</h3>
        <img src="/media/images/read.jpg" class="img-responsive img-circle margin" style="display:inline" alt="ReadingMotherPic" width="350" height="350">
        <?= $articles; ?>
    </div>
    

</body>
</html>