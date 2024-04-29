<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "connection.php";
    $username = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM `administrators` WHERE `email_user` = ?";

    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id_user, $name_user, $last_names_user, $email_user, $hashed_password, $role_user);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id_user;
                        $_SESSION["name"] = $name_user;
                        $_SESSION["last_names"] = $last_names_user;
                        $_SESSION["email"] = $email_user;
                        $_SESSION["role"] = $role_user;

                        header("location: ../index.php");
                    } else {
                        #echo "La contraseña que has ingresado no es válida.";
                        header("location: ../login.php?error=invalidpassword");
                    }
                }
            } else {
                #echo "No se encontró ninguna cuenta con ese nombre de usuario.";
                header("location: ../login.php?error=inexistentuser");
            }
        } else {
            echo "¡Oops! Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
        }
        $stmt->close();
    }
    $connection->close();
} else {
    header("location: ../login.php");
}
