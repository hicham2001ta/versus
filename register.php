<?php
session_start(); // Avvia la sessione all'inizio del file
include 'db.php';  // Include the database connection

$message = ''; // Variabile per memorizzare i messaggi di errore o successo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    try {
        $sql = "INSERT INTO users ( username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $password]);
        
        $_SESSION['success'] = "Registrato con successo!";
    } catch (Exception $e) {
        $_SESSION['error'] = "La registrazione non è riuscita: " . $e->getMessage();
    }
}

// Controlla se ci sono messaggi di errore o successo nella sessione
if (isset($_SESSION['error'])) {
    $message = '<div class="alert alert-danger text-center">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
} elseif (isset($_SESSION['success'])) {
    $message = '<div class="alert alert-success text-center">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}

echo $message; // Mostra il messaggio
?>

