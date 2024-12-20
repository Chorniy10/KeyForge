<?php

class KeyManager {
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode([]));
        }
    }

    public function generateKey($username) {
        $keys = $this->getKeys();

        // Перевірка, чи вже є ключ для цього користувача
        foreach ($keys as $key) {
            if ($key['username'] === $username) {
                return $key['api_key'];
            }
        }

        // Генерація нового унікального ключа
        $apiKey = bin2hex(random_bytes(16));
        $keys[] = [
            'username' => $username,
            'api_key' => $apiKey,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->saveKeys($keys);
        return $apiKey;
    }

    public function validateKey($apiKey) {
        $keys = $this->getKeys();
        foreach ($keys as $key) {
            if ($key['api_key'] === $apiKey) {
                return true;
            }
        }
        return false;
    }

    private function getKeys() {
        return json_decode(file_get_contents($this->filePath), true);
    }

    private function saveKeys($keys) {
        file_put_contents($this->filePath, json_encode($keys, JSON_PRETTY_PRINT));
    }
}
