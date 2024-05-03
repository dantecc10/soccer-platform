<?php
include_once "php scripts/functions.php";
session_start();
if (!isset($_SESSION['id_user']) && !isset($_SESSION['logged_in'])) {
    //header("Location: login.php");
}
?>
<!DOCTYPE html>
<html data-bs-theme="dark" lang="es-mx">

<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Agendar partido - DEPORTEX</title>
    <meta property="og:image" content="https://soccer.castelancarpinteyro.com/assets/img/deportex/DeportEX Gold Edition VFX.png">
    <meta name="author" content="Dante Castelán Carpinteyro">
    <meta name="description" content="Plataforma de gestión de ligas de fútbol, consulta de resultados, equipos y jugadores. Administración arbitral.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="DEPORTEX">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20WHITE%20EDITION.png?h=6baf041d5b489f75a71934a78277e96f" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20WHITE%20EDITION.png?h=6baf041d5b489f75a71934a78277e96f" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="icon" type="image/png" sizes="2224x2002" href="assets/img/deportex/DEPORTEX%20BLACK%20VERSION.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=254a09188e530cb03e8e344c8d2feb3e">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Staatliches&amp;display=swap'">
    <link rel="stylesheet" href="assets/css/soccer.css?h=d5846df3391ee5880ceb80c6b2bc4c74">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top bg-white clean-navbar main-bg-color navbar-light">
        <div class="container"><a class="navbar-brand logo" href="index.php"><img class="bs-icon-sm" src="assets/img/deportex/Dep_Dark.png?h=6baf041d5b489f75a71934a78277e96f" style="max-height: 45px !important;"></a><button data-bs-toggle="collapse" class="navbar-toggler submain-bg-color" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font third-color rem-adjustment" href="/#table"><img src="assets/img/deportex/campeonato.svg?h=75f1c01ec367425d54761cc2d03b86b7">&nbsp;TABLA</a></li>
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font third-color rem-adjustment" href="/#matches"><img src="assets/img/deportex/partidos.svg?h=1fd7a22190fe07882dd12f90bcdafbee">&nbsp;PARTIDOS</a></li>
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font third-color rem-adjustment" href="teams.php"><img src="assets/img/deportex/equipos.svg?h=1fd7a22190fe07882dd12f90bcdafbee">&nbsp;EQUIPOS</a></li>
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font third-color rem-adjustment" href="players.php"><img src="assets/img/deportex/jugadores.svg?h=1fd7a22190fe07882dd12f90bcdafbee">&nbsp;JUGADORES</a></li>
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font main-color rem-adjustment submain-bg-color rounded-3" href="login.php"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-user-circle">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                            </svg>&nbsp;<?php echo ((logged_in()) ? $_SESSION['name_user'] : "Entrar"); ?></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page landing-page" style="background-color: var(--third-background-color);">
        <section id="main" class="clean-block clean-info dark main-color submain-bg-color">
            <div class="container">
                <div class="block-heading mb-1">
                    <h1 class="text-info mb-1 main-color custom-font text-wrap"><span class="fs-3">Agendar un</span>&nbsp;<span>Partido</span></h1>
                    <p class="main-color custom-font">Añade un partido al calendario. Llena la información y asigna ahora o después un árbitro. Los campos con un (*) son obligatorios.</p>
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <form id="add-match-form" class="custom-font" action="php scripts/actions.php?type=add-match" method="post">
                            <div class="col">
                                <?php
                                include "php scripts/soccer_queries.php";
                                $teams = fetch_fields("teams", ['id_team', 'name_team'], null, null);
                                ?>
                                <div class="row fs-5">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-sm-auto col-md-3 justify-content-center fw-bolder fs-5">Selecciona la liga *</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border fs-5" id="league-match" name="league-match" required>
                                                <optgroup label="Ligas disponibles">
                                                    <option>Selecciona una liga</option>
                                                    <option value="1">Liga de Chignahuapan</option>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-sm-auto col-md-3 justify-content-center fw-bolder fs-5">Jornada *</span><input class="form-control color-placeholder main-color submain-bg-color custom-font text-center main-border fs-5" type="number" id="matchday-match" placeholder="Indica la jornada" name="matchday-match" required step="1" min="1"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-sm-auto col-md-3 justify-content-center fw-bolder fs-5">Equipo local *</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border fs-5" id="local-team" name="local-team" required>
                                                <optgroup label="Equipos">
                                                    <option>Selecciona un equipo</option>
                                                    <?php
                                                    for ($i = 0; $i < sizeof($teams); $i++) {
                                                        echo "<option value='" . $teams[$i][0] . "'>" . $teams[$i][1] . "</option>";
                                                    }
                                                    ?>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-sm-auto col-md-3 justify-content-center fw-bolder fs-5">Equipo Visitante *</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border fs-5" id="visitor-team" name="visitor-team" required>
                                                <optgroup label="Equipos">
                                                    <option>Selecciona un equipo</option>
                                                    <?php
                                                    for ($i = 0; $i < sizeof($teams); $i++) {
                                                        echo "<option value='" . $teams[$i][0] . "'>" . $teams[$i][1] . "</option>";
                                                    }
                                                    ?>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-sm-auto col-md-3 justify-content-center fw-bolder fs-5">Fecha *</span><input class="form-control color-placeholder main-color submain-bg-color custom-font text-center main-border fs-5" type="date" id="date-match" name="date-match" required placeholder="Ingresa la fecha"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-sm-auto col-md-3 justify-content-center fw-bolder fs-5">Hora *</span><input class="form-control color-placeholder main-color submain-bg-color custom-font text-center main-border fs-5" type="time" id="time-match" name="time-match" required placeholder="Ingresa la hora"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-sm-auto col-md-3 justify-content-center fw-bolder fs-5">Árbitro</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border fs-5" id="referee-match" name="referee-match">
                                                <?php
                                                $referees = fetch_fields("referees", ['id_referee', 'name_referee', 'last_names_referee'], null, null);
                                                ?>
                                                <optgroup label="Lista de árbitros">
                                                    <option>Selecciona un árbitro</option>
                                                    <?php
                                                    for ($i = 0; $i < sizeof($referees); $i++) {
                                                        echo "<option value='" . $referees[$i][0] . "'>" . $referees[$i][1] . " " . $referees[$i][2] . "</option>";
                                                    }
                                                    ?>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-sm-auto col-md-3 justify-content-center fw-bolder fs-5">Lugar</span><input class="form-control color-placeholder main-color submain-bg-color custom-font text-center main-border fs-5" type="text" id="field-match" placeholder="Complejo, cancha, y/o campo" name="field-match"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2 text-center"><button class="btn main-bg-color submain-color rounded-4 col-8 col-sm-auto fw-bolder fs-3" type="submit">Registrar equipo</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- Start: Footer Dark -->
    <footer class="page-footer dark" style="background: linear-gradient(rgba(173,238,0,0.33), rgba(0,0,0,0.55) 77%, var(--third-background-color)), url(&quot;assets/img/deportex/grass.jpg?h=1fd7a22190fe07882dd12f90bcdafbee&quot;), var(--submain-background-color);">
        <div class="container">
            <div class="row rounded-4" style="background-color: rgba(14,20,1,0.83);">
                <div class="col-sm-3">
                    <h5 style="filter: blur(0px) !important;">Empieza</h5>
                    <ul>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Iniciar sesión</a></li>
                        <li><a href="#">Descargas</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Acerca de</h5>
                    <ul>
                        <li><a href="#">Desarrollador</a></li>
                        <li><a href="#">Contáctanos</a></li>
                        <li><a href="#">Reseña</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Soporte</h5>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Asistencia</a></li>
                        <li><a href="#">Datos</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="#">Términos de uso</a></li>
                        <li><a href="#">Política de privacidad</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright" style="background: rgb(13,27,0);">
            <p>© 2024 Copyright DEPORTEX</p>
        </div>
    </footer><!-- End: Footer Dark -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
    <script src="assets/js/theme.js?h=a083aeb15550c5e1266c666e8a5846d9"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="assets/js/soccer.js?h=d5170f5653b7430ee6b650f6ec0714bf"></script>
</body>

</html>