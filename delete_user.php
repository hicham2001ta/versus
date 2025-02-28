<?php
include 'db.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.html'); // Solo gli amministratori possono eliminare gli utenti
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $userId = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $result = $stmt->execute([$userId]);

    if ($result) {
        $msg = "Utente eliminato con successo.";
    } else {
        $msg = "Si è verificato un errore nell'eliminazione dell'utente.";
    }
    $_SESSION['message'] = $msg;
    header("Location: users_list.php"); // Reindirizza indietro alla lista degli utenti
    exit;
} else {
    header("Location: users_list.php"); // Reindirizza se non ci sono dati POST validi
    exit;
}
?>
