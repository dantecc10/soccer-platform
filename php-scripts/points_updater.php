<?php
function update_points()
{
    include_once "connection.php";
    $sql = "SELECT COUNT() * FROM users";
    // Verifica la conexión
    if ($connection->connect_error) {
        die("Error de conexión: " . $connection->connect_error);
    }

    $sql = "SELECT id_team FROM teams";
    $result = $connection->query($sql);

    // Verifica si la consulta fue exitosa
    if ($result) {
        $id_teams = array();
        while ($row = $result->fetch_assoc()) {
            $id_teams[] = (int)$row['id_team'];
        }
        //echo "Equipos: ";
        //print_r($id_teams);
    } else {
        echo "Error al ejecutar la consulta: " . $connection->error;
    }

    $sql = "UPDATE `teams` SET `points_team` = ((`wins_team` * 3) + `draws_team`) WHERE (`id_team` = ?);";
    for ($i = 0; $i < sizeof($id_teams); $i++) {
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $id_teams[$i]);
        if ($stmt->execute()) {
            //echo "Puntos actualizados correctamente [$i]"; # Success
        } else {
            //echo "Error al actualizar los puntos [$i]: " . $stmt->error; # Error
            $error = true;
        }
        $stmt->close();
    }

    $connection->close();
    if (isset($error)) {
        return false;
    } else {
        return true;
    }
}
if (update_points()) {
    //echo "Puntos actualizados correctamente";
} else {
    echo "Error al actualizar los puntos";
}
