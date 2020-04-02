<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/Shlagithon/index.php/"><i class="fas fa-cookie-bite"></i> Shlagithon</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <?php if (isset($_SESSION["member"])) { ?>
            <?php if (unserialize($_SESSION["member"])->getType() === "ADMIN") { ?>
                <span><a class="nav-link text-dark" href="members-editor"><i class="fas fa-cogs"></i> Espace d'administration</span>
            <?php } ?>
            <span><a class="nav-link text-dark" href="profile"><i class="fas fa-user"></i> Compte</span>
            <span><a class="nav-link text-dark" href="logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</span>
        <?php } else { ?>
            <span><a class="nav-link text-dark" href="login"><i class="fas fa-sign-in-alt"></i> Connexion</a></span>
            <span><a class="nav-link text-dark" href="registration"><i class="fas fa-user-plus"></i> Inscription</a></span>
        <?php } ?>
    </div>
</nav>