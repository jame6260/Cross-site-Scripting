<?php
require 'db.php';


$stmt = $pdo->query("SELECT comments.comment, users.username FROM comments JOIN users ON comments.user_id = users.id");
$comments = $stmt->fetchAll();

echo json_encode($comments);
?>
