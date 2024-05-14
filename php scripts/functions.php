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

function fetch_matches($time, $id)
{
    include "/var/www/vhosts/castelancarpinteyro.com/soccer.castelancarpinteyro.com/php scripts/connection.php";
    include "soccer_queries.php";
    // Previous = 0, Current = 1, Next = 2 -- $sql = $match_basic_data_queries[$time];
    $sql = ($id == null || $id = "" || $id == 0) ? $match_basic_data_queries[$time] : $match_basic_data_queries[3];

    $stmt = $connection->prepare($sql);
    if ($sql == $match_basic_data_queries[3]) {
        $stmt->bind_param("i", $id);
    }
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
function add_team($league, $team, $logo, $couch, $description, $name_user, $last_names_user, $email_user, $password_user, $role_user)
{
    include_once "/var/www/vhosts/castelancarpinteyro.com/soccer.castelancarpinteyro.com/php scripts/connection.php";
    $sql = "INSERT INTO `teams` VALUES('', ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, ?, ?);";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $team, $couch, $description, $logo['name']);
    $stmt->execute();
    if ($stmt->affected_rows === 0) {
        return false;
    } else {
        $id = $connection->insert_id;
        $sql = "INSERT INTO `users` VALUES('', ?, ?, ?, ?, 0, ?, 1);";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssi", $name_user, $last_names_user, $email_user, $password_user, $id);
        $stmt->execute();
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
        session_start();
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
        $id = $connection->insert_id;
        if ($stmt->affected_rows > 0) {
            $_SESSION['img_exec'] = true;
            $_SESSION['error'] =  (save_player_icon($id, $_FILES['player-photo-' . $i], $connection)) ? "Imagen guardada correctamente." : "Error al guardar la imagen.";
        } else {
            $val = false;
        }
    }
    return $val;
}

function save_player_icon($id, $img, $connection)
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
        $img_sql = ("https://soccer.castelancarpinteyro.com/assets/img/teams/players/" . $file_name);
        $sql = "UPDATE `players` SET `img_player` = '$img_sql' WHERE `id_player` = $id";
        if ($connection->query($sql)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
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
    <div class="card col-md-3 m-2 rounded-5 align-self-center" style="min-width: 30% !important;border: 5px dashed var(--main-background-color) !important;background-color: #aeee0034 !important;background: url(' . $c . 'FLAG' . $c . ') no-repeat;background-size: contain;background-position: center;"><img class="card-img-top w-100 d-block pt-1" src="FLAG" />
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

function logged_in()
{
    session_start();
    if (isset($_SESSION['logged_in'])) {
        return (isset($_SESSION['id_user'])) ? true : false;
    } else {
        return false;
    }
}
//add_match($_POST['team-local'], $_POST['team-visitor'], $_POST['referee-match'], $_POST['date-match'],
//$_POST['time-match'], $_POST['field-match'], $_POST['matchday-match']);
function add_match($local, $visitor, $referee, $date, $time, $field, $matchday)
{
    include_once "connection.php";
    $datetime = $date . ' ' . $time;
    $referee = ($referee != "") ? intval($referee) : NULL;
    if ($referee != NULL) {
        $sql = "INSERT INTO `matches` VALUES('', ?, ?, ?, ?, NULL, 0, ?, ?, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iiissi", $local, $visitor, $referee, $datetime, $field, $matchday);
    } else {
        $sql = "INSERT INTO `matches` VALUES('', ?, ?, NULL, ?, NULL, 0, ?, ?, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iissi", $local, $visitor, $datetime, $field, $matchday);
    }
    $stmt->execute();
    if ($stmt->affected_rows === 0) {
        return false;
    } else {
        return true;
    }
}
function add_foul($foul_info)
{
    include_once "connection.php";
    $type = "foul";
    //$timestamp = date('Y-m-d H:i:s');
    $match = $foul_info[5];
    $player = $foul_info[1];
    $referee = $foul_info[7];
    $team = $foul_info[0];
    $time = $foul_info[6];
    $details = ($foul_info[2] . "|" . $foul_info[3] . "|" . $foul_info[4] . "|" . $foul_info[6] . "|" . $foul_info[8]); // type, amontest, consequence, time, score

    // Cargar la falta a las estadísticas
    $sql = "INSERT INTO `stats` VALUES('', '$type', CURRENT_TIMESTAMP(), ?, ?, ?, ?, ?);";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iiiis", $match, $player, $referee, $team, $details);
    if (!($stmt->execute())) {
        return false;
    }

    /* Añadir información de faltas y tipos de faltas al jugador */
    // Especificar amonestación
    switch ($foul_info[3]) {
        case 0:
            $sql = "UPDATE `players` SET `fouls_player` = (`fouls_player` + 1) WHERE (`id_player` = ?);";
            break;
        case 1:
            $sql = "UPDATE `players` SET `fouls_player` = (`fouls_player` + 1), `yellow_cards_player` = (`yellow_cards_player` + 1) WHERE (`id_player` = ?);";
            break;
        case 2:
            $sql = "UPDATE `players` SET `fouls_player` = (`fouls_player` + 1), `yellow_cards_player` = (`yellow_cards_player` + 1), `red_cards_player` = (`red_cards_player` + 1) WHERE (`id_player` = ?);";
            break;
        case 3:
            $sql = "UPDATE `players` SET `fouls_player` = (`fouls_player` + 1), `red_cards_player` = (`red_cards_player` + 1) WHERE (`id_player` = ?);";
            break;

        default:
            # code...
            break;
    }

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $player);

    $stmt->execute();
    if ($stmt->affected_rows === 0) {
        return false;
    } else {
        return true;
    }
}
function add_goal($goal_info)
{
    session_start();
    include_once "connection.php";
    $type = "goal";
    //$timestamp = date('Y-m-d H:i:s');
    $match = $goal_info[4];
    $player = $goal_info[1];
    $team = $goal_info[0];

    if (isset($_SESSION['teams'])) {
        $goal_info[8] = ($_SESSION['teams'][0] == $team) ? increment_string_score($goal_info[8], 0) : increment_string_score($goal_info[8], 1);
    }

    $details = ($goal_info[3] . "|" . $goal_info[2] . "|" . $goal_info[5] . "|" . $goal_info[8]);
    $referee = $goal_info[6];
    //$time = $goal_info[5];

    // Cargar la falta a las estadísticas
    $sql = "INSERT INTO `stats` VALUES('', '$type', CURRENT_TIMESTAMP(), ?, ?, ?, ?, ?);";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iiiis", $match, $player, $referee, $team, $details);
    if (!($stmt->execute())) {
        return false;
    }

    if (isset($_SESSION['teams'])) {
        $sql = ($_SESSION['teams'][0] == $team) ? "UPDATE `matches` SET `local_goals_match` = (`local_goals_match` + 1) WHERE (`id_match` = ?);" : "UPDATE `matches` SET `visitor_goals_match` = (`visitor_goals_match` + 1) WHERE (`id_match` = ?);";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $match);
        if (!($stmt->execute())) {
            return false;
        }

        $sql = "UPDATE `teams` SET `goals_against_team` = (`goals_against_team` + 1) WHERE (`id_team` = ?);";
        $stmt = $connection->prepare($sql);
        if ($_SESSION['teams'][0] == $team) {
            $stmt->bind_param("i", $_SESSION['teams'][1]);
        } else {
            $stmt->bind_param("i", $_SESSION['teams'][0]);
        }
        if (!($stmt->execute())) {
            return false;
        }

        $sql = "UPDATE `teams` SET `goals_for_team` = (`goals_for_team` + 1) WHERE (`id_team` = ?);";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $team);
        if (!($stmt->execute())) {
            return false;
        }
    }

    /* Añadir información de faltas y tipos de faltas al jugador */
    // Especificar amonestación
    $sql = ($goal_info[3] == 0) ? "UPDATE `players` SET `goals_player` = (`goals_player` + 1) WHERE (`id_player` = ?);" : "UPDATE `players` SET `goals_player` = (`goals_player` + 0) WHERE (`id_player` = ?);";
    $sql = "UPDATE `players` SET `goals_player` = (`goals_player` + 1) WHERE (`id_player` = ?);";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $player);

    return ($stmt->execute()) ? true : false;
}

function match_events($id)
{
    $fields = [
        'id_stat',
        'type_stat',
        'timestamp_stat',
        'stat_match_id',
        'stat_player_id',
        'stat_referee_id',
        'stat_team_id',
        'stat_details',
        'name_player',
        'nickname_player',
        'last_names_player',
        'icon_team'
    ];
    $sql = "SELECT stats.*, players.name_player, players.nickname_player, players.last_names_player, teams.icon_team
                FROM stats JOIN players ON stats.stat_player_id = players.id_player
                JOIN teams ON players.player_team_id = teams.id_team WHERE stats.stat_match_id = $id
            ORDER BY stats.timestamp_stat DESC;";
    $data = fetch_fields("stats", $fields, null, $sql);
    return $data;
}
function proccess_events($fetched_events, $teams)
{
    if ($fetched_events == null) {
        return null;
    }
    $events_dom = "";
    $local_team = $teams[0];
    $visitor_team = $teams[1];
    $q = "'";
    $base_event_dom = '<div class="row my-3"><div class="col align-self-center text-sm-end"><span class="align-middle">home</span></div><div class="col align-self-center col-4 col-md-3 col-lg-2 px-0">CUSTOM-EVENT</div><div class="col align-self-center text-sm-start"><span class="align-middle">visitor</span></div></div>';

    $base_goal_dom = ('<span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat goal"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor"><g><rect fill="none" height="24" width="24"></rect></g><g><g><path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path></g></g></svg> GOAL - GOAL : <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor"><g><rect fill="none" height="24" width="24"></rect></g><g><g><rect height="2" width="6" x="9" y="1"></rect><path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path></g></g></svg> MINUTE&#39;</span>');

    $base_foul_dom = ('');
    $base_yellow_card_dom = ('
    <span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat foul yellow-card">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-rectangle-vertical-filled">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M17 2h-10a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h10a3 3 0 0 0 3 -3v-14a3 3 0 0 0 -3 -3z" stroke-width="0" fill="currentColor"></path>
        </svg>&nbsp;GOAL - GOAL :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                    <g>
                        <rect fill="none" height="24" width="24"></rect>
                    </g>
                    <g>
                        <g>
                            <rect height="2" width="6" x="9" y="1"></rect>
                            <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                        </g>
                    </g>
                </svg>&nbsp;MINUTE' . $q . '</span>
    ');
    $base_red_card_dom = ('
    <span class="py-1 px-3 px-sm-4 col-12 rounded-4 text-nowrap match-stat foul red-card"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-rectangle-vertical-filled">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path d="M17 2h-10a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h10a3 3 0 0 0 3 -3v-14a3 3 0 0 0 -3 -3z" stroke-width="0" fill="currentColor"></path>
                                                                        </svg>&nbsp;GOAL - GOAL :&nbsp;<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                                            <g>
                                                                                <rect fill="none" height="24" width="24"></rect>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                                                    <path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M13,14h-2V8h2V14z"></path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>&nbsp;MINUTE' . $q . '</span>
    ');
    $base_double_yellow_card_dom = ('');

    for ($i = 0; $i < sizeof($fetched_events); $i++) {
        $basic_event_dom = $base_event_dom;
        $goal_dom = $base_goal_dom;
        $foul_yellow_dom = $base_yellow_card_dom;
        $foul_red_dom = $base_red_card_dom;
        $event_data = $fetched_events[$i];
        $locality = ($local_team == $event_data[6]) ? true : false;
        $nickname = ($event_data[9] != null && $event_data[9] != "") ? (" '" . $event_data[9] . "' ") : " ";
        $full_name = ($event_data[8] . $nickname . $event_data[10]);
        $span_inner_doms = [
            ('<img src="' . $event_data[11] . '" class="rem-adjustment">' . $full_name),
            ('<img src="' . $event_data[11] . '" class="rem-adjustment d-md-none">' . $full_name . '<img src="' . $event_data[11] . '" class="rem-adjustment d-none d-md-inline-block">')
        ];

        $basic_event_dom = ($locality) ? str_replace("home", $span_inner_doms[0], $basic_event_dom) : str_replace("visitor", $span_inner_doms[1], $basic_event_dom);
        $basic_event_dom = ($locality) ? str_replace("visitor", "", $basic_event_dom) : str_replace("home", "", $basic_event_dom);
        $custom_event_dom = "";

        //print_r($event_data[7]);
        $details = array();
        $details = explode('|', $event_data[7]);
        //echo ($string_score . " -.- ");
        switch ($event_data[1]) {
            case 'goal':
                $string_score = $details[3];
                $score = explode(',', $string_score);
                $goal_dom = flag_replacer($goal_dom, 'GOAL', [$score[0], $score[1]], [0, 1]);
                $goal_dom = str_replace("MINUTE", (($details[2] == 0) ? "?" : $details[2]), $goal_dom);
                $custom_event_dom = str_replace("CUSTOM-EVENT", $goal_dom, $basic_event_dom);
                break;
            case 'foul':
                $string_score = $details[4];
                //print_r($details);
                $score = explode(',', $string_score);
                $amontest = intval($details[1]);
                switch ($amontest) {
                    case 1:
                        $foul_yellow_dom = flag_replacer($foul_yellow_dom, 'GOAL', [$score[0], $score[1]], [0, 1]);
                        $foul_yellow_dom = str_replace("MINUTE", (($details[3] == 0) ? "?" : $details[3]), $foul_yellow_dom);
                        $custom_event_dom = str_replace("CUSTOM-EVENT", $foul_yellow_dom, $basic_event_dom);
                        break;
                    case 3:
                        $foul_red_dom = flag_replacer($foul_red_dom, 'GOAL', [$score[0], $score[1]], [0, 1]);
                        $foul_red_dom = str_replace("MINUTE", (($details[3] == 0) ? "?" : $details[3]), $foul_red_dom);
                        $custom_event_dom = str_replace("CUSTOM-EVENT", $foul_red_dom, $basic_event_dom);
                        break;
                    default:
                        //echo ("Error en la selección de amonestación.");
                        break;
                }
                break;

            default:
                //continue;
                break;
        }
        $events_dom .= $custom_event_dom;
    }
    return $events_dom;
}

function increment_string_score($string_score, $team)
{
    $goals = explode(',', $string_score);
    ($team == 0) ? $goals[0]++ : $goals[1]++;
    return (implode(',', $goals));
}

function detailed_matches_output()
{
    $fields = [
        'start_schedule_match',
        'field_match',
        'local_name_team',
        'local_icon_team',
        'local_goals_match',
        'visitor_goals_match',
        'visitor_icon_team',
        'visitor_name_team',
        'name_referee',
        'last_names_referee',
        'id_match',
        'status_match',
        'local_team_id',
        'visitor_team_id'
    ];
    $sql = 'SELECT m.start_schedule_match, m.field_match, t1.name_team AS local_name_team, t1.icon_team AS local_icon_team, m.local_goals_match,
       m.visitor_goals_match, t2.icon_team AS visitor_icon_team, t2.name_team AS visitor_name_team,
       r.name_referee, r.last_names_referee, m.id_match, m.status_match, m.local_team_id, m.visitor_team_id
    FROM matches m
    JOIN teams t1 ON m.local_team_id = t1.id_team JOIN teams t2 ON m.visitor_team_id = t2.id_team JOIN referees r ON m.match_referee_id = r.id_referee
    WHERE (m.status_match = 1);';

    include_once "/var/www/vhosts/castelancarpinteyro.com/soccer.castelancarpinteyro.com/php scripts/connection.php";
    $result = $connection->query($sql);
    // Verificar si se encontró un usuario válido

    $data = array();
    if ($result->num_rows > 0) {
            $i = 0;
            // Hacer fetch a los datos
            while ($row = $result->fetch_array()) {
                // Procesar cada registro obtenido
                $n = sizeof($fields);
                for ($j = 0; $j < $n; $j++) {
                    $data[$i][$j] = $row[$fields[$j]];
                }
                $i++;
            }
    }
    $connection->close();

    $matches = $data;

    $q = "'";
    $dom_acumulator = "";
    $dom_pattern = ('
    <div class="row text-center rounded-3 my-2 live-match-container" style="border: 1px solid var(--main-background-color);background: linear-gradient(90deg, #406f10, #203103);">
        <div class="col">
            <div class="row rounded-top" style="background-color: var(--submain-background-color);">
                <div class="col"><span class="fs-4"><i class="la la-trophy"></i>&nbsp;EXAGON CHAMPIONS</span></div>
            </div>
            <div class="row rounded-4">
                <div class="col"><span class="fs-4">STATUS</span></div>
            </div>
            <div class="row">
                <div class="col" style="height: 2rem !important;"><span class="px-4 py-1 mt-1 rounded-3" style="background-color: orangered;">EN VIVO</span></div>
            </div>
            <div class="row py-2">
                <div class="col align-self-center">
                    <div class="row">
                        <div class="col align-self-center px-0 d-lg-none" style="font-size: 1.2rem;text-align: center;"><span class="fs-2">FLAG</span></div>
                        <div class="col col-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col px-0" style="max-height: 5rem;">
                                    <div style="max-height: inherit;">
                                        <div class="p-0 text-lg-end pe-lg-3" style="max-height: inherit;"><img src="FLAG" style="max-height: inherit;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col align-self-center px-0 d-none d-lg-block" style="font-size: 1.2rem;text-align: center;"><span class="fs-2">FLAG</span></div>
                    </div>
                </div>
                <div class="col align-self-center col-3 col-sm-2 col-lg-1">
                    <div class="row">
                        <div class="col">
                            <span class="goal-container my-auto" style="font-size: 3rem;line-height: 250%;">FLAG</span>
                            <span class="fs-6 h-100 my-auto" style="font-size: 5rem;">-</span>
                            <span class="goal-container my-auto" style="font-size: 3rem;line-height: 250%;">FLAG</span>
                        </div>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="row">
                        <div class="col align-self-center px-0" style="font-size: 1.2rem;text-align: center;"><span class="fs-2">FLAG</span></div>
                        <div class="col col-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col px-0" style="max-height: 5rem;">
                                    <div style="max-height: inherit;">
                                        <div class="p-0 p-0 text-lg-start ps-lg-3" style="max-height: inherit;"><img src="FLAG" style="max-height: inherit;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col align-self-center px-0 d-none" style="font-size: 1.2rem;text-align: center;"><span>FLAG</span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col"><span style="height: .3rem !important;">DATE |&nbsp; FLAG</span></div>
            </div>
            <div class="row">
                <div class="col px-0">
                    <div id="accordion-IJ" class="accordion">
                        <div class="accordion-item" style="background-color: rgba(255,255,255,0);border-color: var(--main-background-color);">
                            <h2 class="accordion-header" style="background-color: rgba(255,255,255,0);border-color: var(--main-background-color);"><button class="btn accordion-button px-6 main-color py-2" type="button" style="background-color: rgba(255,255,255,0);" data-bs-toggle="collapse" data-bs-target="#accordion-1-section-1" aria-expanded="true" aria-controls="accoridion-1-section-1"><span class="align-self-center fs-5 text-center col-10">Mostrar detalles y eventos del partido</span></button></h2>
                            <div id="accordion-1-section-1" class="accordion-collapse collapse show">
                                <div class="accordion-body p-1">
                                    <div class="col events-container">
                                        <div class="row my-3">
                                            <div class="col align-self-center"><span class="align-middle main-color">Finalizado</span>
                                                <hr class="my-0 main-color main-bg-color mx-3" style="border: 1.5px solid var(--main-background-color);">
                                            </div>
                                        </div>
                                        <!-- Eventos dinámicos -->
                                        EVENTS
                                        <!-- Eventos dinámicos -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ');

    for ($i = 0; $i < sizeof($matches); $i++) {
        switch ($matches[0][$i][11]) {
            case 0: $replace = "Programado"; break;
            case 1: $replace = "1er tiempo"; break;
            case 2: $replace = "Descanso"; break;
            case 3: $replace = "2do tiempo"; break;
            default: echo "Finalizado"; break;
            str_replace("STATUS", $replace, $dom_pattern);
        }
        $temp_dom = flag_replacer($dom_pattern, 'DATE', [match_start_schedule_formatter($matches[$i][0])], [0]);
        $temp_dom = str_ireplace('IJ', $i, $temp_dom);
        /*if (($matches[0][$i][$fields[4]] == NULL) or ($matches[0][$i][$fields[4]] == '')) { $matches[0][$i][$fields[4]] == 0; }
        if (($matches[0][$i][$fields[5]] == NULL) or ($matches[0][$i][$fields[5]] == '')) { $matches[0][$i][$fields[5]] == 0; }*/
        $temp_dom = flag_replacer($temp_dom, 'FLAG', [$matches[0][$i][0], $matches[0][$i][1], $matches[0][$i][2], $matches[0][$i][3], $matches[0][$i][4], $matches[0][$i][5], $matches[0][$i][6], $matches[0][$i][7], $matches[0][$i][8], $matches[0][$i][9]], [2, 3, 2, 4, 5, 7, 6, 7, 1]);
        $temp_dom = str_replace('EVENTS', proccess_events(match_events($matches[0][$i][10]), [$matches[0][$i][12], $matches[0][$i][13]]), $temp_dom);
        $dom_acumulator .= $temp_dom;
    }
    return $dom_acumulator;
}
