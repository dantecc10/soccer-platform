<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "connection.php";
    $username = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM `users` WHERE `email_user` = ?";

    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id_user, $name_user, $last_names_user, $email_user, $hashed_password, $role_user);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["logged_in"] = true;
                        $_SESSION["id_user"] = $id_user;
                        $_SESSION["name_user"] = $name_user;
                        $_SESSION["last_names_user"] = $last_names_user;
                        $_SESSION["email_user"] = $email_user;
                        $_SESSION["role_user"] = $role_user;

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
