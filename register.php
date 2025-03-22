<?php
$GLOBALS["TITLE"] = "Create Acount";
include "includes/header.php";
include "includes/navbar.php";
session_start();
if(isset($_SESSION['user'])){
    header("Location:http://localhost:5000/profile.php");
    exit(1);
}

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $values = $_SESSION['values'];
}
?>




<div class="py-4 container mt-2 hero row justify-content-center">
    <form class="col-md-6 mx-auto" method="post" action="controllers/register.php">

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name"  value="<?php echo $values['first_name'] ?>"  class="form-control <?php if (!empty($errors['first_name'])) echo "is-invalid"; ?>" id="first_name">
            <?php
            if (!empty($errors['first_name'])) {
                echo "<div class=\"invalid-feedback\">" . $errors['first_name'] . "</div>";
            }
            ?>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" value="<?php echo $values['last_name'] ?>" class="form-control <?php if (!empty($errors['last_name'])) echo "is-invalid"; ?>" id="last_name">
            <?php
            if (!empty($errors['last_name'])) {
                echo "<div class=\"invalid-feedback\">" . $errors['last_name'] . "</div>";
            }
            ?>
        </div>


        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" value="<?php echo $values['phone'] ?>"  class="form-control <?php if (!empty($errors['phone'])) echo "is-invalid"; ?>" id="phone">
            <?php
            if (!empty($errors['phone'])) {
                echo "<div class=\"invalid-feedback\">" . $errors['phone'] . "</div>";
            }
            ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" value="<?php echo $values['email'] ?>"  name="email" class="form-control <?php if (!empty($errors["email"])) echo "is-invalid"; ?>" id="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            <?php
            if (!empty($errors['email'])) {
                echo "<div class=\"invalid-feedback\">" . $errors['email'] . "</div>";
            }
            ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control <?php if(!empty($errors['password']) || !empty($errors['confirm']) ) echo "is-invalid"; ?>" id="password">
            <?php
                if(!empty($errors['password'])){
                    echo "<div class=\"invalid-feedback\">". $errors['password'] ."</div>";
                }
              ?>  
        </div>

        <div class="mb-3">
            <label for="confirm" class="form-label">Confirm Password</label>
            <input type="password" name="confirm" class="form-control <?php if(!empty($errors['confirm'])) echo "is-invalid"; ?>" id="confirm">
            <?php
                if(!empty($errors['confirm'])){
                    echo "<div class=\"invalid-feedback\">". $errors['confirm'] ."</div>";
                }
              ?>  
        </div>

        <a href="login.php">Already have an acount login here</a>
        <br>

        <button type="submit" class="btn btn-primary py-6 px-4 mt-2">Register</button>
    </form>
</div>

<?php
include "./includes/footer.php";
unset($_SESSION['errors'])
?>