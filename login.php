<?php
$GLOBALS["TITLE"] = "Login";
include "includes/header.php";
include "includes/navbar.php";
session_start();

if(isset($_SESSION['user'])){
    header("Location:http://localhost:5000/profile.php");
    exit(1);
}
$errors = $_SESSION['errors'];
$values = $_SESSION['values'];

?>


<div class="py-4 container mt-2 hero row justify-content-center">
    <form class="col-md-6 mx-auto" method="post" action="controllers/login.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input value="<?php echo $values['email'] ?>" name="email" type="email" class="form-control <?php echo (!empty($errors['email']) ? 'is-invalid' : '') ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php
            if (!empty($errors['email'])) {
                echo "<div class=\"invalid-feedback\">" . $errors['email'] . "</div>";
            }
            else {
                echo "<div id=\"emailHelp\" class=\"form-text\">We'll never share your email with anyone else.</div>";

            }
            ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control <?php echo (!empty($errors['password']) ? "is-invalid" : ""); ?>" id="exampleInputPassword1">
            <?php
            if (!empty($errors['password'])) {
                echo "<div class=\"invalid-feedback\">" . $errors['password'] . "</div>";
            }
            ?>
        </div>

        <a href="/register.php">Don't have an acount register here</a><br>


        <button type="submit" class="btn btn-primary py-6 px-4 mt-2">Login</button>
    </form>
</div>

<?php
include "/includes/footer.php";
unset($_SESSION['errors']);
?>