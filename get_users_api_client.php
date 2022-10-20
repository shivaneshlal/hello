<?php

$curl = curl_init();

$domain = 'moodle url'
$wsfun = 'core_user_get_users';
$wstoken = 'token';
$user = 'user';

curl_setopt_array($curl, [
    CURLOPT_URL => ''.$doamin.'/webservice/rest/server.php?wsfunction='.$wsfun.'&wstoken='.$wstoken.'&criteria[0][key]=username&criteria[0][value]='.$user.'&moodlewsrestformat=json',
    CURLOPT_RETURNTRANSFER => true
]);
$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);

echo $data['users'][0]['id']. "<br>";
echo $data['users'][0]['username']. "<br>";
echo $data['users'][0]['email']. "<br>";
//$data = var_dump($response);


//$data = json_encode($response);

//$nuni = var_dump($response);



 //$object = (object) $response ;



// $obj = new stdClass(); //convert array response to array
//         foreach ((array) $o  as $res => $usr){
//             $obj->$res = $usr;
            
//             echo "Checking for user: ". $usr->firstname . " ". $usr->lastname . " ". $usr->email . "<br><br>";
//         }

