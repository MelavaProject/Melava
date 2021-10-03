<?php
session_start();
$google_dir =  '/home/adidg/google_api/';

require $google_dir . 'vendor/autoload.php';

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $credentials_file_path = '/home/adidg/google_api/credentials2.json';
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig($credentials_file_path);
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = '/home/adidg/google_api/token2.json';
    if (file_exists($tokenPath)) {
        //echo("path exists");
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    } else {
        echo ("path does not exist");
        die($tokenPath);
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
            $authCode = trim(fgets(STDIN));

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
    
    $_SESSION['access_token'] = $client->getAccessToken();
    return $client;
}

function getEvents() {
    // Get the API client and construct the service object.
    $client = getClient();
    
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {//if (!$client->isAccessTokenExpired()) {
    
        $service = new Google_Service_Calendar($client);
    
        $calendarId = 'primary';
        $results = $service->events->listEvents($calendarId);
        $events = $results->getItems();
        //return $events;
        $data = [];
        foreach ($events as $event) {
            $start = $event->getStart()->getDateTime();
            if(!$start) { $start = $event->getStart()->getDate(); }
            $end = $event->getEnd()->getDateTime();
            if(!$end) { $end = $event->getEnd()->getDate(); }
            
            $subArr = [
                'id'=>$event->id,
                'title'=>$event->getSummary(),
                'start'=>$start,
                'end'=>$end
                ];
            array_push($data, $subArr);
        }
        return $data;
        
    } else {
        return 'client does not exist';
    }
    
}




