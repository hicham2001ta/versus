<?php
session_start();
require 'db.php';

if(isset($_POST['id'])) {
    $idPrenotazione = $_POST['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM prenotazioni WHERE id = :id");
        $stmt->bindParam(':id', $idPrenotazione, PDO::PARAM_INT);
        $stmt->execute();
        echo "Prenotazione cancellata con successo!";
    } catch (PDOException $e) {
        echo "Errore: " . $e->getMessage();
    }
}
?>
