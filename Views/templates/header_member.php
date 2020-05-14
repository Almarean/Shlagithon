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
                <a class="nav-link text-dark" href="recipes"><i class="fas fa-book"></i> Mes recettes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="publication"><i class="far fa-paper-plane"></i> Publier une recette</a>
            </li>
            <?php if (unserialize($_SESSION["member"])->getType() === "MEMBER") { ?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="publication-ticket"><i class="fas fa-question-circle"></i> Faire une demande</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="show-tickets"><i class="fas fa-user-tag"></i> Mes demandes</a>
                </li>
            <?php } elseif (unserialize($_SESSION["member"])->getType() === "ADMIN") { ?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="manage-tickets"><i class="fas fa-question-circle"></i> Gérer les demandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="members"><i class="fas fa-users-cog"></i> Gérer les membres</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-edit"></i> Gestion des recettes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="recipes?admin"><i class="fas fa-angle-right"></i> Gérer les recettes</a>
                        <a class="dropdown-item" href="requirements"><i class="fas fa-angle-right"></i> Gérer les prérequis</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <span>
            <a class="nav-link text-dark" href="logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </span>
    </div>
</nav>