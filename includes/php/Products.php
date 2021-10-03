<?php
    require_once "db-connection.php";
    session_start();
    $link = "/includes/php/sign-up.php";
    $sql="select * from products";

    $result = $conn->query($sql);
	$products = "";
	if ($result->num_rows>0)
	{
	    $products = "<div id='products'>";
		while ($row = $result->fetch_assoc())
		{
			$name = $row['name'];
		    $content = $row['content'];	
		    $file_path = $row['picture'];
		    $price = $row['price'];
		    $age = $row['age'];
		    $devStage = $row['devStage'];
		    //echo "DEBUG $name";
		     if(isset($_SESSION['user_id']) && $_SESSION['user_id']!= "") {$link = "/includes/php/AddToCart.php?id=".$row['id'];}
		    $products .= "<a href='$link'><div class='product'><h3>$name</h3><div class='content'>$content<br>מחיר: $price<br> לטווח גילאים: $age<br> בשלב התפתחות: $devStage</div>";
		    if($file_path != "") {
		        $file_path = "/media/uploads/$file_path";
		        // $products .= "<a href='$file_path' target='_blank'><img src='/media/images/pdf_icon.jpg' width='40' /></a>";
		         $products .= "<a href='$link'><img src='$file_path' width='200'></a>";
		    }
		    $products .= "</a></div>";
			
		}
		$products .= "</div>";
	
	}
	
?>
<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/CSS/forms.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>קטלוג מוצרים</title>
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
       
        <h3 class="margin">קטלוג מוצרים
           <!--<a href="Cart.php"><div style="border:solid 1px;width:10%;height: 10%;"><img src="/media/images/cart.png"  style="display:inline;margin-right:1%;" alt="Cart" width="35" align="right"></div></a>-->
           <a href="Cart.php"><img src="/media/images/cart.png"  style="display:inline;" alt="Cart" width="35" align="right"></a>
        </h3>
        
        <img src="/media/images/mothershopping.jpg" class="img-responsive img-circle margin" style="display:inline" alt="mom-shopping" width="350" height="350">
        <div>
                <h3>
                    להוספת מוצר לעגלה לחצו על המוצר (לרשומים בלבד)
                </h3>
        </div>
        <?= $products; ?>
    </div>
    

</body>
</html>