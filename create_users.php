<?php
require 'db.php';

$users = [
    ['username' => 'admin', 'password' => 'admin123', 'role' => 'admin'],
    ['username' => 'user1', 'password' => 'hello123', 'role' => 'user'],
    ['username' => 'user2', 'password' => 'hello123', 'role' => 'user']
];

foreach ($users as $user) {
    $hashedPassword = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user['username'], $hashedPassword, $user['role']]);
}

echo "Users have been created successfully!";
?>
