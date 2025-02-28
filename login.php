<?php
session_start(); // Inizio della sessione

include 'db.php'; // File che contiene la connessione al database

// Lista delle email degli amministratori
$admin_emails = ['admin@example.com', 'anotheradmin@example.com'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login riuscito
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_name'] = $user['username'];
           

            // Verifica se l'email è nella lista degli amministratori
            if ($user['is_admin'] == 1) {
                $_SESSION['is_admin'] = 1; // Imposta l'utente come amministratore
                header("Location: admin_dashboard.php"); // Reindirizza alla dashboard dell'amministratore
            } else {
                $_SESSION['is_admin'] = 0; // Non amministratore
                header("Location: dashboard.php"); // Reindirizza alla dashboard standard
            }

            exit();
        } else {
            // Login fallito
            $_SESSION['error'] = "Credenziali non valide!";
            header("Location: login.html");
            exit();
        }
    } catch (PDOException $e) {
        // Gestione degli errori del database
        $_SESSION['error'] = "Errore del server. Riprova più tardi.";
        header("Location: login.html");
        exit();
    }
}
?>
