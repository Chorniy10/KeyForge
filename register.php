<?php
require_once 'KeyManager.php';

$keyManager = new KeyManager('keys.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    if ($username) {
        $apiKey = $keyManager->generateKey($username);
        echo "Your API key: <strong>$apiKey</strong>";
    } else {
        echo "Username is required!";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register API Key</title>
</head>
<body>
<h1>Register API Key</h1>
<form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <button type="submit">Generate API Key</button>
</form>
</body>
</html>
