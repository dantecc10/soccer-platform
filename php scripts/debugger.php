<?php
include_once "functions.php";

//echo (get_day_name("2022-04-11"));

// Ejemplo de uso
$id_equipo = 1; // ID del equipo
$archivo = $_FILES['logo_team']; // Suponiendo que recibes el archivo mediante un formulario

$resultado = save_team_logo($id_equipo, $archivo);
echo $resultado;
