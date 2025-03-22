<?php
require_once __DIR__ . '/../includes/Connection.php';
require_once __DIR__ . '/../includes/Config.php';
require_once __DIR__ . '/../utils/Validator.php';

use conf\Config;
use db\Connection;
use utils\validation\Validator;

session_start();

function redirect(string $path): void
{
    echo "<script> window.location = \"".Config::get_host()."$path\" </script>";
}






$errors = [];
$v = new Validator();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = htmlspecialchars($_POST['password']);
    $confirm = htmlspecialchars($_POST['confirm']);
    $email = htmlspecialchars(trim($_POST['email']));
    $_SESSION['values'] = $_POST;

    foreach ($_POST as $key => $value) {
        if (empty(trim($value))) {
            $errors[$key] = "this field is required";
        }
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        // header("Location:http://localhost:8000/login.php");
        // echo "errors 1";
        redirect("/register.php");

        exit();
    }

    if (!($v->isEmail($email))) {
        $errors["email"] = "Email is not valid";
    }

    if (!($v->isPhone($phone))) {
        $errors["phone"] = "Phone is not valid";
    }


    if (!($v->isStrongPassword($password))) {
        $errors["password"] = "password is not strong enough";
    }

    if ($password !== $confirm) {
        $errors["confirm"] = "passwords does not match";
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        redirect("/register.php");
        exit();
    }

    $db_cred = Config::getDbCred();
    $db = new Connection($db_cred["db_host"], $db_cred["db_name"], $db_cred["username"], $db_cred["password"]);

    $conn = $db->getConnection();

    if (!$conn) {
        $_SESSION['errors'] = ["root" => "can not register for the moment"];
        redirect("/register.php");
        die("Error can not connect to db");
    }


    try {
        $sql = "INSERT INTO user (first_name,last_name,email,phone,password) values (:fn,:ln,:em,:ph,:ps)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":fn", $first_name);
        $stmt->bindParam(":ln", $last_name);
        $stmt->bindParam(":em", filter_var($email, FILTER_SANITIZE_EMAIL));
        $stmt->bindParam(":ph", $phone);
        $stmt->bindParam(":ps", password_hash($password, PASSWORD_BCRYPT));
        $stmt->execute();

        $user_id = $conn->lastInsertId();
        //#autneticate user directly when register success
        $_SESSION['user'] = ["id"=> $user_id];
        redirect("/profile.php");
        $db->close(0);
        exit(0);

    } catch (Exception $e) {
        $_SESSION['errors'] = ["root"=>"can not register for the moment"];
        redirect("/register.php");
        $db->close(1);
        die();
    }
} else {
    redirect("/register.php");
    die();
}
