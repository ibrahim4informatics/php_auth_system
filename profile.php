<?php
session_start();
use db\Connection;
require_once __DIR__ . "/includes/Connection.php";

$GLOBALS["TITLE"] = "Profile";

include "includes/header.php";
include "includes/navbar.php";


if (!(isset($_SESSION['user']))) {
    header("Location:http://localhost:5000/login.php");
    exit(1);
}
$db = new Connection("localhost","php_auth", "root", "admin");
$conn = $db->getConnection();
$user_id = $_SESSION['user']['id'];
if (!$conn){
    die("Error while connecting to db");
}
$sql = "SELECT first_name,last_name,email,phone FROM user WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<div class="container  py-5">
    <h2>Hello To PHP AUTH System</h2>
    <h4>profile informations</h4>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><?php echo $user_id ?></th>
                <td><?php echo $user['first_name'] ?></td>
                <td><?php echo $user['last_name'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['phone'] ?></td>
            </tr>
        </tbody>
    </table>

    <form method="POST" action="/controllers/logout.php">

        <button class=" btn btn-danger px-4 py-2">Logout</button>
    </form>
</div>
<?php
$db->close(0);
include "/includes/footer.php"
?>