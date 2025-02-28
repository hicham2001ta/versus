<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Query per recuperare le prenotazioni dell'utente
try {
    $stmt = $pdo->prepare("SELECT * FROM prenotazioni WHERE id_utilisatore = :user_id ORDER BY data, orario DESC");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $prenotazioni = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Errore nella query: " . $e->getMessage();
    exit;
}
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
?>

<!DOCTYPE HTML>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Themify Icons-->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Bootstrap DateTimePicker -->
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
        <script src="js/respond.min.js"></script>
    <![endif]-->

    <style>
        .welcome-message {
            font-size: 200% !important;
            font-weight: 400 !important;
            margin-top: -40px !important;
            text-align: left !important;
            color: #ffffff !important;
            top: 100px;
        }

        .welcome-subtext {
            font-size: 40px !important;
            font-weight: 300 !important;
            color: #f5f5f5 !important;
        }
        .gtco-container {
            position: relative;
        }

        .welcome-message {
            position: absolute;
            top: 200px;
            left: 0;
            right: 0;
            margin-top: 0;
            font-size: 2rem;
            color: #ffffff;
            text-align: center;
        }
        /* Stili per l'header */
#gtco-header, .gtco-cover {
    padding: 20px 0; /* Riduci il padding verticale per ridurre l'altezza */
    min-height: 250px; /* Riduci l'altezza minima se è troppo alta */
    background-size: cover; /* Assicurati che lo sfondo copra l'area ridimensionata */
}

/* Stili per le sezioni della dashboard */
.gtco-container, .custom-panel, .form-wrap {
    padding: 15px; /* Riduci il padding per comprimere lo spazio */
    margin-top: 10px; /* Riduci il margine superiore se necessario */
}

/* Miglioramenti per le tabelle */
.custom-table {
    width: 80%; /* Controlla la larghezza per evitare eccesso orizzontale */
    margin: 10px auto; /* Riduci il margine per avvicinare la tabella alle altre sezioni */
}

.custom-panel {
    margin-top: 10px; /* Riduci il margine superiore dei pannelli per spazi più stretti */
}

/* Aggiustamenti del testo e dell'elemento del form */
input, select, .btn {
    height: 40px; /* Standardizza l'altezza degli elementi del form per uniformità */
    padding: 5px 10px; /* Riduci il padding interno */
}

/* Modifica del testo per adattarsi a spazi più piccoli */
h1, h2, h3 {
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    line-height: 1.2; /* Rendi le linee di testo più vicine tra loro */
}

/* Aggiustamenti specifici se necessario per mantenere l'armonia del layout */
.custom-panel h2, .form-wrap h3 {
    font-size: 18px; /* Riduci la dimensione del font per le intestazioni nei pannelli */
}
.custom-panel {
    background: #333; /* Sfondo scuro per visibilità */
    border-radius: 6px;
    padding: 20px;
    margin: 20px auto;
    overflow: hidden;
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
}

.custom-table th, .custom-table td {
    padding: 12px;
    text-align: left;
}

.custom-table th {
    background-color: #007BFF; /* Intestazioni blu */
    color: white;
}

.custom-table td {
    background-color: white;
    color: black;
}

.custom-table tbody tr:nth-child(odd) {
    background-color: #f0f0f0;
}
/* Base del pannello per la tabella */
/* Contenitore della tabella */
.table-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-top: 20px;
}

/* Stile della tabella */
.custom-table {
    width: 95%; /* Occupa quasi tutta la larghezza disponibile */
    max-width: 1100px; /* Aumenta la dimensione massima */
    border-collapse: collapse;
    background-color: white;
    color: black;
    font-size: 1.6rem !important; /* Testo più grande */
    text-align: center;
}

/* Intestazioni della tabella */
.custom-table th {
    background-color: #007BFF;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 1.8rem !important; /* Testo più grande */
}

/* Celle della tabella */
.custom-table td {
    padding: 18px;
    border-bottom: 1px solid #ddd;
    font-size: 1.6rem !important; /* Testo leggibile */
}

/* Pulsante Cancella */
button {
    padding: 14px 22px;
    font-size: 1.6rem !important;
    border-radius: 8px;
    background-color: #ff4d4d;
    color: white;
    border: none;
    transition: all 0.3s ease;
}

button:hover {
    background-color: #e60000;
    cursor: pointer;
}
/* Allineamento centrato delle celle */
.custom-table th, .custom-table td {
    text-align: center !important; /* Centra il testo */
    vertical-align: middle; /* Centra verticalmente */
}

/* Miglioramento dell'allineamento del bottone "Cancella" */
.custom-table td:last-child {
    text-align: center !important;
}

    </style>
    
</head>
<body>
    <div class="gtco-loader"></div>
    <div id="page">
        <!-- Navigation Bar -->
        <nav class="gtco-nav" role="navigation">
            <div class="gtco-container">
                <div class="row">
                    <div class="col-sm-4 col-xs-12">
                        <div id="gtco-logo"><a href="index.html">VERSUS <em>.</em></a></div>
                    </div>
                    <div class="col-xs-8 text-right menu-1">
                        <ul>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="gtco-container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0 text-left">
                        <div class="row row-mt-15em">
                            <div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
                                <span class="intro-text-small">Benvenuto a versus</span>
                                <h1 class="cursive-font">VERSUS</h1>
                                <h1 class="welcome-message" style="margin-top: -1000px;">Benvenuto nella tua dashboard, <?php echo $_SESSION['user_name']; ?>!</h1>
                                <?= $message; ?>
                            </div>
                            <div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
                                <div class="form-wrap">
                                    <div class="tab-content">
                                        <div class="tab-content-inner active" data-content="signup">
                                            <h3 class="cursive-font">Prenotazione</h3>
                                            <form action="booking_process.php" method="POST">
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="activities">Persons</label>
                                                        <select name="activities" id="activities" class="form-control">
                                                            <option value="esperienza vr">Esperienza VR</option>
                                                            <option value="pc gaming">Pc Gaming</option>
                                                            <option value="sim-racing">Sim-Racing</option>
                                                            <option value="ps5">Ps5</option>
                                                            <option value="streaming studio">Streaming studio</option>
                                                            <option value="Booling">Booling</option>
                                                            <option value="karaoke">karaoke</option>
                                                            <option value="Biliardo">Biliardo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="date">Date</label>
                                                        <input type="text" id="date" name="date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#date"/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="time">Time</label>
                                                        <input type="text" id="time" name="time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#time"/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <input type="submit" class="btn btn-primary btn-block" value="Reserve Now">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </header>
        
        <div class="gtco-container" style="margin-top: 50px;">
   
    <div class="custom-panel">
    <h2 class="panel-title">Prenotazioni Recenti</h2>
    <div class="panel-body">
    <div class="gtco-container" style="margin-top: 50px;">
    <div class="custom-panel">
        <h2 class="panel-title"></h2>
        <div class="panel-body">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Attività</th>
                        <th>Data</th>
                        <th>Orario</th>
                        <th>Cancella</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($prenotazioni)) : ?>
                        <?php foreach ($prenotazioni as $prenotazione) : ?>
                            <tr>
                                <td><?= htmlspecialchars($prenotazione['tipo_persona']) ?></td>
                                <td><?= htmlspecialchars($prenotazione['data']) ?></td>
                                <td><?= htmlspecialchars($prenotazione['orario']) ?></td>

                                <td><button onclick="cancellaPrenotazione('<?= $prenotazione['id'] ?>')">Cancella</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Nessuna prenotazione trovata.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    </div>
</div>
</div>
<script type="text/javascript">
    function cancellaPrenotazione(idPrenotazione) {
        if(confirm('Sei sicuro di voler cancellare questa prenotazione?')) {
            $.ajax({
                url: 'cancella_prenotazione.php', // Assicurati che questo script esista e gestisca la cancellazione
                type: 'POST',
                data: {id: idPrenotazione},
                success: function(response) {
                    alert('Prenotazione cancellata!');
                    location.reload(); // Ricarica la pagina per aggiornare la lista delle prenotazioni
                }
            });
        }
    }

    function modificaPrenotazione(idPrenotazione) {
        window.location.href = 'edit_prenotazione.php?id=' + idPrenotazione; // Assicurati che questa pagina esista per gestire la modifica
    }
</script>



        <footer id="gtco-footer" role="contentinfo" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row row-pb-md">
            <div class="col-md-12 text-center">
                <div class="gtco-widget">
                    <h3>Get In Touch</h3>
                    <ul class="gtco-quick-contact">
                        <li><a href="#"><i class="icon-phone"></i> 3801356055</a></li>
                        <li><a href="#"><i class="icon-mail2"></i> versus.gaming@gmail.com</a></li>
                        <li><a href="#"><i class="icon-chat"></i> Discord</a></li>
                    </ul>
                </div>
                <div class="gtco-widget">
                    <h3>Get Social</h3>
                    <ul class="gtco-social-icons">
                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-instagram"></i></a></li>
                        <li><a href="#"><i class="icon-discord"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.countTo.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script src="js/main.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#date').datetimepicker({
                format: 'L'
            });
            $('#time').datetimepicker({
                format: 'LT'
            });
        });
    </script>
</body>
</html>