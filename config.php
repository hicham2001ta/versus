<?php
$servername = "localhost"; // Host del server
$username = "root";        // Nome utente MySQL
$password = "";            // Password MySQL
$dbname = "test";          // Nome del database

// Connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo connessione
if ($conn->connect_error) {    
    die("Connessione fallita: " . $conn->connect_error);
}
?>