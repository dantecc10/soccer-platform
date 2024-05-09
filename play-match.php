<?php
include_once "php scripts/functions.php";
include_once "php scripts/soccer_queries.php";
session_start();
?>
<!DOCTYPE html>
<html data-bs-theme="dark" lang="es-mx">

<head>
    <?php
    $temp = $match_basic_data_fields;
    $temp[] = 'id_match';
    $temp[] = 'status_match';
    $temp[] = 'local_team_id';
    $temp[] = 'visitor_team_id';
    $where = ("WHERE (player_team_id = ?)");
    $sql = "SELECT * FROM  `players` ?";

    $match_info = fetch_fields('matches', $temp, null, str_replace("?", $_GET['id'], $match_basic_data_queries[3]))[0];
    if ($match_info === null) {
        header("Location: index.php?error=match_not_found");
    }

    $local_players = fetch_fields('players', $player_fields, null, str_replace("?", str_replace("?", $match_info[12], $where), $sql));
    $visitor_players = fetch_fields('players', $player_fields, null, str_replace("?", str_replace("?", $match_info[13], $where), $sql));
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Administrando partido - <?php echo ($match_info[2]); ?> vs <?php echo ($match_info[7]); ?> - DEPORTEX</title>
    <meta property="og:title" content="DEPORTEX">
    <meta property="og:image" content="https://soccer.castelancarpinteyro.com/assets/img/deportex/DeportEX Logo Minimalista BLACK GREEN EDITION VFX.png">
    <meta name="description" content="Sistema de gestión de ligas de fútbol.">
    <meta name="author" content="Dante Castelán Carpinteyro">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20WHITE%20EDITION.png?h=6baf041d5b489f75a71934a78277e96f" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20WHITE%20EDITION.png?h=6baf041d5b489f75a71934a78277e96f" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="icon" type="image/png" sizes="2000x2000" href="assets/img/deportex/DeportEX%20Logo%20Minimalista%20BLACK%20GREEN%20EDITION%20VFX.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="icon" type="image/png" sizes="2224x2002" href="assets/img/deportex/DEPORTEX%20BLACK%20VERSION.png?h=6baf041d5b489f75a71934a78277e96f">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=254a09188e530cb03e8e344c8d2feb3e">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Staatliches&amp;display=swap'">
    <link rel="stylesheet" href="assets/css/soccer.css?h=d5846df3391ee5880ceb80c6b2bc4c74">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
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
</head>

<body class="submain-bg-color">
    <?php
    $local_p_js = "";
    $visitor_p_js = "";
    for ($i = 0; $i < sizeof($local_players); $i++) {
        $nickname = ($local_players[$i][3] != null && $local_players[$i][3] != "") ? (" <i>'" . $local_players[$i][3] . "'</i> ") : " ";
        $local_p_js .= "<option class='player-option local' value='" . $local_players[$i][0] . "'>" . $local_players[$i][4] . " - " . $local_players[$i][1] . $nickname . $local_players[$i][2] . "</option>";
    }
    for ($i = 0; $i < sizeof($visitor_players); $i++) {
        $nickname = ($visitor_players[$i][3] != null && $visitor_players[$i][3] != "") ? (" <i>'" . $visitor_players[$i][3] . "'</i> ") : " ";
        $visitor_p_js .= "<option class='player-option visitor' value='" . $visitor_players[$i][0] . "'>" . $visitor_players[$i][4] . " - " . $visitor_players[$i][1] . $nickname . $visitor_players[$i][2] . "</option>";
    }
    ?>
    <script lang="javascript">
        const local_players = "<?php echo $local_p_js; ?>";
        const visitor_players = "<?php echo $visitor_p_js; ?>";
        const local_id = "<?php echo $match_info[12]; ?>";
        const visitor_id = "<?php echo $match_info[13]; ?>";

        function selected_insert(element, target) {
            (element.value == local_id) ? option_inserter(target, 'home'): option_inserter(target, 'visitor');
        }

        function option_inserter(target_id, team) {
            let target = document.getElementById(target_id);
            var inserter = (team == 'home') ? local_players : visitor_players;
            target.innerHTML = inserter;
        }
        const match = "<?php echo ($_GET['id']); ?>";
        const referee = "<?php echo ($_SESSION['id_user']); ?>";

        function against_goal() {
            const own_goal = (document.getElementById('goal-against').checked) ? true : false;
            if (own_goal) {
                const target = document.getElementById("goal-team").value;
                if (target == local_id) {
                    option_inserter('goal-scorer-optgroup', 'visitor');
                } else {
                    option_inserter('goal-scorer-optgroup', 'home');
                }
            } else {
                const goal_team = (document.getElementById("goal-team").value == local_id) ? "home" : "visitor";
                option_inserter('goal-scorer-optgroup', goal_team);
            }
        }
    </script>

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
    <main class="page pricing-table-page my-5 submain-bg-color">
        <section id="teams" class="main-color submain-bg-color my-3">
            <div class="container text-center">
                <div class="block-heading">
                    <h2 class="text-info main-color custom-font">Gestión de partido</h2>
                    <p class="custom-font">Aquí puedes controlar como árbitro los tiempos del partido y registrar los eventos</p>
                </div>
                <div class="row justify-content-center custom-font">
                    <div class="col text-center col-md-10 col-lg-9 col-xl-8">
                        <div class="row mb-1">
                            <div class="col">
                                <div class="input-group main-border rounded-4"><span class="input-group-text col-5 rounded-4 submain-bg-color text-center justify-content-center" style="text-align: center !important; border: none;">Equipo local</span><input class="form-control team-labelers rounded-2 main-bg-color submain-color text-center m-0 disabled" type="text" disabled="" value="<?php echo ($match_info[2]); ?>" style="border: none;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="input-group main-border rounded-4"><span class="input-group-text col-5 rounded-4 submain-bg-color text-center justify-content-center" style="text-align: center !important; border: none;">Equipo visitante</span><input class="form-control team-labelers rounded-2 main-bg-color submain-color text-center m-0 disabled" type="text" value="<?php echo ($match_info[7]); ?>" style="border: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                //print_r($local_players);
                //print_r($visitor_players);
                ?>
            </div>
        </section>
        <section id="add-events" class="main-color submain-bg-color my-3">
            <div class="container text-center">
                <div class="block-heading">
                    <h2 class="text-info main-color custom-font">Añade eventos</h2>
                    <p class="custom-font">Captura la información para añadir los datos del partido</p>
                </div>
                <div class="row justify-content-center custom-font px-2">
                    <div class="col me-2 me-sm-3 me-lg-4 align-self-center col-5 col-md-4 col-xl-3 main-border rounded-4 px-0" onclick="javascript:(this).querySelectorAll(&#39;button&#39;)[0].click();">
                        <div class="row">
                            <div class="col py-3"><img class="col-8" src="https://soccer.castelancarpinteyro.com/assets/icons/Gestionando Equipo/Partidos/Ventana Gestionar Partidos/FALTAS/Ilustracion_Tarjetas.png"></div>
                        </div>
                        <div class="row mx-0">
                            <div class="col p-0">
                                <!-- Start: Basic Modal Button --><button class="btn submain-bg-color main-color fs-1 rounded-4 w-100 p-1 p-sm-2 fw-bolder" type="button" data-bs-toggle="modal" data-bs-target="#modal-foul" style="border-top: 3px solid var(--main-background-color);">Marcar falta</button><!-- End: Basic Modal Button -->
                            </div>
                        </div>
                    </div>
                    <div class="col ms-2 ms-sm-3 ms-lg-4 align-self-center col-5 col-md-4 col-xl-3 main-border rounded-4 px-0" onclick="javascript:(this).querySelectorAll(&#39;button&#39;)[0].click();">
                        <div class="row">
                            <div class="col py-3"><img class="col-8" src="https://soccer.castelancarpinteyro.com/assets/icons/Gestionando Equipo/Partidos/Ventana Gestionar Partidos/FALTAS/Ilustracion_Gol.png"></div>
                        </div>
                        <div class="row mx-0">
                            <div class="col p-0">
                                <!-- Start: Basic Modal Button --><button class="btn submain-bg-color main-color fs-1 rounded-4 w-100 p-1 p-sm-2 fw-bolder" type="button" data-bs-toggle="modal" data-bs-target="#modal-goal" style="border-radius-top: 0px; border-top: 3px solid var(--main-background-color);">Registrar GOL</button><!-- End: Basic Modal Button -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="preview-match" class="main-color submain-bg-color my-3">
            <div class="container text-center">
                <div class="block-heading">
                    <h2 class="text-info main-color custom-font">Añade eventos</h2>
                    <p class="custom-font">Captura la información para añadir los datos del partido</p>
                </div>
                <div class="row justify-content-center custom-font px-2">
                    <div class="col px-3 py-0">
                        <div class="row text-center rounded-3 my-2 live-match-container" style="border: 1px solid var(--main-background-color);background: linear-gradient(90deg, #406f10, #203103);">
                            <div class="col">
                                <div class="row rounded-top" style="background-color: var(--submain-background-color);">
                                    <div class="col"><span class="fs-4"><i class="la la-trophy"></i>&nbsp;EXAGON CHAMPIONS</span></div>
                                </div>
                                <div class="row rounded-4">
                                    <div class="col"><span class="fs-4">
                                            <?php
                                            switch ($match_info[11]) {
                                                case 0:
                                                    echo "Programado";
                                                    break;
                                                case 1:
                                                    echo "1er tiempo";
                                                    break;
                                                case 2:
                                                    echo "Descanso";
                                                    break;
                                                case 3:
                                                    echo "2do tiempo";
                                                    break;
                                                default:
                                                    echo "Finalizado";
                                                    break;
                                            }
                                            ?>
                                        </span></div>
                                </div>
                                <div class="row">
                                    <div class="col" style="height: 2rem !important;"><span class="px-4 py-1 mt-1 rounded-3" style="background-color: orangered;">EN VIVO</span></div>
                                </div>
                                <div class="row py-2">
                                    <div class="col align-self-center">
                                        <div class="row">
                                            <div class="col align-self-center px-0 d-lg-none" style="font-size: 1.2rem;text-align: center;"><span class="fs-2"><?php echo ($match_info[2]); ?></span></div>
                                            <div class="col col-12 col-lg-6 col-xl-7">
                                                <div class="row">
                                                    <div class="col px-0" style="max-height: 5rem;">
                                                        <div style="max-height: inherit;">
                                                            <div class="p-0 text-lg-end pe-lg-3" style="max-height: inherit;"><img src="<?php echo ($match_info[3]); ?>" style="max-height: inherit;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col align-self-center px-0 d-none d-lg-block" style="font-size: 1.2rem;text-align: center;"><span class="fs-2"><?php echo ($match_info[2]); ?></span></div>
                                        </div>
                                    </div>
                                    <div class="col align-self-center col-3 col-sm-2 col-lg-1">
                                        <div class="row">
                                            <div class="col px-xl-0"><span class="goal-container my-auto" style="font-size: 3.4rem;line-height: 250%;"><?php echo ($match_info[4]); ?></span><span class="fs-1 h-100 my-auto" style="font-size: 5rem;">-</span><span class="goal-container my-auto" style="font-size: 3.4rem;line-height: 250%;"><?php echo ($match_info[5]); ?></span></div>
                                        </div>
                                    </div>
                                    <div class="col align-self-center">
                                        <div class="row">
                                            <div class="col align-self-center px-0" style="font-size: 1.2rem;text-align: center;"><span class="fs-2"><?php echo ($match_info[7]); ?></span></div>
                                            <div class="col col-12 col-lg-6 col-xl-7">
                                                <div class="row">
                                                    <div class="col px-0" style="max-height: 5rem;">
                                                        <div style="max-height: inherit;">
                                                            <div class="p-0 p-0 text-lg-start ps-lg-3" style="max-height: inherit;"><img src="<?php echo ($match_info[6]); ?>" style="max-height: inherit;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col align-self-center px-0 d-none" style="font-size: 1.2rem;text-align: center;"><span><?php echo ($match_info[7]); ?></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><span style="height: .3rem !important;"><?php echo (match_start_schedule_formatter($match_info[0])); ?> |&nbsp; <?php echo ($match_info[1]); ?></span></div>
                                </div>
                                <div class="row">
                                    <div class="col px-0">
                                        <div id="accordion-1" class="accordion">
                                            <div class="accordion-item" style="background-color: rgba(255,255,255,0);border-color: var(--main-background-color);">
                                                <h2 class="accordion-header" style="background-color: rgba(255,255,255,0);border-color: var(--main-background-color);"><button class="btn accordion-button px-6 main-color py-2" type="button" style="background-color: rgba(255,255,255,0);" data-bs-toggle="collapse" data-bs-target="#accordion-1-section-1" aria-expanded="true" aria-controls="accoridion-1-section-1"><span class="align-self-center fs-5 text-center col-10">Mostrar detalles y EVENTOS DEL PARTIDO</span></button></h2>
                                                <div id="accordion-1-section-1" class="accordion-collapse collapse show">
                                                    <div class="accordion-body p-1">
                                                        <div class="col">
                                                            <div class="row my-3">
                                                                <div class="col align-self-center"><span class="align-middle main-color">Finalizado</span>
                                                                    <hr class="my-0 main-color main-bg-color mx-3" style="border: 1.5px solid var(--main-background-color);">
                                                                </div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center text-sm-end"><span class="align-middle"><img class="rem-adjustment" src="assets/img/samples/logo-bayern.png?h=689f785b0d375e5269cde4eff9a00b5c">&nbsp;Serge Gnabry</span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;5 - 4 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;82'</span></div>
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center text-sm-end"><span class="align-middle"></span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;4 - 4 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;74'</span></div>
                                                                <div class="col align-self-center text-sm-start"><span class="align-middle"><img class="rem-adjustment d-md-none" src="assets/img/samples/masters-fc.png?h=b2ccd38b407a40501e86cf611779775b">&nbsp;Berthín L M&nbsp;<img class="rem-adjustment d-none d-md-inline-block" src="assets/img/samples/masters-fc.png?h=b2ccd38b407a40501e86cf611779775b"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center text-sm-end"><span class="align-middle"><img class="rem-adjustment" src="assets/img/samples/logo-bayern.png?h=689f785b0d375e5269cde4eff9a00b5c">&nbsp;Leroy Sané</span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;4 - 3 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;72'</span></div>
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center text-sm-end"><span class="align-middle"><img class="rem-adjustment" src="assets/img/samples/logo-bayern.png?h=689f785b0d375e5269cde4eff9a00b5c">&nbsp;Konrad Laimer</span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat foul red-card"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-rectangle-vertical-filled">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path d="M17 2h-10a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h10a3 3 0 0 0 3 -3v-14a3 3 0 0 0 -3 -3z" stroke-width="0" fill="currentColor"></path>
                                                                        </svg>&nbsp;4 - 3 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;70'</span></div>
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center text-sm-end"><span class="align-middle"><img class="rem-adjustment" src="assets/img/samples/logo-bayern.png?h=689f785b0d375e5269cde4eff9a00b5c">&nbsp;Leroy Sané</span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat foul yellow-card"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-rectangle-vertical-filled">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path d="M17 2h-10a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h10a3 3 0 0 0 3 -3v-14a3 3 0 0 0 -3 -3z" stroke-width="0" fill="currentColor"></path>
                                                                        </svg>&nbsp;4 - 3 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;70'</span></div>
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;3 - 3 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;59'</span></div>
                                                                <div class="col align-self-center text-sm-start"><span class="align-middle"><img class="rem-adjustment d-md-none" src="assets/img/samples/masters-fc.png?h=b2ccd38b407a40501e86cf611779775b">&nbsp;Daniel C P&nbsp;<img class="rem-adjustment d-none d-md-inline-block" src="assets/img/samples/masters-fc.png?h=b2ccd38b407a40501e86cf611779775b"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center text-sm-end"><span class="align-middle"><img class="rem-adjustment" src="assets/img/samples/logo-bayern.png?h=689f785b0d375e5269cde4eff9a00b5c">&nbsp;Thomas Müller</span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;3 - 2 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;55'</span></div>
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center"><span class="align-middle main-color">Descanso</span>
                                                                    <hr class="my-0 main-color main-bg-color mx-3" style="border: 1.5px solid var(--main-background-color);">
                                                                </div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center text-sm-end"><span class="align-middle"><img class="rem-adjustment" src="assets/img/samples/logo-bayern.png?h=689f785b0d375e5269cde4eff9a00b5c">&nbsp;Jamal Musiala</span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;2 - 2 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;34'</span></div>
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal auto-goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;1 - 2 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;17'</span></div>
                                                                <div class="col align-self-center text-sm-start"><span class="align-middle"><img class="rem-adjustment d-md-none" src="assets/img/samples/logo-bayern.png?h=689f785b0d375e5269cde4eff9a00b5c" width="19" height="24">&nbsp;(AG) Dayot Upamecano&nbsp;<img class="rem-adjustment d-none d-md-inline-block" src="assets/img/samples/logo-bayern.png?h=689f785b0d375e5269cde4eff9a00b5c"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;1 - 1 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;10'</span></div>
                                                                <div class="col align-self-center text-sm-start"><span class="align-middle"><img class="rem-adjustment d-md-none" src="assets/img/samples/masters-fc.png?h=b2ccd38b407a40501e86cf611779775b">&nbsp;Daniel H A&nbsp;<img class="rem-adjustment d-none d-md-inline-block" src="assets/img/samples/masters-fc.png?h=b2ccd38b407a40501e86cf611779775b"></span></div>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col align-self-center text-sm-end"><span class="align-middle"><img class="rem-adjustment" src="assets/img/samples/logo-bayern.png?h=689f785b0d375e5269cde4eff9a00b5c">&nbsp;Harry Kane</span></div>
                                                                <div class="col align-self-center col-4 col-md-3 col-lg-2 px-0"><span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;1 - 0 :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;5'</span></div>
                                                                <div class="col align-self-center"><span class="align-middle"></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-goal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-dialog-centered submain-bg-color custom-font rounded-5 main-border mt-5">
                <div class="modal-header col-12 text-center justify-content-center p-2 main-border bottom-border">
                    <h4 class="modal-title main-color col-12">¡¡¡Goooool!!!</h4>
                </div>
                <div class="modal-body col-12 text-center justify-content-center pt-1"><span>Los campos con un (*) son obligatorios</span>
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col"><img class="col-4" src="https://soccer.castelancarpinteyro.com/assets/icons/Gestionando%20Equipo/Partidos/Ventana%20Gestionar%20Partidos/FALTAS/Ilustracion_Gol.png"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form id="goal-form" class="modal-form" name="goal-form">
                                    <div class="row mb-1">
                                        <div class="col">
                                            <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-md-4 justify-content-center main-border">Equipo goleador *</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border" id="goal-team" name="goal-team" required="" style="border-width: 1px;" onclick="javascript:selected_insert(this, 'goal-scorer-optgroup');">
                                                    <optgroup label="Equipo anotador">
                                                        <option value="<?php echo ($match_info[12]); ?>"><?php echo ($match_info[2]); ?></option>
                                                        <option value="<?php echo ($match_info[13]); ?>"><?php echo ($match_info[7]); ?></option>
                                                    </optgroup>
                                                </select></div>
                                        </div>
                                    </div>
                                    <div class="row my-1 justify-content-center">
                                        <div class="col col-4 main-bg-color submain-color rounded-4">
                                            <div class="form-check justify-content-center"><input class="form-check-input me-0" type="checkbox" id="goal-against" name="goal-against" onclick="javascript:against_goal();"><label class="form-check-label" for="goal-against">¿Autogol?</label></div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col">
                                            <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-md-4 justify-content-center main-border">ANOTADOR *</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border" id="goal-player" name="goal-player" required="" style="border-width: 1px;">
                                                    <optgroup id="goal-scorer-optgroup" label="Anotador">
                                                    </optgroup>
                                                </select></div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col">
                                            <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-md-4 justify-content-center main-border">¿Gol especial?</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border" id="goal-type" name="goal-type" style="border-width: 1px;">
                                                    <optgroup label="¿Gol especial?">
                                                        <option value="0" selected="">Normal</option>
                                                        <option value="1">Penal / Shot</option>
                                                    </optgroup>
                                                </select></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer col-12 align-self-center justify-content-center main-border top-border"><button class="btn submain-bg-color main-color main-border rounded-4 col-5" type="button" data-bs-dismiss="modal">Cancelar</button><button class="btn main-bg-color submain-color main-border rounded-4 col-5" type="button" onclick="javascript:goal_ajax(match, referee);">Agregar gol</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-foul">
        <?php
        $match_data = fetch_fields("matches", $matches_fields, null, null);
        ?>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-dialog-centered submain-bg-color custom-font rounded-5 main-border">
                <div class="modal-header col-12 text-center justify-content-center p-2 main-border bottom-border">
                    <h4 class="modal-title main-color col-12">Agregar una falta</h4>
                </div>
                <div class="modal-body col-12 text-center justify-content-center pt-1"><span>Los campos con un (*) son obligatorios</span>
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col"><img class="col-4" src="https://soccer.castelancarpinteyro.com/assets/icons/Gestionando Equipo/Partidos/Ventana Gestionar Partidos/FALTAS/Ilustracion_Tarjetas.png"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form id="foul-form" class="modal-form" name="foul-form" method="post">
                                    <div class="row mb-1">
                                        <div class="col">
                                            <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-md-4 justify-content-center main-border">Equipo infractor *</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border" id="foul-team" name="foul-team" required="" style="border-width: 1px;" onclick="javascript:selected_insert(this, 'foul-player-optgroup');">
                                                    <optgroup label="Equipo que cometió la infracción">
                                                        <option value="<?php echo ($match_info[12]); ?>"><?php echo ($match_info[2]); ?></option>
                                                        <option value="<?php echo ($match_info[13]); ?>"><?php echo ($match_info[7]); ?></option>
                                                    </optgroup>
                                                </select></div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col">
                                            <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-md-4 justify-content-center main-border">Jugador infractor *</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border" id="foul-player" name="foul-player" required="" style="border-width: 1px;">
                                                    <optgroup id="foul-player-optgroup" label="Jugador que cometió la infracción">

                                                    </optgroup>
                                                </select></div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col">
                                            <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-md-4 justify-content-center main-border">Tipo de falta</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border" id="foul-type" name="foul-type" style="border-width: 1px;">
                                                    <optgroup label="Elige la causa de la falta">
                                                        <option value="1">Juego peligroso</option>
                                                        <option value="2">Entrada ilegal</option>
                                                        <option value="3">Mano</option>
                                                        <option value="4">Falta por detrás</option>
                                                        <option value="5">Agresión</option>
                                                        <option value="6">Obstrucción</option>
                                                        <option value="7">Falta táctica</option>
                                                        <option value="0" selected>Otra</option>
                                                    </optgroup>
                                                </select></div>
                                        </div>
                                    </div>
                                    <div class="row my-2 mx-0 px-0 main-border rounded-4">
                                        <div class="col col-12 mx-0 px-0"><span class="btn py-1 main-bg-color submain-color rounded-2" style="width: 100% !important;">Tarjeta mostrada</span></div>
                                        <div class="col col-12 px-1">
                                            <div class="row justify-content-between p-3 cards-row-container text-center">
                                                <div class="col align-self-center col-6 col-md-4 col-lg-3 main-border rounded-4 px-0" onclick="javascript:checkbox_clicker(this);">
                                                    <div class="row">
                                                        <div class="col py-1"><img class="col-7" src="https://soccer.castelancarpinteyro.com/assets/icons/Gestionando%20Equipo/Partidos/Ventana%20Gestionar%20Partidos/FALTAS/Silbato%20Original%20Deportex.png"></div>
                                                    </div>
                                                    <div class="row mx-0">
                                                        <div class="col"><span class="submain-bg-color main-color fs-6"><input type="checkbox" id="foul-no-card" class="main-bg-color card-checkbox" checked="" name="foul-no-card" onclick="javascript:checkbox_analyze(this);">&nbsp;Sólo verbal</span></div>
                                                    </div>
                                                </div>
                                                <div class="col align-self-center col-6 col-md-4 col-lg-3 main-border rounded-4 px-0" onclick="javascript:checkbox_clicker(this);">
                                                    <div class="row">
                                                        <div class="col py-1"><img class="col-7" src="https://soccer.castelancarpinteyro.com/assets/icons/Gestionando Equipo/Partidos/Ventana Gestionar Partidos/FALTAS/Tarjeta_Amarilla.svg"></div>
                                                    </div>
                                                    <div class="row mx-0">
                                                        <div class="col"><span class="submain-bg-color main-color fs-6"><input type="checkbox" id="foul-yellow-card" class="main-bg-color card-checkbox" name="foul-yellow-card" onclick="javascript:checkbox_analyze(this);">&nbsp;Tarjeta amarilla</span></div>
                                                    </div>
                                                </div>
                                                <div class="col align-self-center col-6 col-md-4 col-lg-3 main-border rounded-4 px-0" onclick="javascript:checkbox_clicker(this);">
                                                    <div class="row">
                                                        <div class="col py-1"><img class="col-7" src="https://soccer.castelancarpinteyro.com/assets/icons/Gestionando%20Equipo/Partidos/Ventana%20Gestionar%20Partidos/FALTAS/Doble-Amarilla.svg"></div>
                                                    </div>
                                                    <div class="row mx-0">
                                                        <div class="col"><span class="submain-bg-color main-color fs-6"><input type="checkbox" id="foul-double-yellow-card" class="main-bg-color card-checkbox" name="foul-double-yellow-card" onclick="javascript:checkbox_analyze(this);">&nbsp;Doble amarilla</span></div>
                                                    </div>
                                                </div>
                                                <div class="col align-self-center col-6 col-md-4 col-lg-3 main-border rounded-4 px-0" onclick="javascript:checkbox_clicker(this);">
                                                    <div class="row">
                                                        <div class="col py-1"><img class="col-7" src="https://soccer.castelancarpinteyro.com/assets/icons/Gestionando Equipo/Partidos/Ventana Gestionar Partidos/FALTAS/Tarjeta_Roja.svg"></div>
                                                    </div>
                                                    <div class="row mx-0">
                                                        <div class="col"><span class="submain-bg-color main-color fs-6"><input type="checkbox" id="foul-red-card" class="main-bg-color card-checkbox" name="foul-red-card" onclick="javascript:checkbox_analyze(this);">&nbsp;Tarjeta roja</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col">
                                            <div class="input-group"><span class="input-group-text main-bg-color submain-color col-12 col-md-4 justify-content-center main-border">Consecuencia</span><select class="form-select form-control main-color submain-bg-color custom-font text-center main-border" id="foul-consequence" name="foul-consequence" required="" style="border-width: 1px;">
                                                    <optgroup label="¿En qué resultará la falta?">
                                                        <option value="0" selected="">Advertencia</option>
                                                        <option value="1">Ley de la Ventaja</option>
                                                        <option value="2">Tiro libre</option>
                                                        <option value="3">Penal / Shot</option>
                                                    </optgroup>
                                                </select></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer col-12 align-self-center justify-content-center main-border top-border"><button class="btn submain-bg-color main-color main-border rounded-4 col-5" type="button" data-bs-dismiss="modal">Cancelar</button><button class="btn main-bg-color submain-color main-border rounded-4 col-5" id="foul-sender" type="button" onclick="javascript:foul_ajax(match, referee);">Agregar falta</button></div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
    <script src="assets/js/theme.js?h=a083aeb15550c5e1266c666e8a5846d9"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="assets/js/soccer.js?h=2dc7e85950298bda04cc6ac9a2d1ed8f"></script>
</body>

</html>