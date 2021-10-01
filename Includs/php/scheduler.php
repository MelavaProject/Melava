<!DOCTYPE html>

<?php
    require_once "db-connection.php";
?>

<html lang="he">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/CSS/scheduler.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ליווי התפתחותי</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="../../JS/load-common-html.js"></script>
  <!-- Dialog Box-->
  <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous">
  </script>
  <script src="/JS/scheduler.js"></script>
</head>

<body>
    <div id="common-html"></div>
      <div class="content">
    <div class="calendar-container">
      <div class="calendar"> 
        <div class="year-header"> 
          <span class="left-button" id="prev"> &lang; </span> 
          <span class="year" id="label"></span> 
          <span class="right-button" id="next"> &rang; </span>
        </div> 
        <table class="months-table"> 
          <tbody>
            <tr class="months-row">
              <td class="month">Jan</td> 
              <td class="month">Feb</td> 
              <td class="month">Mar</td> 
              <td class="month">Apr</td> 
              <td class="month">May</td> 
              <td class="month">Jun</td> 
              <td class="month">Jul</td>
              <td class="month">Aug</td> 
              <td class="month">Sep</td> 
              <td class="month">Oct</td>          
              <td class="month">Nov</td>
              <td class="month">Dec</td>
            </tr>
          </tbody>
        </table> 
        
        <table class="days-table"> 
          <td class="day">Sun</td> 
          <td class="day">Mon</td> 
          <td class="day">Tue</td> 
          <td class="day">Wed</td> 
          <td class="day">Thu</td> 
          <td class="day">Fri</td> 
          <td class="day">Sat</td>
        </table> 
        <div class="frame"> 
          <table class="dates-table"> 
              <tbody class="tbody">             
              </tbody> 
          </table>
        </div> 
        <button class="button" id="add-button">קביעת פגישה אישית</button>
      </div>
    </div>
    <div class="events-container">
    </div>
    <div class="dialog" id="dialog">
        <h2 class="dialog-header">קביעת פגישה אישית</h2>
        
        <form class="form" id="form">
          <div class="form-container" align="center">
            <input style="background-color: #bbbbbb;" type="date" id="a_date" name="a_date" readonly>

            <label class="form-label" id="valueFromMyButton" for="name">תאריך</label>
            <select name="a_hour" id="a_hour">
                <option id="09:00:00" value="09:00">09:00</option>
                <option id="10:00:00" value="10:00">10:00</option>
                <option id="11:00:00" value="11:00">11:00</option>
                <option id="12:00:00" value="12:00">12:00</option>
                <option id="13:00:00" value="13:00">13:00</option>
                <option id="14:00:00" value="14:00">14:00</option>
                <option id="15:00:00" value="15:00">15:00</option>
                <option id="16:00:00" value="16:00">16:00</option>
                <option id="17:00:00" value="17:00">17:00</option>
                <option id="18:00:00" value="18:00">18:00</option>
            </select>
            <br><br>
            <label class="form-label" id="valueFromMyButton" for="count">שעה</label>

            <input type="button" value="OK" class="button" id="ok-button">
          </div>
        </form>
      </div>
  </div>


</body>
</html>