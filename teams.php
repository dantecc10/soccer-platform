<?php
include_once "php-scripts/functions.php";
session_start();
?>
<!DOCTYPE html>
<html data-bs-theme="dark" lang="es-mx">

<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Equipos - DEPORTEX</title>
    <meta property="og:title" content="DEPORTEX">
    <meta property="og:image" content="https://soccer.castelancarpinteyro.com/assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png">
    <meta name="author" content="Dante Castelán Carpinteyro">
    <meta property="og:type" content="website">
    <meta name="description" content="Plataforma de gestión de ligas de fútbol, consulta de resultados, equipos y jugadores. Administración arbitral.">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20WHITE%20EDITION.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20WHITE%20EDITION.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png">
    <link rel="icon" type="image/png" sizes="2224x2002" href="assets/img/deportex/DEPORTEX%20BLACK%20VERSION.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Staatliches&amp;display=swap'">
    <link rel="stylesheet" href="assets/css/soccer.css">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LTBB1G44GJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LTBB1G44GJ');
</script>
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
    <main class="page product-page main-bg-color submain-color">
        <section id="team-detail" class="custom-font mt-4 pt-4">
            <div class="container">
                <div class="row py-3 submain-bg-color main-color rounded-5">
                    <div class="col col-12 col-md-4 col-lg-6 align-self-center">
                        <div class="row px-3" style="height: 100%;">
                            <div class="col text-center main-bg-color rounded-5" style="max-height: inherit;"><img class="col-10 col-md-11 col-lg-8 col-xxl-7" src="https://upload.wikimedia.org/wikipedia/en/thumb/f/f5/UEFA_Champions_League.svg/1200px-UEFA_Champions_League.svg.png"></div>
                        </div>
                    </div>
                    <div class="col col-12 col-md-8 col-lg-6 align-self-center">
                        <div class="row">
                            <div class="col text-center text-lg-start"><span class="fs-2">Liga</span><span class="fs-4 text-secondary smaller">&nbsp;20 equipos</span></div>
                        </div>
                        <div class="row text-center text-lg-start">
                            <div class="col">
                                <h1 class="fs-1 fw-bolder" style="font-size: 4rem !important;color: white !important;">LIGA DE CAMPEONES</h1>
                            </div>
                        </div>
                        <div class="row text-center text-lg-start">
                            <div class="col"><span class="fs-3">Europa</span></div>
                        </div>
                        <div class="row px-3">
                            <div class="col main-bg-color submain-color rounded-4">
                                <p class="fs-5 text-center text-lg-start">Esta liga es una de las más competitivas en la región y reúne a jugadores de todas las edades.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="teams" class="custom-font mt-4 py-4 main-bg-color">
            <div class="container py-1">
                <div class="row py-4 main-color submain-bg-color rounded-5" style="border: 5px solid var(--submain-background-color);">
                    <div class="col align-self-center text-center py-3">
                        <div class="row">
                            <div class="col">
                                <h3 class="fs-1 fw-bolder" style="font-size: 3rem !important;">Equipos</h3>
                            </div>
                        </div>
                        <div class="row px-3">
                            <div class="col main-bg-color submain-color rounded-4 align-self-center">
                                <p class="fs-5 my-2">Conoce a los equipos que buscarán la gloria en la&nbsp;<span class="submain-bg-color main-color p-2 rounded-4 text-nowrap">Liga de campeones</span></p>
                            </div>
                        </div>
                        <div class="row submain-bg-color py-2 m-2 rounded-4 text-center justify-content-between">
                            <div class="col">
                                <div class="card-group justify-content-between">
                                    <?php include_once "php-scripts/functions.php";
                                    echo (fetch_team_cards()); ?>
                                </div>
                            </div>
                        </div>
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
                        <li><a href="login.php">Iniciar sesión</a></li>
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
    <script src="assets/js/theme.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="assets/js/soccer.js"></script>
</body>

</html>