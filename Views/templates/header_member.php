<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/Shlagithon/index.php/"><i class="fas fa-cookie-bite"></i> Shlagithon</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a class="nav-link" href="profile"><i class="fas fa-user-edit"></i> Gérer le compte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="recipes"><i class="fas fa-book"></i> Recettes publiées</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="publication"><i class="fas fa-edit"></i> Publier une recette</a>
            </li>
            <?php if (unserialize($_SESSION["member"])->getType() === "ADMIN") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="members"><i class="fas fa-users-cog"></i> Gérer les membres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="recipes?admin"><i class="fas fa-edit"></i> Gérer les recettes</a>
                </li>
            <?php } ?>
        </ul>
        <span>
            <a class="nav-link text-dark" href="logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </span>
    </div>
</nav>