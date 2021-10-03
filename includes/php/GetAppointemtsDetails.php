<?php
    require_once('database.php');
    if (!$database->get_connection())
            die("Connection fails <br>");
    session_start();
   

    
     $phoneNumber= $_SESSION['phoneNumber'];
     
    $sql="select * from events where phoneNumber='".$phoneNumber."'";

    $result = $database->query($sql);
		
		if ($result->num_rows>0)
		{
		    $num=$row['orderNumber'];
			while ($row = $result->fetch_assoc())
			{
				//echo '<tr><td>'.$row['fullName'].'</td>';
			    //echo '<tr><td>'.$row['orderNumber'].'</td>';
				
				if($row['orderNumber']>$num)
				{
				    $num=$row['orderNumber'];
				}
				
			}
		
		}
		
		$sql2="select * from events where orderNumber='".$num."'"; 
		$result = $database->query($sql2);
		if ($result->num_rows>0)
		{
			while ($row = $result->fetch_assoc())
			{
			     '<tr><td>'.$row['orderNumber'].'</td>';
			    '<tr><td>'.$row['phoneNumber'].'</td>';
			    $phoneNumber=$row['phoneNumber'];
			    '<tr><td>'.$row['participants'].'</td>';
			    $participants=$row['participants'];
			    '<tr><td>'.$row['location'].'</td>';
			    $location=$row['location'];
			    '<tr><td>'.$row['type'].'</td>';
			    $type=$row['type'];
			   '<tr><td>'.$row['day'].'</td>';
			    $day=$row['day'];
			 '<tr><td>'.$row['time'].'</td>';
			    $time=$row['time'];
			   '<tr><td>'.$row['hourNumber'].'</td>';
			    $hourNumber=$row['hourNumber'];
			     '<tr><td>'.$row['price'].'</td>';
			    $price=$row['price'];
				
			}
		}
				
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


<link rel="stylesheet" type="text/css" href="../css/styleForAllPage.css">
<link rel="stylesheet" type="text/css" href="../css/PriceStyle.css">
<!-- Bootstrap CSS FOR INVOICE -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>BID OFFER</title>
    

 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lib/jquery-1.11.1.min.js" ></script>
    <script> $(function(){   $("#header").load("../includes/headerAndNav.html"); }); </script>
   <script> $(function(){   $("#footer").load("../includes/Footer.html"); }); </script>
   
    
  </head>
  
  <body>
<!-- HERE WE NEED TO LOAD A HEADER -->

      <header id="header"></header>

		
		
		    
		    
		        
		    
		    


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <main>
        
        <section class="text">
            <h1>THANK YOU</h1>
                    <p><b>
                    What excitement you chose us! We can no longer wait for the event! We have arranged all the details<br>
                    for you in an orderly manner and we will contact you as soon as possible!<br>
                    see you soon</b>
                    </p>
                </section>
<div class="conatiner">
        <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>Joy</strong>
                        <br>
                        Ha-Khalutzim 6
                        <br>
                        Lewinsky Market Tel Aviv
                        <br>
                        <abbr title="Phone">P:</abbr> 04-6249849
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em><b>Date: </b><script> document.write(new Date().toLocaleDateString()); </script> </em>
                    </p>
                    <p>
                        <em><b>Receipt #: </b><?php echo $num?></em>
                         
                    </p>
                </div>
            </div>
           <!-- <div class="row">
                <div class="text-center">
                <h3 class="glow">Mazel Tov! <br> We are so happy that you are here.<br> We save the detailes for your party<br> and a Sales man will call you in the next <br> 48 hours.</h3>
                <br>
                <h4>you can see the summary below.</h4>
                <br><br>
                -->
                
                    <h2>Bid Offer</h2>
                    
                    <br>
                    <h5> Contact Number:<?php echo $phoneNumber?> </h5>
                    <hr>
                 
                
                <table class="table table-hover">
                    <thead>
                    <thead>
                        <tr>
                            <th>Order Summary:</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    
                    </thead>
                    <tbody>
                         <tr>
                            <td class="col-md-9"><em>Location</em></h4></td>
                            <td class="col-md-1 text-center"><?php echo $location?></td></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Participants</em></h4></td>
                            <td class="col-md-1 text-center"><?php echo $participants?></td></td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Type</em></h4></td>
                            <td class="col-md-1" style="text-align: center"><?php echo $type?>  </td>
                            
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Day</em></h4></td>
                            <td class="col-md-1" style="text-align: center"><?php echo $day?>  </td>
                            
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Time</em></h4></td>
                            <td class="col-md-1" style="text-align: center"><?php echo $time?>  </td>
                            
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Number of houers</em></h4></td>
                            <td class="col-md-1" style="text-align: center"><?php echo $hourNumber?>  </td>
                            
                        </tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong><?php echo $price?>$</strong></h4></td>
                        </tr>
                    </tbody>
                    
                </table>
                <hr>
                </div>
                <h4> **The offers is for 14 days from the date above</h4>
            </div>
        </div>
        
        </main>
    	    
</body>
	
</html>
		    