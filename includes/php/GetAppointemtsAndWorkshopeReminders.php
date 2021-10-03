<?php
 echo "start";
 Get_AppointemtsAndWorkshopeReminders(
        $_POST['gen child-gender">'],
        $_POST['gen child-name'],
        $_POST['doc-date'],
        $_POST['gen child-birth'],
        $_POST['gen child-IDnum'],

    );
     echo "called";

require_once('../includes/Database.php');
function add_event($CustFirstName,$CustLastName,$CustEmail,$CustMobile,$EventDate,$TotalInvitations,$NumOfVegans,$NumOfVegies) {
     echo "inside add_event";
     $host = "localhost";
     $user = "karinada_galbas";
     $pass = "Aa123456";
     $db = "karinada_ResturantsRecomendations";

     $conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection faileddddddd: " . $conn->connect_error);
}

?>
    


