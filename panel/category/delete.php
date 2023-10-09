<?php
require_once '../../bootstrap/init.php';
if (isset($_GET['id'])) {
    global $pdo;
    $sql = "DELETE FROM categories WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
}

redirect('/panel/category');
