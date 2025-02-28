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

    $stmt = $pdo->prepare("INSERT INTO prenotazioni (tipo_persona, data, orario) VALUES (?, ?, ?)");
    if ($stmt->execute([$tipo_persona, $data, $orario])) {
        header('Location: lista_prenotazioni.php');
    } else {
        echo "Errore nell'aggiunta della prenotazione.";
    }
}
?>
