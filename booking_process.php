<?php
session_start();
require 'db.php';

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Accesso non autorizzato'); window.location.href='login.html';</script>";
    exit;
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set and not empty
    if (empty($_POST['activities']) || empty($_POST['date']) || empty($_POST['time'])) {
        $_SESSION['error'] = "Tutti i campi sono richiesti.";
        header('Location: error_page.php');
        exit;
    }

    // Function to convert date from dd/mm/yyyy to yyyy-mm-dd
    function convertDate($dateString) {
        $dateParts = explode('/', $dateString);
        if (count($dateParts) === 3) {
            // Assuming the date format is dd/mm/yyyy
            list($day, $month, $year) = $dateParts;
            // Convert to MySQL date format yyyy-mm-dd
            return $year . '-' . $month . '-' . $day;
        }
        return false;
    }

    // Sanitize and prepare variables
    $tipo_persona = filter_input(INPUT_POST, 'activities', FILTER_SANITIZE_STRING);
    $data = convertDate($_POST['date']); // Use the convertDate function to reformat the date
    if (!$data) {
        $_SESSION['error'] = "Formato data non valido.";
        header('Location: error_page.php');
        exit;
    }
    $orario = $_POST['time'];
    $id_utilisatore = $_SESSION['user_id'];

    // Prepare SQL query using PDO
    $sql = "INSERT INTO prenotazioni (tipo_persona, data, orario, id_utilisatore) VALUES (:tipo_persona, :data, :orario, :id_utilisatore)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tipo_persona', $tipo_persona, PDO::PARAM_STR);
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        $stmt->bindParam(':orario', $orario, PDO::PARAM_STR);
        $stmt->bindParam(':id_utilisatore', $id_utilisatore, PDO::PARAM_INT);

        $stmt->execute();
        $_SESSION['success'] = "Prenotazione effettuata con successo!";
        header('Location: dashboard.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Errore durante la prenotazione: " . $e->getMessage();
        header('Location: error_page.php');
        exit;
    }
} else {
    // Handle non-POST access
    $_SESSION['error'] = "Accesso non autorizzato.";
    header('Location: login.html');
    exit;
}

?>
