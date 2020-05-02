<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body class="position-relative min-vh-100 bg-light">
    <?php include __DIR__ . "/templates/header_client.php"; ?>
    <section class="container-fluid title shadow-card hover-zoom">
        <div class="row">
            <div class="col-md-4 bg-light rounded-right title-search mt-5 shadow-card">
                <h1 class="text-center text-dark display-4"><i class="fas fa-cookie-bite"></i> Patoketchup</h1>
                <h2 class="font-weight-light text-center">Une communauté qui vous régale</h2>
            </div>
            <div class="col-md-8">
                <div class="col-md-4 float-right">
                    <form class="input-group input-group-lg w-auto mx-auto mt-5 shadow-card above">
                        <input class="form-control mr-2" type="search" name="filter" id="search-input" placeholder="Chercher" aria-label="Chercher">
                        <button class="btn btn-outline-light my-2 my-sm-0" id="search-button" title="SearchButton"><i class="fas fa-search"></i></button>
                    </form>
                    <div class="mt-3">
                        <?php if (isset($tags)) {
                            foreach ($tags as $tag) {
                                ?>
                                <span class="badge badge-pill badge-light pointer"><?php echo $tag->getLabel(); ?></span>
                                <?php
                            }
                        } ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row mt-5" id="filtered-recipes">
                        <?php
                        if (isset($filteredRecipes)) {
                            foreach ($filteredRecipes as $recipe) {
                                $description = $recipe->getDescription();
                                if (strlen($description) > 255) {
                                    $description = substr($description, 0, 255) . "...";
                                }
                                $difficultyToDisplay = "";
                                for ($i = 0; $i < $recipe->getDifficulty(); $i++) {
                                    $difficultyToDisplay .= "<span><i class='fas fa-circle'></i></span>";
                                }
                                for ($i = 0; $i < 5 - $recipe->getDifficulty(); $i++) {
                                    $difficultyToDisplay .= "<span><i class='far fa-circle'></i></span>";
                                }
                        ?>
                                <a href="recipe-details?id=<?php echo $recipe->getId(); ?>" class="card text-dark mb-4 w-100">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="/Shlagithon/assets/images/<?php echo $recipe->getImage(); ?>" class="card-img w-100" alt="image">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $recipe->getName(); ?></h5>
                                                <p class="card-text"><?php echo $description; ?></p>
                                                <div class="row">
                                                    <div class="col-md-4 text-center">
                                                        <p class="card-text"><?php echo $difficultyToDisplay; ?></p>
                                                    </div>
                                                    <div class="col-md-4 text-center">
                                                        <p class="card-text"><i class="fas fa-stopwatch"></i> <?php echo $recipe->getTime(); ?> min</p>
                                                    </div>
                                                    <div class="col-md-4 text-center">
                                                        <p class="card-text"><i class="fas fa-users"></i> <?php echo $recipe->getNbPersons(); ?> personne.s</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-light rounded-circle p-3 shadow-card" id="scroll-down-button" title="Down"><i class="fas fa-arrow-down"></i></button>
        </div>
    </section>
    <div class="container mt-5">
        <div id="homeCarousel" class="carousel slide bg-secondary border rounded shadow" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#homeCarousel" data-slide-to="1"></li>
                <li data-target="#homeCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner m-auto">
                <?php foreach ($carouselRecipes as $key => $carouselRecipe) { ?>
                    <div class="carousel-item <?php if ($key === 0) { echo "active"; } ?>">
                        <a href="recipe-details?id=<?php echo $carouselRecipe->getId(); ?>">
                            <img src="/Shlagithon/assets/images/<?php echo $carouselRecipe->getImage(); ?>" class="d-block w-50 m-auto" alt="image">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $carouselRecipe->getName(); ?></h5>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <a class="carousel-control-prev" href="#homeCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Recette précédente</span>
            </a>
            <a class="carousel-control-next" href="#homeCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Recette suivante</span>
            </a>
        </div>
        <div class="mt-5">
            <ul class="nav nav-tabs nav-fill mb-4" role="tablist">
                <li class="nav-item">
                    <a href="#nav-entrees" class="nav-item nav-link text-dark active" id="nav-entrees-tab" data-toggle="tab" role="tab" aria-controls="nav-entrees" aria-selected="true" title="Entrees">Entrées</a>
                </li>
                <li class="nav-item">
                    <a href="#nav-dishes" class="nav-item nav-link text-dark" id="nav-dishes-tab" data-toggle="tab" role="tab" aria-controls="nav-dishes" aria-selected="false" title="Dishes">Plats</a>
                </li>
                <li class="nav-item">
                    <a href="#nav-desserts" class="nav-item nav-link text-dark" id="nav-desserts-tab" data-toggle="tab" role="tab" aria-controls="nav-desserts" aria-selected="false" title="Desserts">Desserts</a>
                </li>
                <li class="nav-item">
                    <a href="#nav-others" class="nav-item nav-link text-dark" id="nav-others-tab" data-toggle="tab" role="tab" aria-controls="nav-others" aria-selected="false" title="Others">Autres</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="nav-entrees" role="tabpanel" aria-labelledby="nav-entrees-tab">
                    <div class="row">
                        <?php foreach ($entrees as $entree) { ?>
                            <div class="col-md-4">
                                <a href="recipe-details?id=<?php echo $entree->getId(); ?>" class="card mb-5 mx-auto text-dark shadow" style="width: 18rem; height: 20rem;">
                                    <img class="card-img-top mx-auto" src="/Shlagithon/assets/images/<?php echo $entree->getImage(); ?>" alt="image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title mt-auto"><?php echo $entree->getName(); ?></h5>
                                        <div class="row">
                                            <div class="col-6 text-center">
                                                <?php
                                                for ($i = 0; $i < $entree->getDifficulty(); $i++) {
                                                    echo "<span><i class='fas fa-circle'></i></span>";
                                                }
                                                for ($i = 0; $i < 5 - $entree->getDifficulty(); $i++) {
                                                    echo "<span><i class='far fa-circle'></i></span>";
                                                }
                                                ?>
                                            </div>
                                            <div class="col-6 text-center">
                                                <p><i class="fas fa-stopwatch"></i> <?php echo $entree->getTime(); ?> min</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-dishes" role="tabpanel" aria-labelledby="nav-dishes-tab">
                    <div class="row">
                        <?php foreach ($dishes as $dish) { ?>
                            <div class="col-md-4">
                                <a href="recipe-details?id=<?php echo $dish->getId(); ?>" class="card mb-5 mx-auto text-dark" style="width: 18rem; height: 20rem;">
                                    <img class="card-img-top mx-auto" src="/Shlagithon/assets/images/<?php echo $dish->getImage(); ?>" alt="image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title mt-auto"><?php echo $dish->getName(); ?></h5>
                                        <div class="row">
                                            <div class="col-6 text-center">
                                                <?php
                                                for ($i = 0; $i < $dish->getDifficulty(); $i++) {
                                                    echo "<span><i class='fas fa-circle'></i></span>";
                                                }
                                                for ($i = 0; $i < 5 - $dish->getDifficulty(); $i++) {
                                                    echo "<span><i class='far fa-circle'></i></span>";
                                                }
                                                ?>
                                            </div>
                                            <div class="col-6 text-center">
                                                <p><i class="fas fa-stopwatch"></i> <?php echo $dish->getTime(); ?> min</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-desserts" role="tabpanel" aria-labelledby="nav-desserts-tab">
                    <div class="row">
                        <?php foreach ($desserts as $dessert) { ?>
                            <div class="col-md-4">
                                <a href="recipe-details?id=<?php echo $dessert->getId(); ?>" class="card mb-5 mx-auto text-dark" style="width: 18rem; height: 20rem;">
                                    <img class="card-img-top mx-auto" src="/Shlagithon/assets/images/<?php echo $dessert->getImage(); ?>" alt="image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title mt-auto"><?php echo $dessert->getName(); ?></h5>
                                        <div class="row">
                                            <div class="col-6 text-center">
                                                <?php
                                                for ($i = 0; $i < $dessert->getDifficulty(); $i++) {
                                                    echo "<span><i class='fas fa-circle'></i></span>";
                                                }
                                                for ($i = 0; $i < 5 - $dessert->getDifficulty(); $i++) {
                                                    echo "<span><i class='far fa-circle'></i></span>";
                                                }
                                                ?>
                                            </div>
                                            <div class="col-6 text-center">
                                                <p><i class="fas fa-stopwatch"></i> <?php echo $dessert->getTime(); ?> min</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-others" role="tabpanel" aria-labelledby="nav-others-tab">
                    <div class="row">
                        <?php foreach ($others as $other) { ?>
                            <div class="col-md-4">
                                <a href="recipe-details?id=<?php echo $other->getId(); ?>" class="card mb-5 mx-auto text-dark" style="width: 18rem; height: 20rem;">
                                    <img class="card-img-top mx-auto" src="/Shlagithon/assets/images/<?php echo $other->getImage(); ?>" alt="image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title mt-auto"><?php echo $other->getName(); ?></h5>
                                        <div class="row">
                                            <div class="col-6 text-center">
                                                <?php
                                                for ($i = 0; $i < $other->getDifficulty(); $i++) {
                                                    echo "<span><i class='fas fa-circle'></i></span>";
                                                }
                                                for ($i = 0; $i < 5 - $other->getDifficulty(); $i++) {
                                                    echo "<span><i class='far fa-circle'></i></span>";
                                                }
                                                ?>
                                            </div>
                                            <div class="col-6 text-center">
                                                <p><i class="fas fa-stopwatch"></i> <?php echo $other->getTime(); ?> min</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-light rounded-circle p-3 shadow-card" id="scroll-top-button" title="Up"><i class="fas fa-arrow-up"></i></button>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . "/templates/footer.php"; ?>
    <?php include __DIR__ . "/templates/scriptsjs.php"; ?>
    <script src="/Shlagithon/assets/js/ajax/ajax_filter_recipes.js"></script>
    <script src="/Shlagithon/assets/js/ihm.js"></script>
</body>

</html>