<?php
include 'db.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.html');
    exit;
}

$stmt = $pdo->prepare("SELECT id, tipo_persona, data, orario FROM prenotazioni");
$stmt->execute();
$prenotazioni = $stmt->fetchAll();

$success = $_GET['success'] ?? null;
$error = $_GET['error'] ?? null;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Prenotazioni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .container {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">Lista Prenotazioni</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="add_prenotazione.php" method="post" class="mb-3">
        <div class="input-group mb-3">
            <select name="tipo_persona" class="form-select" required>
                <option value="">Seleziona il tipo</option>
                <option value="esperienza VR">Esperienza VR</option>
                <option value="karaoke">Karaoke</option>
                <option value="sala giochi">Sala Giochi</option>
            </select>
            <input type="date" name="data" class="form-control" required>
            <input type="time" name="orario" class="form-control" required>
            <button type="submit" class="btn btn-success">Aggiungi</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>TOT Prenotazioni</th>
                <th>Esperienza</th>
                <th>Data</th>
                <th>Orario</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prenotazioni as $prenotazione): ?>
            <tr>
                <td><?= htmlspecialchars($prenotazione['id']) ?></td>
                <td><?= htmlspecialchars($prenotazione['tipo_persona']) ?></td>
                <td><?= htmlspecialchars($prenotazione['data']) ?></td>
                <td><?= htmlspecialchars($prenotazione['orario']) ?></td>
                <td>
                    <form action="delete_prenotazione.php" method="post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($prenotazione['id']) ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
