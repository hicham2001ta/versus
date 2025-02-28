<?php
include 'db.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo_persona = $_POST['tipo_persona'];
    $data = $_POST['data'];
    $orario = $_POST['orario'];
    $id_utilistore = $_POST['id_utilistore'];

    // Verifica che il campo id_utilistore sia stato inviato
    if (!isset($id_utilistore) || empty($id_utilistore)) {
        die("Errore: ID Utente non specificato.");
    }

    $stmt = $pdo->prepare("INSERT INTO prenotazioni (tipo_persona, data, orario, id_utilistore) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$tipo_persona, $data, $orario, $id_utilistore])) {
        header('Location: lista_prenotazioni.php');
    } else {
        echo "Errore nell'aggiunta della prenotazione.";
    }
}
?>
