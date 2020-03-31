<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/Shlagithon/index.php/"><i class="fas fa-cookie-bite"></i> Shlagithon</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a class="nav-link" href="#">Toutes les recettes</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Recette au hasard</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Chercher" aria-label="Chercher">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <?php
        if (isset($_SESSION["member"])) {
            echo "<span><a class='nav-link text-dark' href='#'><i class='fas fa-user'></i> Compte</span>";
            echo "<span><a class='nav-link text-dark' href='logout'><i class='fas fa-sign-out-alt'></i> Déconnexion</span>";
        } else {
        ?>
        <span>
            <a class="nav-link text-dark" href="login"><i class="fas fa-sign-in-alt"></i> Connexion</a>
        </span>
        <span>
            <a class="nav-link text-dark" href="registration"><i class="fas fa-user-plus"></i> Inscription</a>
        </span>
        <?php
        }
        ?>
    </div>
</nav>