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
