<?php 
    session_start();
    $GLOBALS["TITLE"] = "Home";
    include "includes/header.php";
    include "includes/navbar.php";
?>


<div class="py-4 container mt-2 hero">
    <h1>Welcome to PHP Folks</h1>
    <p>this is basic authentication system powered by php!</p>
</div>

<?php
    include "/includes/footer.php"
?>