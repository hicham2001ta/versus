<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Amministratore</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('path_to_your_background_image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.8); /* Sfondo semi-trasparente */
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
        }
        .btn-primary, .btn-danger {
            margin: 5px;
        }
        h2 {
            border-bottom: 2px solid #4CAF50; /* Linea colorata sotto l'intestazione */
        }
        a {
            color: #4CAF50;
        }
        #gtco-footer {
            color: white;
            position: relative;
            padding: 50px 0;
            background-image: url('images/img_bg_1.jpg');
            background-size: cover;
            background-attachment: fixed;
        }
        #gtco-footer .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .gtco-container {
            position: relative;
            z-index: 2;
        }
        .gtco-quick-contact li a {
            color: #fff;
        }
        .gtco-social-icons li a {
            display: inline-block;
            height: 40px;
            width: 40px;
            background: #333333;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color: white;
            font-size: 20px;
        }
        .gtco-social-icons li a:hover {
            background: #55acee;
            color: white;
        }
        /* Stile generale */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #2c3e50, #4ca1af); /* Sfumatura moderna */
    color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Contenitore principale della dashboard */
.dashboard-container {
    background: #1e1e1e;
    border-radius: 12px;
    padding: 30px;
    width: 400px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
    text-align: center;
    transition: transform 0.3s ease-in-out;
}

.dashboard-container:hover {
    transform: translateY(-5px);
}

/* Titolo della dashboard */
.dashboard-container h2 {
    font-size: 22px;
    margin-bottom: 20px;
    color: #00d9ff;
}

/* Bottone Logout */
.btn-logout {
    background:rgb(236, 206, 204);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

.btn-logout:hover {
    background: #ff5c5c;
}

/* Contenitore dei pulsanti */
.button-container {
    margin-top: 20px;
}

/* Bottoni per la gestione utenti */
.btn {
    display: inline-block;
    text-decoration: none;
    background: #4CAF50;
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
    margin: 10px;
    border: none;
    cursor: pointer;
}

.btn:hover {
    background: #45a049;
    transform: scale(1.05);
}

/* Per dispositivi mobili */
@media (max-width: 600px) {
    .dashboard-container {
        width: 90%;
        padding: 20px;
    }

    .btn {
        width: 100%;
    }
}

    </style>
</head>
<body>
<div class="container">
    <h2>Dashboard Amministratore</h2>
    <button onclick="location.href='logout.php'" class="btn btn-primary">Logout</button>
    <h3>Gestione Utenti</h3>
    <button onclick="location.href='users_list.php'" class="btn btn-success">Lista Utenti</button>
    <button onclick="location.href='lista_prenotazioni.php'" class="btn btn-success">prenotazioni</button>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
