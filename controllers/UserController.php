<?php

class userController {

    function index() {
        
    }

    function register() {
        require_once 'views/user/register.php';
    }

    function save() {
        if (isset($_POST)) {
            $errors = [];
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $surnames = isset($_POST['surnames']) ? $_POST['surnames'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;
            $rpassword = isset($_POST['rpassword']) ? $_POST['rpassword'] : null;

            // Validations
            if (!is_numeric($name) && !preg_match("/[0-9]/", $name)) {
                $validate_name = true;
            } else {
                $validate_name = false;
                $errors['name'] = "Nombre no válido!";
            }

            if (!is_numeric($surnames) && !preg_match("/[0-9]/", $surnames)) {
                $validate_surnames = true;
            } else {
                $validate_surnames = false;
                $errors['surnames'] = "Apellidos no válidos!";
            }

            if (filter_var($email, FILTER_SANITIZE_EMAIL)) {
                $validate_email = true;
            } else {
                $validate_email = false;
                $errors['email'] = "Correo no válido!";
            }

            if ($password == $rpassword) {
                $validate_password = true;
            } else {
                $validate_password = false;
                $errors['password'] = "Las contraseñas no coinciden!";
            }

            // Database
            if (count($errors) == 0) {

                //Enctype Password
                $safety_password = password_hash($password,
                        PASSWORD_BCRYPT,
                        ['cost' > 4]);
                require_once 'models/user.php';
                $user = new User();

                $user->setName($name);
                $user->setSurnames($surnames);
                $user->setEmail($email);
                $user->setPassword($safety_password);
                $query = $user->saveUser($user);

                if ($query) {
                    $_SESSION['REGISTER']['COMPLETE'] = "¡Se ha registrado correctamente!";
                    header("Location: " . base_url);
                } else {
                    $_SESSION['REGISTER']['FAILED'] = "¡No se ha podido registrar!";
                    header("Location: " . base_url . "user/register");
                }
            } else {
                $_SESSION['REGISTER']['ERROR'] = $errors;
                header("Location: " . base_url . "user/register");
            }
        }
    }

    function login() {
        if (isset($_POST)) {
            $error = [];
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;

            // Validations
            if (filter_var($email, FILTER_SANITIZE_EMAIL)) {
                $validate_email = true;
            } else {
                $validate_email = false;
                $error['email'] = "¡Formato de email incorrecto!";
            }

            if (!empty($password)) {
                $validate_password = true;
            } else {
                $validate_password = false;
                $error['password'] = "¡Contraseña incorrecta!";
            }

            // Database
            if (count($error) == 0) {
                require_once 'models/user.php';
                $user = new User();
                $query = $user->loginUser($email);

                
                    // Verify Client Password
                    $client = mysqli_fetch_assoc($query);
                    $client_password = $client['password'];

                    $password_verified = password_verify($password, $client_password);
                    if ($password_verified) {
                        $_SESSION['LOGIN']['USER'] = $client;
                        header("Location: " . base_url);
                    } else {
                        $_SESSION['LOGIN']['FAILED']['PASSWORD'] = "¡Email o contraseña incorrectos!";
                        header("Location: " . base_url);
                    }
            } else {
                $_SESSION['LOGIN']['ERROR'] = $error;
                header("Location: " . base_url);
            }
        }
    }

    function exit() {
        if (isset($_SESSION['LOGIN'])) {
            unset($_SESSION['LOGIN']);
        }
        header("Location: " . base_url);
    }

}

?>
