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
    <title>Añadir equipo - DEPORTEX</title>
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
    <link rel="stylesheet" href="assets/css/soccer.css?h=6956102048e92d2978e0eca15f10e168">
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
                    <li class="nav-item px-0 pe-lg-4 pe-xl-5"><a class="nav-link text-center custom-font third-color rem-adjustment" href="contact-us.html"><img src="assets/img/deportex/jugadores.svg?h=1fd7a22190fe07882dd12f90bcdafbee">&nbsp;JUGADORES</a></li>
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
        <section id="add-players" class="clean-block clean-info dark main-bg-color submain-color">
            <div class="container">
                <div class="block-heading mb-1">
                    <h2 class="text-info mb-1 submain-color custom-font">Añadir equipo</h2>
                    <p class="submain-color custom-font">Registra a un equipo para añadirlo a la clasificación. Los campos con un (*) son obligatorios. No coloques nada ofensivo.</p>
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <form id="add-team-form" class="custom-font" action="php-scripts/actions.php?type=add-team" method="post" enctype="multipart/form-data">
                            <div class="col">
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text submain-bg-color main-color col-12 col-sm-auto">Selecciona la liga *</span><select class="form-select form-control submain-color main-bg-color custom-font" id="league-team" name="league-team" required="">
                                                <optgroup label="Ligas">
                                                    <option value="1" selected="">Liga 1</option>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text submain-bg-color main-color col-12 col-sm-auto">Nombre del equipo *</span><input class="form-control submain-color main-bg-color color-placeholder custom-font" type="text" id="team-name" placeholder="Escribe cómo se va a llamar el equipo" required="" name="team-name"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text submain-bg-color main-color col-12 col-sm-auto">Logo del equipo *</span><input class="form-control submain-color main-bg-color color-placeholder custom-font" type="file" id="logo-team" required="" name="logo-team" accept=".png, .jpg, .jpeg"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text submain-bg-color main-color col-12 col-sm-auto">Director Técnico</span><input class="form-control submain-color main-bg-color color-placeholder custom-font" type="text" id="couch-team" placeholder="Puedes especificar un entrenador" name="couch-team"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2 text-center"><span>Descripción</span><textarea class="form-control submain-bg-color main-color" id="description_team" name="description_team"></textarea></div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text submain-bg-color main-color col-12 col-sm-auto">Correo electrónico *</span><input class="form-control submain-color main-bg-color color-placeholder custom-font" type="text" id="email-user" placeholder="Correo para la cuenta de administrador" name="email-user" required=""></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text submain-bg-color main-color col-12 col-sm-auto">Nombre *</span><input class="form-control submain-color main-bg-color color-placeholder custom-font" type="text" id="name-user" placeholder="Nombre del administrador" name="name-user" required=""></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text submain-bg-color main-color col-12 col-sm-auto">Apellidos</span><input class="form-control submain-color main-bg-color color-placeholder custom-font" type="text" id="last-names-user" placeholder="Apellidos del administrador" name="last-names-user"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2">
                                        <div class="input-group"><span class="input-group-text submain-bg-color main-color col-12 col-sm-auto">Contraseña *</span><input class="form-control submain-color main-bg-color color-placeholder custom-font" type="password" id="password-user" placeholder="Clave para ingresar a la plataforma" name="password-user" required=""></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2 text-center"><button class="btn submain-bg-color main-color rounded-4 col-8 col-sm-auto" type="submit">Registrar equipo</button></div>
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
    <script src="assets/js/theme.js?h=a083aeb15550c5e1266c666e8a5846d9"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="assets/js/soccer.js?h=fe04a40863e2e98ecf0b60b724df9cc9"></script>
</body>

</html>