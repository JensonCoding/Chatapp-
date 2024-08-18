<?php
$filename = 'chat.json';

// Load existing messages
$messages = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];

// Handle new messages
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $newMessage = [
        'timestamp' => date('Y-m-d H:i:s'),
        'message' => htmlspecialchars($_POST['message'])
    ];
    $messages[] = $newMessage;
    file_put_contents($filename, json_encode($messages));
}

// Return messages as JSON
header('Content-Type: application/json');
echo json_encode($messages);
?>
