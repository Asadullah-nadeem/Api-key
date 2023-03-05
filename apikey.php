<?php
header("Access-Control-Allow-Origin: *");

// //api key
// $apiKey = bin2hex(random_bytes(8)); // generates a 32-character random hexadecimal string

// if (isset($_SERVER['HTTP_X_API_KEY'])) {
//     $apiKey = $_SERVER['HTTP_X_API_KEY'];
// } elseif (isset($_GET['api_key'])) {
//     $apiKey = $_GET['api_key'];
// }

// header('X-API-KEY: ' . $apiKey);

// Define a function to generate a random API key
function generateApiKey() {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = 30;
    $key = '';

    // Generate a random string of characters
    for ($i = 0; $i < $length; $i++) {
        $key .= $chars[rand(0, strlen($chars) - 1)];
    }

    // Check if the key already exists
    if (keyExists($key)) {
        // If it does, generate a new key
        return generateApiKey();
    }

    // If the key does not exist, return it
    return $key;
}

// Define a function to check if a key already exists
function keyExists($key) {
    // You can implement your own method to check if the key exists in a database or file
    // For example, if you store keys in a file, you can use the following code to check:
    // $keys = file('api_keys.txt', FILE_IGNORE_NEW_LINES);
    // return in_array($key, $keys);

    // For simplicity, we'll assume that the key does not exist
    return false;
}
$apiKey = generateApiKey();
if (isset($_SERVER['HTTP_X_API_KEY'])) {
    $apiKey = $_SERVER['HTTP_X_API_KEY'];
} elseif (isset($_GET['api_key'])) {
    $apiKey = $_GET['api_key'];
}
header('API-KEY: ' . $apiKey);

//Json file
$url = 'https://bit.codeaxe.in/AB454244s5d4Dfds54.json';
$json_data = file_get_contents($url);
$data = json_decode($json_data, true);

header('Content-Type: application/json');
echo json_encode($data);
?>
