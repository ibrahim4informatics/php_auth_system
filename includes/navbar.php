<?php

$is_authenticated = false;

if ($_SESSION['user']) {
    $is_authenticated = true;
}
?>
<div class="bg-dark">
    <nav class="navbar bg-dark container navbar-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/index.php">Home</a>
                    </li>

                    <?php
                    if ($is_authenticated) {

                        echo "<li class=\"nav-item\">
                        <a class=\"nav-link active\" href=\"/profile.php\">Profile</a>
                    </li>";
                    } else {
                        echo "
                            <li class=\"nav-item\">
                        <a class=\"nav-link active\" href=\"/register.php\">Register</a>
                    </li>

                    <li class=\"nav-item\">
                        <a class=\"nav-link active\" href=\"/login.php\">Login</a>
                    </li>";
                    }
                    ?>
                </ul>

            </div>
        </div>
    </nav>
</div>