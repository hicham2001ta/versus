<?php
include 'config.php'; // Include la configurazione del database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero dati dal modulo
    $mail = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Verifica se le password corrispondono
    if ($password !== $confirm_password) {
        die("Le password non corrispondono. Riprova.");
    }

    // Query SQL con prepared statement
    $stmt = $conn->prepare("INSERT INTO `sign_up` (`mail`, `password`, `conferma password`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $mail, $password, $confirm_password);

    if ($stmt->execute()) {
        echo "Registrazione completata con successo!";
    } else {
        echo "Errore durante la registrazione: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
