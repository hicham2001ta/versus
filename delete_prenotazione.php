<?php
include 'db.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM prenotazioni WHERE id = ?");
    $stmt->execute([$id]);

    // Reindirizza alla lista senza messaggi
    header('Location: lista_prenotazioni.php');
    exit;
}
?>
