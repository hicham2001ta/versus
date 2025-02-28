<?php
include 'db.php';
session_start();

// Controlla i permessi
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = trim($_POST['username']); // Rimuove spazi bianchi ai lati
    $email = trim($_POST['email']);
    $is_admin = $_POST['is_admin'];

    // Validazione dei dati
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Formato email non valido.";
        header('Location: edit_user.php?id=' . $id);
        exit;
    }

    if ($is_admin != '0' && $is_admin != '1') {
        $_SESSION['error'] = "Valore non valido per amministratore.";
        header('Location: edit_user.php?id=' . $id);
        exit;
    }

    // Aggiornamento dei dati nel database
    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, is_admin = ? WHERE id = ?");
    if (!$stmt->execute([$username, $email, $is_admin, $id])) {
        $_SESSION['error'] = "Errore nell'aggiornamento dell'utente: " . htmlspecialchars($stmt->errorInfo()[2]);
        header('Location: edit_user.php?id=' . $id);
        exit;
    }

    $_SESSION['success'] = "Utente aggiornato con successo.";
    header('Location: users_list.php'); // Reindirizza alla lista degli utenti dopo l'aggiornamento
    exit;
}
?>
