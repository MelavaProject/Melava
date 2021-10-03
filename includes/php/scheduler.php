<?php
    session_start();
    require '/home/adidg/vendor/autoload.php';
    require_once "db-connection.php";
    
    // $google_dir =  '/google_api/';
    // $credentials_file_path = $google_dir.'credentials2.json';
    
    $getAllEventsQuery = "SELECT date,start_time FROM events ORDER BY `start_time` ASC";
    $allEvents = $conn->query($getAllEventsQuery);
    while ($event = $allEvents->fetch_assoc()) {
        $allRows[] = $event;
    }
    
    $eventsJson = json_encode($allRows);
    echo '<script>sessionStorage.setItem("events", JSON.stringify('.$eventsJson.'));</script>';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $event_date = test_input($_POST["a_date"]);
        $event_start_time = test_input($_POST["a_hour"]);
        $user_id = $_SESSION['user_id'];
        
        if (empty($user_id)) {
            echo '<script>alert("You should be logged in to the system to continue")</script>';
        } else {
            if (empty($event_date) || empty($event_start_time)) {
                echo '<script>alert("Date and time must be selected")</script>';
            } else {
                 $getEventsQuery = "SELECT date,start_time FROM events WHERE date=$event_date AND start_time=$event_start_time";
                 $eventsResults = $conn->query($getEventsQuery);
                  
                if ($eventsResults->num_rows == 0) {
                    $insertEventsQuery = "INSERT INTO events(date, start_time, user_id) VALUES ('".$event_date."','".$event_start_time."','".$user_id."');";
                    $insertEventsResult = $conn->query($insertEventsQuery);
                    
                    $getEmailQuery = "SELECT email FROM users WHERE id=$user_id";
                    $getEmailResult = $conn->query($getEmailQuery);
                    
                    if ($insertEventsResult == TRUE) {
                        if ($getEmailResult == TRUE) {
                            $userRow = $getEmailResult->fetch_assoc();
                                $userEmail = $userRow['email'];
                                
                                $client = getClient();
                                $service = new Google_Service_Calendar($client);
                                $event = new Google_Service_Calendar_Event(array(
                                  'summary' => 'זימון פגישה בקליניקה של מדריכת הליווי ההתפתחותי',
                                  'location' => 'גבעתיים',
                                  'description' => 'פגישה אישית בנושא התפתחות הילד',
                                  'start' => array(
                                    'dateTime' => $event_date.'T'.$event_start_time.':00',
                                    'timeZone' => 'Israel',
                                  ),
                                  'end' => array(
                                    'dateTime' => $event_date.'T'.$event_start_time.':00',
                                    'timeZone' => 'Israel',
                                  ),
                                  'attendees' => array(
                                    array('email' => $userEmail, 'melavaproject@gmail.com')
                                  ),
                                  'reminders' => array(
                                    'useDefault' => FALSE,
                                    'overrides' => array(
                                      array('method' => 'email', 'minutes' => 24 * 60),
                                      array('method' => 'popup', 'minutes' => 10),
                                    ),
                                  ),
                                ));
                                
                                $calendarId = 'primary';
                                $event = $service->events->insert($calendarId, $event, ['sendUpdates' => 'all']);
        
                                   $getAllEventsQuery = "SELECT date,start_time FROM events ORDER BY `start_time` ASC";
                                $allEvents = $conn->query($getAllEventsQuery);
                                while ($event = $allEvents->fetch_assoc()) {
                                    $allRows[] = $event;
                                }
                                
                                $eventsJson = json_encode($allRows);
                                echo '<script>sessionStorage.setItem("events", JSON.stringify('.$eventsJson.'));</script>';
                                
                                // forward the appointments details to session storage, so we will can use it in js for disable unavailble meetings
                                echo '<script>sessionStorage.setItem("allAppointments", JSON.stringify('.$allAppontmentsJson.'));</script>';
            
                                echo '<script>alert("Success: the appointment is booked. Check your email '.$customerEmail.' for saving the event on your calendar.")</script>';
                                
                        } else {
                            echo '<script>alert("Error: Could not find user email")</script>';
                        }
                    } else {
                        echo '<script>alert("Error: error while trying to save event to DB")</script>';

                    }

                    // update disabled times
                    $getAllEventsQuery = "SELECT date,start_time FROM events";
                    $allEvents = $conn->query($getAllEventsQuery);
                    while ($event = $allEvents->fetch_assoc()) {
                        $allRows[] = $event;
                    }
                    
                    $eventsJson = json_encode($allRows);
                    echo '<script>sessionStorage.setItem("events", JSON.stringify('.$eventsJson.'));</script>';
                    // 
                } else {
                    echo '<script>alert("Error: this appointment is already booked")</script>';
                }
            }
        }
    }
    
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
    function getClient() {
        $client = new Google_Client();
        $client->setApplicationName('Google Calendar API PHP Quickstart');
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        
        // $tokenPath = $google_dir.'token2.json';
       $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }
    
        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim("4/0AX4XfWjqlCQ78ylgk3rPZJNMsgt4znabpaQyt8J3hvUBubUnAvy2rGingJ5MVHHEoSO26w");
    
                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);
    
                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }
?>

<html lang="he">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/CSS/scheduler.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>יומן</title>
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
        
        <form class="form" id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-container" align="center">
              <div>
                <input style="background-color: #bbbbbb;" type="date" id="a_date" name="a_date" readonly>
    
                <label class="form-label" id="valueFromMyButton" for="name">תאריך</label>
              </div>
            <div>
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
            <label class="form-label" id="valueFromMyButton" for="count">שעה</label>
            </div>


            <input type="submit" value="OK" class="button" id="ok-button">
          </div>
        </form>
      </div>
  </div>
</body>
</html>