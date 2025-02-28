<?php
include 'db.php';
session_start();

// Verifica se l'utente è loggato e se è amministratore
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.html'); // Reindirizza se non è amministratore
    exit;
}

$userId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$userId) {
    $error = "Errore: ID utente non specificato o non valido.";
    echo "<div class='alert alert-danger' role='alert'>$error</div>";
    exit;
}

// Preparazione della query
$stmt = $pdo->prepare("SELECT id, username, email, is_admin FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    $error = "Nessun utente trovato con ID: " . htmlspecialchars($userId);
    echo "<div class='alert alert-danger' role='alert'>$error</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Utente</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Modifica Utente</h2>
    <form action="update_user.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="is_admin">Amministratore</label>
            <select class="form-control" id="is_admin" name="is_admin">
                <option value="0" <?php echo ($user['is_admin'] == 0) ? 'selected' : ''; ?>>No</option>
                <option value="1" <?php echo ($user['is_admin'] == 1) ? 'selected' : ''; ?>>Sì</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Aggiorna</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
