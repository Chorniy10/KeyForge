<?php
require_once 'KeyManager.php';

header('Content-Type: application/json');

if (!isset($_GET['api_key'])) {
    echo json_encode(['error' => 'API key is missing']);
    exit;
}

$apiKey = $_GET['api_key'];
$keyManager = new KeyManager('keys.json');

if ($keyManager->validateKey($apiKey)) {
    echo json_encode(['success' => 'API key is valid']);
} else {
    echo json_encode(['error' => 'Invalid API key']);
}
