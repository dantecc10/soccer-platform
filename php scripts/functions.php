<?php
function contains_string($main_string, $substring)
{
    // strpos devuelve la posición donde se encuentra la subcadena
    // Si no se encuentra, devuelve false
    return strpos($main_string, $substring) !== false;
}
function split_urls($urls)
{
    if (contains_string($urls, ", ")) {
        $img_urls = array();
        $img_urls = explode(", ", $urls);
    } else {
        $img_urls = $urls;
    }
    return $img_urls; // Usar como $data = split_urls($cadena_con_urls); (Validar con length)
}
function splitter($urls, $divisor)
{
    $strings_array = array();
    $strings_array = explode($divisor, $urls);
    return $strings_array; // Usar como $data = split_urls($cadena_con_urls); (Validar con length)
}
/* Validación de array
if (is_array(split_urls($urls))) {
    $img = (split_urls($urls))[0];
} else {
    $img = split_urls($urls);
}
*/
function build_table_dom($table, $data, $fields)
{
    switch ($table) {
        case 'juguetes':
            break;

        default:
            # code...
            break;
    }
}
function build_detail_carousel($imgs)
{
    $carousel = '';
    $n = sizeof($imgs);

    $carousel_capusule1 = '<div id="carousel-1" class="carousel slide" data-bs-ride="carousel">';
    $carousel_capusule2 = '</div>';

    $carousel_elements = '<div class="carousel-inner">';
    $carousel_indexes = '<ol class="carousel-indicators">';

    $carousel_buttons = '<div>
    <a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>';

    for ($i = 0; $i < $n; $i++) {
        $element = '<div class="carousel-item">';
        $index = '<li data-bs-target="#carousel-1" data-bs-slide-to="';

        if ($i == 0) {
            // Añadir clases active al primer elemento e índice
            $element = str_replace('">', ' active">', $element);
            $index = str_replace('<li ', '<li class="active" ', $index);
        }

        $element .= ('<img class="w-100 d-block" src="' . ($imgs[$i]) . '" alt="Imagen ' . ($i + 1) . '" />');
        $index .= $i;

        $element .= '</div>';
        $index .= '"></li>';

        $carousel_elements .= $element;
        $carousel_indexes .= $index;
    }

    $carousel_elements .= '</div>';
    $carousel_indexes .= '</ol>';
    $carousel .= ($carousel_capusule1 . $carousel_elements . $carousel_buttons . $carousel_indexes . $carousel_capusule2);
    return $carousel;
    /*
        Invocación:
        build_detail_carousel($split_urls($data[$10])) // $data[10] es imgs de SQL
    */
}
function avatar_img($src)
{
    if ($src == "" || $src == null) {
        if (isset($_SESSION['id'])) {
            $final_src = $_SESSION['img'];
        } else {
            $final_src = "assets/img/avatars/avatar5.jpeg";
        }
    } else {
        $final_src = $src;
    }

    $avatar_img = ('<img class="border rounded-circle img-profile" src="' . $final_src . '">');
    return $avatar_img;
}

function sql_insertion_get_id($data, $table)
{
    include "connection.php";
    if (($_SESSION['email'] == "demo_user@system.com") or ($_SESSION['user'] == "demo_user")) {
        $connection = new mysqli("localhost", "comercial_demo", $data[1], "comercial_demo");
    }
    // Realizar la inserción en la base de datos
    // INSERT INTO `transacciones` VALUES('', ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP);
    $sql = ("INSERT INTO `" . $table . "` VALUES ('', ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sisdsi", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
    $stmt->execute();

    // Obtener el ID de la última inserción con conexión de tipo PDO mysqli
    $id_transaction = $connection->insert_id;
    return $id_transaction;
}

function sql_transaction_insert($params, $table)
{
    include_once "credentials.php";
    $data = generatePasskey('sql'); // No es un bug, es una feature, je, je
    if (($_SESSION['email'] == "demo_user@system.com") or ($_SESSION['user'] == "demo_user")) {
        $connection = new mysqli("localhost", "comercial_demo", $data[1], "comercial_demo");
    } else {
        $connection = new mysqli("localhost", $data[0], $data[1], $data[2]);
    }
    if ($connection->connect_error) {
        die("La conexión a la base de datos falló: " . $connection->connect_error);
    } else {
        #echo ("Conexión establecida"); # Confirmación de conexión
    }
    // Consulta para la inserción
    // INSERT INTO `transacciones` VALUES('', 'Physical', 1, 'juguetes', 671.00, 'sale', 1, CURRENT_TIMESTAMP);
    $channel = strval($params[0]);
    $quantity = intval($params[1]);
    $categories = strval($params[2]);
    $amount = floatval($params[3]);
    $type = strval($params[4]);
    $user = intval($params[5]);
    $sql = ("INSERT INTO `" . $table . "` VALUES ('', '" . $channel . "', " . $quantity . ", '" . $categories . "', " . $amount . ", '" . $type . "', " . $user . ", CURRENT_TIMESTAMP)");

    // Ejecutar la consulta
    if ($connection->query($sql) === TRUE) {
        $last_id = $connection->insert_id;
    } else {
        //echo "Error en la inserción: " . $conexion->error;
    }

    // Cerrar la conexión
    $connection->close();
    return $last_id;
}

function get_last_insert_id($connection)
{
    return $connection->insert_id;
}

function import_env_configs()
{
    require_once '../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable('/var/www/vhosts/castelancarpinteyro.com/comercial.castelancarpinteyro.com');
    return $dotenv;
    //$dotenv->load();
}
function sql_debug_fetcher($table, $fields, $custom_query)
{
    include_once "connection.php";
    $sql = ($custom_query != null && $custom_query != "") ? $custom_query : ("SELECT * FROM `" . $table . "`");

    //$sql = "SELECT * FROM `" . $table . "`";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return [$data, $fields];
}

function debug_data_printer($info)
{
    $data = $info[0];
    $fields = $info[1];

    echo ('<table>');
    echo ('<thead>');
    echo ('<tr>');
    for ($i = 0; $i < sizeof($fields); $i++) {
        echo ("<th>" . $fields[$i] . "</th>");
    }
    echo ('</tr>');
    echo ('</thead>');
    echo ('<tbody>');
    for ($i = 0; $i < sizeof($data); $i++) {
        echo ('<tr>');
        for ($j = 0; $j < sizeof($fields); $j++) {
            echo ("<td>" . $data[$i][$fields[$j]] . "</td>");
        }
        echo ('</tr>');
    }
    echo ('</tbody>');
    echo ('</table>');
}

function get_day_name($date)
{
    $fecha = $date; #"2022-04-11"; // Ejemplo de fecha obtenida de la base de datos

    // Convertir la fecha a un formato legible
    $formated_date = date("Y-m-d", strtotime($date));

    // Crear un formateador de fecha
    $formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
    $formatter->setPattern('EEEE');

    // Obtener el nombre del día de la semana en español
    $weekday_name = $formatter->format(new DateTime($date));

    return $weekday_name;
}

function generate_league_table()
{
    include "soccer_queries.php";
    $sql = $league_query;
    $dom = "";

    $data = fetch_fields('teams', $league_table_fields, '', $sql);
    $dom .= (' <div class="table-responsive">
                <table class="table main-color rounded-5 custom-font">
                    <thead class="text-center main-bg-color">
                        <tr class="submain-bg-color">
                            <th class="submain-bg-color main-color px-0" style="background-color: var(--third-color) !important;">#</th>
                            <th class="col-3 submain-bg-color main-color" style="background-color: var(--third-color) !important;">Club</th>
                            <th class="submain-bg-color main-color px-1" style="background-color: var(--third-color) !important;">PJ</th>
                            <th class="submain-bg-color main-color px-1" style="background-color: var(--third-color) !important;">G</th>
                            <th class="submain-bg-color main-color px-1" style="background-color: var(--third-color) !important;">E</th>
                            <th class="submain-bg-color main-color px-1" style="background-color: var(--third-color) !important;">P</th>
                            <th class="d-none d-sm-table-cell submain-bg-color main-color px-1" style="background-color: var(--third-color) !important;">GF</th>
                            <th class="d-none d-sm-table-cell submain-bg-color main-color px-1" style="background-color: var(--third-color) !important;">GC</th>
                            <th class="submain-bg-color main-color px-1" style="background-color: var(--third-color) !important;">DG</th>
                            <th class="submain-bg-color main-color px-1" style="background-color: var(--third-color) !important;">Pts.</th>
                        </tr>
                    </thead>
                    <tbody class="text-center table-striped">');

    for ($i = 0; $i < sizeof($data); $i++) {
        $dom .= ("<tr>");
        for ($j = 0; $j < sizeof($league_table_fields); $j++) {
            switch ($j) {
                case 0:
                    $dom .= ('<td class="align-middle submain-bg-color main-color px-0" style="background-color: var(--third-color) !important;">' . ($i + 1) . '°</td>');
                    $dom .= (' <td class="align-middle submain-bg-color" style="background-color: var(--third-color) !important;">
                                <div class="row">
                                    <div class="col col-12 col-md-3 py-1 px-0" style="max-height: 50px !important;"><a href="team-detail.php?id=' . $data[$i][(10)] . '" style="/*max-height: inherit;*/"><img class="bs-icon-sm icon rounded-4" src="' . $data[$i][$j] . '" style="max-height: 40px;width: auto;"></a></div>
                                    <div class="col d-flex align-items-center col-12 col-md-9 px-1 ps-0"><span class="d-flex align-middle justify-content-center col-12 main-color">' . $data[$i][($j + 1)] . '</span></div>
                                </div>
                            </td>');
                    break;
                    //                case 6:
                    //echo ('<td class="align-middle submain-bg-color main-color" style="background-color: var(--third-color) !important;">' . $data[$i][$j] . '</td>');
                    //break;

                default:
                    if (($j >= 2 && $j <= 5) || ($j == 8 || $j == 9)) {
                        $dom .= ('<td class="align-middle submain-bg-color main-color" style="background-color: var(--third-color) !important;">' . $data[$i][$j] . '</td>');
                    }
                    if ($j == 7 || $j == 6)
                        $dom .= ('<td class="d-none d-sm-table-cell align-middle submain-bg-color main-color" style="background-color: var(--third-color) !important;">' . $data[$i][$j] . '</td>');
                    break;
            }
        }
        $dom .= ("</tr>");
    }
    $dom .= ("</tbody></table></div>");
    return $dom;
}

function fetch_top_players()
{
    include "soccer_queries.php";
    $top_players_dom = "";
    $top_players_indicators_dom = '<div class="carousel-indicators">';
    $indicator_dom = '<button type="button" data-bs-target="#carousel-1" data-bs-slide-to="I" class="active"></button>';
    $sql = $top_players_query;
    $data = fetch_fields('players', $top_players_fields, '', $sql);
    for ($i = 0; $i < sizeof($data); $i++) {
        $loop_dom = flag_replacer($top_player_inner_dom, "FLAG", $data[$i], [1, 2, 11, 9, 11, 10, 6, 7, 8]);
        $loop_i_dom = $indicator_dom;
        if ($i > 0) {
            $loop_dom = str_replace("active", "", $loop_dom);
            $loop_i_dom = str_replace("active", "", $indicator_dom);
        }
        $top_players_indicators_dom .= str_replace("I", $i, $loop_i_dom);
        $top_players_dom .= $loop_dom;
    }
    $top_players_indicators_dom .= '</div>';

    return [$top_players_dom, $top_players_indicators_dom];
}
function fetch_fields($table, $fields, $id, $custom_query)
{
    include "/var/www/vhosts/castelancarpinteyro.com/soccer.castelancarpinteyro.com/php scripts/connection.php";
    //session_start();
    //(($_SESSION['email'] == "demo_user@system.com") or ($_SESSION['user'] == "demo_user")) ? $connection = new mysqli("localhost", "comercial_demo", $data[1], ($table . "_demo")):(false);
    if ($custom_query != "" && $custom_query != null) {
        $query = $custom_query;
    } else {
        if ($id == "" or $id == null) {
            $query = "SELECT * FROM `$table`";
        } else {
            $query_field = ($fields[0]);
            $query = "SELECT * FROM `$table` WHERE `$query_field` = '$id'";
        }
    }

    //$result = mysqli_query($connection, $query) or die("Error en la consulta a la base de datos");
    $data = array();

    // Comprobar si las filas son mayores que 0
    $result = $connection->query($query);
    // Verificar si se encontró un usuario válido
    if ($result->num_rows > 0) {
        if ((stripos($query, "UPDATE") === false) && (stripos($query, "INSERT") === false)) {
            $i = 0;
            // Hacer fetch a los datos
            while ($row = $result->fetch_array()) {
                // Procesar cada registro obtenido
                $n = sizeof($fields);
                for ($j = 0; $j < $n; $j++) {
                    ($id == "" or $id == null) ? $data[$i][$j] = $row[$fields[$j]] : $data[$j] = $row[$fields[$j]];
                }
                $i++;
            }
            return $data;
        }
    } else {
        // No hay registros en la tabla, o la consulta hizo una actualización: devolver null
        $connection->close();
        return null;
    }
}

function create_match($info)
{
    include_once "connection.php";

    $sql = "INSERT INTO `matches` VALUES ('', ?, ?, ?, ?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
    #'id_match', 'local_team_id_match', 'visitor_team_id_match', 'match_referee_id_match', 'start_schedule_match', 'finish_schedule_match', 'status_match', 'local_goals_match', 'visitor_goals_match', 'local_shots_match', 'visitor_shots_match', 'local_fouls_match', 'visitor_fouls_match', 'local_corners_macth', 'visitor_corners_match', 'local_yellow_cards_match', 'visitor_yellow_cards_match', 'local_red_cards_match', 'visitor_red_cards_match'
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iiissis", $info[0], $info[1], $info[2], $info[3], $info[4], $info[5], $info[6]);
    if ($stmt->execute()) {
        # Success logic
        echo ("Successfully added match!");
    }
    $stmt->close();
}

function fetch_matches($time)
{
    include "/var/www/vhosts/castelancarpinteyro.com/soccer.castelancarpinteyro.com/php scripts/connection.php";
    include "soccer_queries.php";
    // Previous = 0, Current = 1, Next = 2
    $sql = $match_basic_data_queries[$time];

    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return [$data, $match_basic_data_fields];
}

function matches_output($matches)
{
    $dom_acumulator = "";
    $dom_pattern = ('<div class="row text-center rounded-3 my-2" style="border: 1px solid var(--main-background-color);background: linear-gradient(90deg, #406f10, #203103);">
                        <div class="col">
                            <div class="row mx-1">
                                <div class="col px-1"><span style="height: .3rem !important;">DATE | FLAG</span></div>
                            </div>
                            <div class="row py-2 pb-1">
                                <div class="col align-self-center px-0">
                                    <div class="row mx-1 col-12">
                                        <div class="col align-self-center text-end col-7 px-0"><span class="text-wrap">FLAG</span></div>
                                        <div class="col align-self-center col-5"><img class="col-12" src="FLAG" style="/*min-height: 2.5rem !important;*/max-width: 4rem;"></div>
                                    </div>
                                </div>
                                <div class="col align-self-center col-2 px-1">
                                    <div><span class="fs-1 goal-container">FLAG</span><span>&nbsp;-&nbsp;</span><span class="fs-1 goal-container">FLAG</span></div>
                                </div>
                                <div class="col align-self-center px-0">
                                    <div class="row mx-1 col-12 px-0">
                                        <div class="col align-self-center col-5"><img class="col-12" src="FLAG" style="/*min-height: 2.5rem !important;*/max-width: 4rem;"></div>
                                        <div class="col align-self-center text-start col-7 px-0"><span class="text-wrap">FLAG</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-1">
                                <div class="col px-1">
                                    <span class="submain-color">&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                            <g>
                                                <rect fill="none" height="24" width="24"></rect>
                                            </g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <path d="M11.23,6C9.57,6,8.01,6.66,6.87,7.73C6.54,6.73,5.61,6,4.5,6C3.12,6,2,7.12,2,8.5C2,9.88,3.12,11,4.5,11 c0.21,0,0.41-0.03,0.61-0.08c-0.05,0.25-0.09,0.51-0.1,0.78c-0.18,3.68,2.95,6.68,6.68,6.27c2.55-0.28,4.68-2.26,5.19-4.77 c0.15-0.71,0.15-1.4,0.06-2.06c-0.09-0.6,0.38-1.13,0.99-1.13H22V6H11.23z M4.5,9C4.22,9,4,8.78,4,8.5C4,8.22,4.22,8,4.5,8 S5,8.22,5,8.5C5,8.78,4.78,9,4.5,9z M11,15c-1.66,0-3-1.34-3-3s1.34-3,3-3s3,1.34,3,3S12.66,15,11,15z"></path>
                                                    </g>
                                                    <g>
                                                        <circle cx="11" cy="12" r="2"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>&nbsp;FLAG FLAG
                                    </span></div>
                            </div>
                        </div>
                    </div>');

    for ($i = 0; $i < sizeof($matches[0]); $i++) {
        $temp_dom = flag_replacer($dom_pattern, 'DATE', [match_start_schedule_formatter($matches[0][$i][$matches[1][0]])], [0]);
        if (($matches[0][$i][$matches[1][4]] == NULL) or ($matches[0][$i][$matches[1][4]] == '')) {
            $matches[0][$i][$matches[1][4]] == 0;
        }
        if (($matches[0][$i][$matches[1][5]] == NULL) or ($matches[0][$i][$matches[1][5]] == '')) {
            $matches[0][$i][$matches[1][5]] == 0;
        }
        $dom_acumulator .= flag_replacer($temp_dom, 'FLAG', [$matches[0][$i][$matches[1][0]], $matches[0][$i][$matches[1][1]], $matches[0][$i][$matches[1][2]], $matches[0][$i][$matches[1][3]], $matches[0][$i][$matches[1][4]], $matches[0][$i][$matches[1][5]], $matches[0][$i][$matches[1][6]], $matches[0][$i][$matches[1][7]], $matches[0][$i][$matches[1][8]], $matches[0][$i][$matches[1][9]]], [1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }
    return $dom_acumulator;
}
function flag_replacer($text, $flag, $data_array, $indexes_array)
{
    $chars = strlen($flag);
    $n = substr_count($text, $flag);
    if ($n == sizeof($indexes_array)) {
        // Las apariciones de la flag en la cadena son las mismas que la longitud del arreglo de índices
        for ($i = 0; $i < $n; $i++) {
            $position = strpos($text, $flag);
            $text = substr_replace($text, $data_array[$indexes_array[$i]], $position, $chars);
        }
        return $text;
    } else {
        return null;
    }
}

function match_start_schedule_formatter($start_date)
{
    // Convertir la fecha y hora a un objeto DateTime
    $datetime = new DateTime($start_date);

    // Días de la semana en español
    $week_days = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');

    // Obtener el día de la semana y el número del día
    $day_name = $week_days[$datetime->format('w')];
    $day_number = $datetime->format('d');

    // Obtener el mes y el año
    $month = $datetime->format('m');
    $month_name = DateTime::createFromFormat('!m', $month)->format('F');
    $year = $datetime->format('Y');

    // Obtener la hora y el formato AM/PM
    $time = $datetime->format('h:i');
    $ampm = $datetime->format('a');

    // Formatear el resultado
    $result = ($day_name . ' | ' . $day_number . ' / ' . $month . ' / ' . $year . ' | ' . $time . ' ' . $ampm);

    //echo (match_start_schedule_formatter($fechaInicio) . ' | Polideportivo, Campo 2');
    //$fechaInicio = '2024-04-14 15:00:00';
    return $result;
}

// Función para manejar de forma centralizada las operaciones CRUD que involucra una decisión arbitral
function referee_action()
{
    include_once "/var/www/vhosts/castelancarpinteyro.com/soccer.castelancarpinteyro.com/php scripts/connection.php";
    include "soccer_queries.php";
    // Goal: 0, Foul: 1, Card: 2
    $sql = $match_basic_data_queries[$time];

    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return [$data, $match_basic_data_fields];
}
function add_team($league, $team, $logo, $couch, $description)
{
    include_once "/var/www/vhosts/castelancarpinteyro.com/soccer.castelancarpinteyro.com/php scripts/connection.php";
    $sql = "INSERT INTO `teams` VALUES('', ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, ?, ?);";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $team, $couch, $description, $logo['name']);
    $stmt->execute();
    $id = $connection->insert_id;
    if ($stmt->affected_rows === 0) {
        return false;
    }

    $stmt->close();
    return $id;
}

function save_team_logo($id, $img)
{
    // Ruta donde se guardarán las imágenes de los equipos
    $path = '/var/www/vhosts/castelancarpinteyro.com/soccer.castelancarpinteyro.com/assets/img/teams/';

    // Obtener la extensión del archivo
    $extension = pathinfo($img['name'], PATHINFO_EXTENSION);

    // Generar el nombre único para el archivo
    $file_name = ('team-logo-' . $id . '.' . $extension);

    // Ruta final del archivo
    $final_path = ($path . $file_name);

    // Mover el archivo a la ruta final
    if (move_uploaded_file($img['tmp_name'], $final_path)) {
        include_once "credentials.php";
        $data = generatePasskey('sql');
        $connection = new mysqli('localhost', $data[0], $data[1], $data[2]);
        $img_sql = ("https://soccer.castelancarpinteyro.com/assets/img/teams/" . $file_name);
        $sql = "UPDATE `teams` SET `icon_team` = '$img_sql' WHERE `id_team` = $id";
        if ($connection->query($sql)) {
            // Respuesta de éxito
            return ("Imagen guardada correctamente como $file_name en la ruta $final_path.");
        } else {
            return false;
        }
    } else {
        // Error al mover el archivo
        return "Error al subir la imagen.";
    }
}
function massive_players_upload($team_id)
{
    include_once "credentials.php";
    $val = true;
    $data = generatePasskey('sql');
    $connection = new mysqli('localhost', $data[0], $data[1], $data[2]);
    if (isset($_POST['team-id'])) {
        $n = intval($_POST['players-quantity']);
    } else if (isset($_SESSION['team_id'])) {
        $n = intval($_POST['players-quantity']);
    }
    for ($i = 0; $i < $n; $i++) {
        $sql = "INSERT INTO `players` VALUES('', ?, ?, ?, ?, ?, ?, 0, 0, 0, 0, 0, ?);";
        $name = $_POST['player-name-' . $i];
        $last_name = $_POST['player-last-names-' . $i];
        $nickname = $_POST['player-nickname-' . $i];
        $number = (($_POST['player-number-' . $i] == '') ? 0 : intval($_POST['player-number-' . $i]));
        $position = $_POST['player-position-' . $i];
        $image = $_FILES['player-photo-' . $i]['name'];
        //$position = $_POST['player-position-' . $i];

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssisis", $name, $last_name, $nickname, $number, $position, $team_id, $image);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            $val = false;
        } else {
            $id = $connection->insert_id;
            save_player_icon($id, $_FILES['player-photo-' . $i]);
        }
    }
    return $val;
}

function save_player_icon($id, $img)
{
    // Ruta donde se guardarán las imágenes de los equipos
    $path = '/var/www/vhosts/castelancarpinteyro.com/soccer.castelancarpinteyro.com/assets/img/teams/players/';

    // Obtener la extensión del archivo
    $extension = pathinfo($img['name'], PATHINFO_EXTENSION);

    // Generar el nombre único para el archivo
    $file_name = ('player-img-' . $id . '.' . $extension);

    // Ruta final del archivo
    $final_path = ($path . $file_name);

    // Mover el archivo a la ruta final
    if (move_uploaded_file($img['tmp_name'], $final_path)) {
        include_once "credentials.php";
        $data = generatePasskey('sql');
        $connection = new mysqli('localhost', $data[0], $data[1], $data[2]);
        $img_sql = ("https://soccer.castelancarpinteyro.com/assets/img/teams/players/" . $file_name);
        $sql = "UPDATE `players` SET `img_player` = '$img_sql' WHERE `id_player` = $id";
        if ($connection->query($sql)) {
            // Respuesta de éxito
            return ("Imagen guardada correctamente como $file_name en la ruta $final_path.");
        } else {
            return false;
        }
    } else {
        // Error al mover el archivo
        return "Error al subir la imagen.";
    }
}

function conditionate($original_query, $new_conditions)
{
    // Creo que sólo sirve para WHERE's con ORDER BY's
    return (preg_replace('/WHERE (.+?) (ORDER BY|$)/', 'WHERE ' . $new_conditions . ' $2', $original_query));
}

function fetch_team_cards()
{
    include_once "soccer_queries.php";
    $fields = ['id_team', 'icon_team', 'position', 'coach_team', 'name_team'];
    $cards_dom = "";
    $sql = $team_cards_query;
    $cards = fetch_fields('teams', $fields, '', $sql);
    for ($i = 0; $i < sizeof($cards); $i++) {
        $cards_dom .= flag_replacer($card_unit_dom, 'FLAG', $cards[$i], [0, 1, 2, 3, 4]);
    }
    return $cards_dom;
}
function fetch_player_cards($id)
{
    include_once "soccer_queries.php";
    $c = "'";
    $fields = ['id_player', 'name_player', 'nickname_player', 'last_names_player', 'dorsal_player', 'img_player', 'icon_team'];
    $card_player_dom = ('
    <div class="card col-md-3 m-2 rounded-5" style="min-width: 30% !important;border: 5px dashed var(--main-background-color) !important;background-color: #aeee0034 !important;background: url(' . $c . 'FLAG' . $c . ') no-repeat;background-size: contain;background-position: center;"><img class="card-img-top w-100 d-block pt-1" src="FLAG" />
    <div class="card-body col-12 rounded-4 py-0">
        <div class="row p-3 align-self-center main-bg-color submain-color rounded-5" style="border: 3px solid var(--third-background-color);">
            <div class="col">
                <h4 class="mb-0 fs-3 p-0">FLAG<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill submain-bg-color main-color main-border">#FLAG</span></h4>
                <h4 class="fw-lighter m-0 p-0" style="font-size: smaller;">FLAG</h4>
                <h4 class="fs-1 last-names-container fw-bolder m-0">FLAG</h4>
            </div>
        </div>
    </div>
</div>
    ');


    $cards_dom = "";
    $sql = ("SELECT `p`.`id_player`, `p`.`name_player`, `p`.`nickname_player`, `p`.`last_names_player`, `p`.`dorsal_player`, `p`.`img_player`,
    t.icon_team AS icon_team, `p`.`player_team_id` FROM players p LEFT JOIN teams t ON p.player_team_id = t.id_team WHERE (`player_team_id` = $id);");

    $cards = fetch_fields('players', $fields, '', $sql);
    if ($cards == null) {
        return null;
    }
    for ($i = 0; $i < sizeof($cards); $i++) {
        $cards_dom .= flag_replacer($card_player_dom, 'FLAG', $cards[$i], [6, 5, 1, 4, 2, 3]);
    }
    return $cards_dom;
}

function team_data($id)
{
    include_once "soccer_queries.php";
    $structure = ('
    <div class="row py-3 submain-bg-color main-color rounded-5">
        <div class="col col-12 col-md-4 col-lg-6 align-self-center">
            <div class="row" style="height: 100%;">
                <div class="col text-center" style="max-height: inherit;"><img class="col-10 col-md-11 col-lg-8 col-xxl-7" src="FLAG" /></div>
            </div>
        </div>
        <div class="col col-12 col-md-8 col-lg-6 align-self-center">
            <div class="row">
                <div class="col text-center text-lg-start"><span class="fs-2">Equipo</span><span class="fs-4 text-secondary smaller"> FLAG° en la liga</span></div>
            </div>
            <div class="row text-center text-lg-start">
                <div class="col">
                    <h1 class="fs-1 fw-bolder" style="font-size: 4rem !important;color: white !important;">FLAG</h1>
                </div>
            </div>
            <div class="row text-center text-lg-start">
                <div class="col"><span class="fs-3">DT: FLAG</span></div>
            </div>
            <div class="row px-3">
                <div class="col main-bg-color submain-color rounded-4">
                    <p class="fs-5">FLAG</p>
                </div>
            </div>
        </div>
    </div>');
    $sql = ("SELECT `teams`.*, `position` FROM (
        SELECT `id_team`, ROW_NUMBER() OVER (ORDER BY ((3 * `wins_team`) + `draws_team`) DESC, (`goals_for_team` - `goals_against_team`) DESC) AS `position`
        FROM `teams`) AS `place` JOIN `teams` ON `teams`.`id_team` = `place`.`id_team` WHERE `teams`.`id_team` = $id;");
    $team_fields = $teams_fields;
    $team_fields[] = 'position';

    $data = fetch_fields('teams', $team_fields, '', $sql);

    return flag_replacer($structure, 'FLAG', $data[0], [10, 11, 1, 2, 9]);
}
