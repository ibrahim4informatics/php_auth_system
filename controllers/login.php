<?php
require_once __DIR__ . '/../includes/Connection.php';
require_once __DIR__ . '/../includes/Config.php';

use db\Connection;
use conf\Config;
// $base_url;
function redirect(string $path): void
{
    echo "<script> window.location = \"". Config::get_host() ."/$path\" </script>";
}

session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars(trim($_POST['email']));
    $_SESSION['values'] = $_POST;;

    if (empty(trim($email))) {
        $errors['email'] = "this field is required";
    }
    if (empty(trim($password))) {
        $errors['password'] = "this field is required";
    }
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        redirect("/login.php");
        exit(1);
    }


    $db_cred = Config::getDbCred();
    $db = new Connection($db_cred['db_host'], $db_cred['db_name'], $db_cred['username'], $db_cred['password']);

    $conn = $db->getConnection();

    if (!$conn) {
        $_SESSION['errors'] = ["root" => "can not register for the moment"];
        redirect("/login.php");
        die("Error can not connect to db");
    }


    try {
        $sql = "SELECT password,id FROM user WHERE email=:em";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":em", filter_var($email, FILTER_SANITIZE_EMAIL));
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        # user not exist
        if (!$user) {
            $errors['email'] = "invalid email or password";
            $errors['password'] = "invalid email or password";
            $_SESSION['errors'] = $errors;
            redirect('/login.php');
            exit(1);
        } else {

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = ["id" => $user['id']];
                redirect("/profile.php");
                $db->close(0);
                exit(0);
            } else {



                $errors['email'] = "invalid email or password";
                $errors['password'] = "invalid email or password";
                $_SESSION['errors'] = $errors;
                redirect('/login.php');
                $db->close(1);
                exit(1);
            }
        }
    } catch (Exception $e) {
        $_SESSION['errors'] = ["root" => "can not register for the moment"];
        redirect("/register.php");
        $db->close(1);
        die();
    }
} else {
    redirect("/login.php");
    die();
}
