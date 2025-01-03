<?php
include_once "php-scripts/functions.php";

session_start();
?>
<!DOCTYPE html>
<html data-bs-theme="dark" lang="es-mx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Inicio - DEPORTEX</title>
    <link rel="canonical" href="https://soccer.castelancarpinteyro.com/exporting/">
    <meta property="og:url" content="https://soccer.castelancarpinteyro.com/exporting/">
    <meta property="og:image" content="https://soccer.castelancarpinteyro.com/assets/img/deportex/DeportEX Gold Edition VFX.png">
    <meta name="author" content="Dante Castelán Carpinteyro">
    <meta name="description" content="Plataforma de gestión de ligas de fútbol, consulta de resultados, equipos y jugadores. Administración arbitral.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="DEPORTEX">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20WHITE%20EDITION.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20WHITE%20EDITION.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png">
    <link rel="icon" type="image/png" sizes="2224x2002" href="assets/img/deportex/DEPORTEX%20BLACK%20VERSION.png">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Staatliches&amp;display=swap'">
    <link rel="stylesheet" href="assets/css/soccer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "WebSite",
            "name": "DEPORTEX",
            "url": "https://soccer.castelancarpinteyro.com"
        }
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LTBB1G44GJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-LTBB1G44GJ');
    </script>
    <script>
        //        function update_event_data(mode) {
        //            var xhr = new XMLHttpRequest();
        //            var url = 'php-scripts/actions.php?type=update-event-data';
        //
        //            var data = {
        //                numero: Math.random();
        //            };
        //
        //            var jsonData = JSON.stringify(data);
        //
        //            xhr.open('POST', url, true);
        //            xhr.setRequestHeader('Content-Type', 'application/json');
        //
        //            xhr.onreadystatechange = function() {
        //                if (xhr.readyState === 4 && xhr.status === 200) {
        //                    console.log('Solicitud enviada correctamente.');
        //                    return xhr.responseText;
        //                }
        //            };
        //            xhr.send(jsonData);
        //        }
        //
        //        function prepare_updates() {
        //            const updating_targets = document.querySelectorAll('.fetched-events-container');
        //            for (let index = 0; index < updating_targets.length; index++) {
        //                const element = updating_targets[index];
        //                element.innerHTML = update_event_data();
        //            }
        //        }
        //        setInterval(update_event_data, 20000);
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top bg-white clean-navbar main-bg-color navbar-light">
        <div class="container"><a class="navbar-brand logo" href="#"><img class="bs-icon-sm" src="assets/img/deportex-dark-logo.webp" style="max-height: 45px !important;"></a><button data-bs-toggle="collapse" class="navbar-toggler submain-bg-color" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font third-color rem-adjustment" href="/#table"><img src="../assets/img/deportex/campeonato.svg?h=75f1c01ec367425d54761cc2d03b86b7">&nbsp;TABLA</a></li>
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font third-color rem-adjustment" href="/#matches"><img src="../assets/img/deportex/partidos.svg?h=1fd7a22190fe07882dd12f90bcdafbee">&nbsp;PARTIDOS</a></li>
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font third-color rem-adjustment" href="teams.php"><img src="../assets/img/deportex/equipos.svg?h=1fd7a22190fe07882dd12f90bcdafbee">&nbsp;EQUIPOS</a></li>
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font third-color rem-adjustment" href="players.php"><img src="../assets/img/deportex/jugadores.svg?h=1fd7a22190fe07882dd12f90bcdafbee">&nbsp;JUGADORES</a></li>
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font main-color rem-adjustment submain-bg-color rounded-3" href="login.php"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-user-circle">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                            </svg>&nbsp;<?php echo ((logged_in()) ? $_SESSION['name_user'] : "Entrar"); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page landing-page" style="background-color: var(--third-background-color);">
        <section class="clean-block clean-hero p-0" style="color: rgba(26,38,0,0.75);background: url('assets/img/deportex/soccer-field-banner.webp') center / cover;">
            <div class="text">
                <h2 class="custom-font custom-shadow d-flex align-items-center text-center justify-content-center main-color" style="max-height: 3.5rem;">¡Bienvenido a&nbsp;<img src="assets/img/deportex/deportex_logo_bienvenida_lime.svg?h=365c85da4681217dad3862b272e0f3bf" width="129" height="20" style="max-height: 5rem;width: auto;">!</h2>
                <p class="custom-font main-color" style="font-size: 2rem;">Una plataforma hecha para administrar la pasión de tu liga de fútbol, ¡bienvenido, hincha!</p><a class="btn btn-outline btn-lg custom-font main-color submain-bg-color" href="#table" type="button" style="border: 1px solid white;">Consultar</a>
            </div>
        </section>
        <section id="table" class="clean-block features">
            <div class="container">
                <div class="block-heading mb-2">
                    <h2 class="text-info mb-0 main-color custom-font">Tabla de posiciones</h2>
                    <p class="main-color custom-font">Consulta los puntos y posiciones de los equipos</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col">
                        <?php
                        include_once "php-scripts/functions.php";
                        echo (generate_league_table());
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <section id="top-players" class="clean-block clean-info dark main-bg-color submain-color">
            <div class="container">
                <div class="block-heading mb-1">
                    <h2 class="text-info mb-1 submain-color custom-font">Mejores jugadores</h2>
                    <p class="submain-color custom-font">Conoce a los jugadores que mejor rendimiento han tenido esta temporada</p>
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="carousel slide" data-bs-ride="false" id="carousel-1">
                            <div class="carousel-inner custom-font">
                                <?php
                                $top_players = fetch_top_players();
                                echo ($top_players[0]);
                                ?>
                            </div>
                            <div>
                                <a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><!-- End: Previous -->
                                <a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a><!-- End: Next -->
                            </div>
                            <?php echo ($top_players[1]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="matches" class="clean-block features">
            <div class="container">
                <div class="block-heading mb-2">
                    <h2 class="text-info mb-0 main-color custom-font">Agenda de partidos</h2>
                    <p class="main-color custom-font">Consulta los partidos recientes, en curso y Próximos</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col">
                        <nav>
                            <ul class="nav nav-pills mb-3 custom-font matches-links" role="tablist">
                                <li class="nav-item col-4" role="presentation"><button class="btn btn-primary active nav-link col-12" id="pills-previus-tab" type="button" data-bs-toggle="pill" role="tab" data-bs-target="#pills-previus" aria-controls="pills-previus" aria-selected="true">Pasados</button></li>
                                <li class="nav-item col-4" role="presentation"><button class="btn btn-primary nav-link col-12" id="pills-live-tab" type="button" data-bs-toggle="pill" role="tab" data-bs-target="#pills-live" aria-controls="pills-live" aria-selected="false">En marcha</button></li>
                                <li class="nav-item col-4" role="presentation"><button class="btn btn-primary nav-link col-12" id="pills-next-tab" type="button" data-bs-toggle="pill" role="tab" data-bs-target="#pills-next" aria-controls="pills-next" aria-selected="false">Futuros</button></li>
                            </ul>
                            <div id="pills-tabContent" class="tab-content custom-font rounded-3" style="background-color: #2e4000;border: 1px solid var(--main-background-color);">
                                <div id="pills-previus" class="show active tab-pane fade" role="tabpanel" aria-labbeledby="pills-previus-tab">
                                    <div class="col px-3 py-0 fetched-events-container">
                                        <?php
                                        echo (detailed_matches_output(4, null));
                                        ?>
                                        <div class="row text-center rounded-3 my-2" style="border: 1px solid var(--submain-background-color);background: linear-gradient(90deg, var(--main-background-color), rgba(173,238,0,0.54));">
                                            <div class="col"><a class="submain-color" href="matches.html#jugados"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-time-duration-90">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M8 14.25c0 .414 .336 .75 .75 .75h1.5a.75 .75 0 0 0 .75 -.75v-4.5a.75 .75 0 0 0 -.75 -.75h-1.5a.75 .75 0 0 0 -.75 .75v1.5c0 .414 .336 .75 .75 .75h2.25"></path>
                                                        <path d="M14 10.5v3a1.5 1.5 0 0 0 3 0v-3a1.5 1.5 0 0 0 -3 0z"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                    </svg>&nbsp;Ver más partidos finalizados</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="pills-live" class="tab-pane fade" role="tabpanel" aria-labbeledby="pills-live-tab">
                                    <div class="col px-3 py-0 fetched-events-container">
                                        <?php
                                        echo (detailed_matches_output(null, null));
                                        ?>
                                        <div class="row text-center rounded-3 my-2" style="border: 1px solid var(--submain-background-color);background: linear-gradient(90deg, var(--main-background-color), rgba(173,238,0,0.54));">
                                            <div class="col"><a class="submain-color" href="matches.html#jugados"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-time-duration-90">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M8 14.25c0 .414 .336 .75 .75 .75h1.5a.75 .75 0 0 0 .75 -.75v-4.5a.75 .75 0 0 0 -.75 -.75h-1.5a.75 .75 0 0 0 -.75 .75v1.5c0 .414 .336 .75 .75 .75h2.25"></path>
                                                        <path d="M14 10.5v3a1.5 1.5 0 0 0 3 0v-3a1.5 1.5 0 0 0 -3 0z"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                    </svg>&nbsp;Ver más partidos en curso</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="pills-next" class="tab-pane fade" role="tabpanel" aria-labbeledby="pills-next-tab">
                                    <div class="col px-3 py-0 fetched-events-container">
                                        <?php
                                        //echo (matches_output(fetch_matches(2, null)));
                                        ?>
                                        <div class="row text-center rounded-3 my-2" style="border: 1px solid var(--submain-background-color);background: linear-gradient(90deg, var(--main-background-color), rgba(173,238,0,0.54));">
                                            <div class="col"><a class="submain-color" href="matches.html#jugados"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-time-duration-90">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M8 14.25c0 .414 .336 .75 .75 .75h1.5a.75 .75 0 0 0 .75 -.75v-4.5a.75 .75 0 0 0 -.75 -.75h-1.5a.75 .75 0 0 0 -.75 .75v1.5c0 .414 .336 .75 .75 .75h2.25"></path>
                                                        <path d="M14 10.5v3a1.5 1.5 0 0 0 3 0v-3a1.5 1.5 0 0 0 -3 0z"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                    </svg>&nbsp;Ver más partidos agendados</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
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
    <script src="assets/js/vanilla-zoom.js?h=6a37ea9c996b05f763161c73127d66bc"></script>
    <script src="assets/js/theme.js?h=a083aeb15550c5e1266c666e8a5846d9"></script>
    <script src="assets/js/soccer.js?h=c9bb1747acaae394e9a5fb06a69ee776"></script>
    <script src="assets/js/live-data.js"></script>
    <script lang="javascript">
        function fix_table() {
            var collection = document.querySelectorAll("section#table td");
            for (let index = 0; index < collection.length; index++) {
                const element = collection[index];
                if (element.textContent == "") {
                    element.textContent = "0";
                }
            }
        }

        fix_table();
    </script>
</body>

</html>