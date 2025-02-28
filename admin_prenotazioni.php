<?php
include 'db.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.html');
    exit;
}

// Prepara la query per ottenere tutte le prenotazioni
$stmt = $pdo->prepare("SELECT * FROM prenotazioni ORDER BY data, orario DESC");
$stmt->execute();
$prenotazioni = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Admin - Lista Prenotazioni</title>
    <!-- Assumi di avere link CSS e JS qui -->
</head>
<body>
<div class="container">
    <h2>Lista Prenotazioni</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo Persona</th>
                <th>Data</th>
                <th>Orario</th>
                <th>Modifica</th>
                <th>Cancella</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prenotazioni as $prenotazione): ?>
            <tr>
                <td><?= htmlspecialchars($prenotazione['id']) ?></td>
                <td><?= htmlspecialchars($prenotazione['tipo_persona']) ?></td>
                <td><?= htmlspecialchars($prenotazione['data']) ?></td>
                <td><?= htmlspecialchars($prenotazione['orario']) ?></td>
                <td><button onclick="modificaPrenotazione('<?= $prenotazione['id'] ?>')">Modifica</button></td>
                <td><button onclick="cancellaPrenotazione('<?= $prenotazione['id'] ?>')">Cancella</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="js/jquery.min.js"></script>
<script>
function modificaPrenotazione(idPrenotazione) {
    window.location.href = 'edit_prenotazione.php?id=' + idPrenotazione;
}

function cancellaPrenotazione(idPrenotazione) {
    if(confirm('Sei sicuro di voler cancellare questa prenotazione?')) {
        $.ajax({
            url: 'delete_prenotazione.php',
            type: 'POST',
            data: {id: idPrenotazione},
            success: function(response) {
                alert('Prenotazione cancellata!');
                location.reload();
            }
        });
    }
}
</script>
</body>
</html>
