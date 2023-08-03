<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['code'])) {
    echo 'no code';
    exit();
}

$discord_code = $_GET['code'];

$payload = [
    'code' => $discord_code,
    'client_id' => '1136323498306961489',
    'client_secret' => 'l5yccRpWT9oq0tB7EiuV_9vT_fEibm-u',
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'http://127.0.0.1/new_dashboard/process-oauth.php',
    'scope' => 'identify%20guilds%20email',
];

echo "Payload: <pre>";
print_r($payload);
echo "</pre>";

$payload_string = http_build_query($payload);
$discord_token_url = "https://discordapp.com/api/oauth2/token";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $discord_token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

if (!$result) {
    echo curl_error($ch);
    exit();
}

$result = json_decode($result, true);

if (isset($result['error'])) {
    echo "Error: " . $result['error'];
    exit;
}

$access_token = $result['access_token'];

$discord_users_url = "https://discordapp.com/api/users/@me";
$header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $discord_users_url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

$result = json_decode($result, true);

echo "Token API Response: <pre>";
print_r($result);
echo "</pre>";

session_start();

$_SESSION['logged_in'] = true;
$_SESSION['userData'] = [
    'name' => $result['username'],
    'discord_id' => $result['id'],
    'avatar' => $result['avatar'],
];

exit();
?>
