<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <a class="navbar-brand" href="/Shlagithon/index.php/"><i class="fas fa-cookie-bite text-dark"></i> Patoketchup</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a class="nav-link text-dark" href="profile"><i class="fas fa-user-edit"></i> Gérer le compte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="recipes"><i class="fas fa-book"></i> Recettes publiées</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="publication"><i class="fas fa-edit"></i> Publier une recette</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="publication_ticket"><i class="fas fa-edit"></i> Faire une requête</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="show_ticket"><i class="fas fa-edit"></i>Mes requêtes</a>
            </li>
            <?php if (unserialize($_SESSION["member"])->getType() === "ADMIN") { ?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="members"><i class="fas fa-users-cog"></i> Gérer les membres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="recipes?admin"><i class="fas fa-edit"></i> Gérer les recettes</a>
                </li>
            <?php } ?>
        </ul>
        <span>
            <a class="nav-link text-dark" href="logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </span>
    </div>
</nav>