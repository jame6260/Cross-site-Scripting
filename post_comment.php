<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->username)) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

if (!isset($data->comment)) {
    echo json_encode(['success' => false, 'message' => 'Comment is empty']);
    exit;
}

$username = $data->username;
$comment = $data->comment;

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user) {
    $user_id = $user['id'];

    $stmt = $pdo->prepare("INSERT INTO comments (user_id, comment) VALUES (?, ?)");
    $stmt->execute([$user_id, $comment]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid user']);
}
?>
