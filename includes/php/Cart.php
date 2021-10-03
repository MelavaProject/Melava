<?php
    require_once "db-connection.php";
    session_start();
    if(!isset($_SESSION['user_id']) || $_SESSION['user_id']== "") {
        echo '<script>
                 alert("משתמש אינו רשום. מוזמנים להירשם");
                 window.location = "/includes/php/sign-up.php";
                </script>';
        exit();
    }
    
    
    $sql="SELECT * FROM cartProducts cp INNER JOIN carts c ON cp.cartID=c.id INNER JOIN products p ON p.id=cp.productID WHERE c.user_id=". $_SESSION['user_id']." AND status='active'";

    $result = $conn->query($sql);

	
?>
<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/CSS/forms.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>עגלת קניות</title>
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
        <h3 class="margin">עגלת קניות</h3>
        <img src="/media/images/motherwithcart.jpg" class="img-responsive img-circle margin" style="display:inline" alt="motherwithcart" width="350" height="350">
      
           <div id="manage-products-div" style="overflow-y: auto;">
            <?php if($result): ?>
                <div class="col-md-12 text-center">
                    <h2>
                       פירוט תוכן העגלה
                    </h2>
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th>שם המוצר</th>
                        <th>מחיר המוצר</th>
                        <th>מספר פריטים </th>
                        <th>מחיקת המוצר</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                             $sum = 0;
                             //loop through cart products
                             while ($product_row = $result->fetch_assoc()) {
                                $product_name = $product_row["name"];
                                $product_id = $product_row["id"];
                                $price =  $product_row["price"];
                                $numOfItems =  $product_row["numOfItems"];
                                $cart_id = $product_row["cartID"];
                                 echo '
                                       <tr class="table-row">
                                        <td>'.$product_name.'</td>
                                        <td>'.$price.'</td>
                                        <td>'.$numOfItems.'</td>
                                        <td><form action="DeleteProductFromCart.php" method="get"><input name="cart_id" type="text" style="display:none;" value="'.$cart_id.'"><input name="product_id" type="text" style="display:none;" value="'.$product_id.'"><button style="margin: 0; padding: 4px; border: 1px solid black;" id="delete-button" type="submit" class="btn">לחצו למחיקה</button> </form></td>
                                      </tr>
                                 ';
                                $sum = $sum + ($price*$numOfItems);
                             }
                           
                        ?>
                        
                    </tbody>
                  </table>
            </div>
            <br>
            <a href="MakePayment.php">
            סכום העגלה: <?=$sum; ?><br>
           בצע רכישה
            </a><br>
             <a href="DeleteCart.php">מחק עגלה</a>
            
        <?php else: ?>
            <div>העגלה ריקה. מוזמנים לבחור מוצרים בעמוד הקטלוג</div>
        <?php endif; ?>
    </div>
    

</body>
</html>