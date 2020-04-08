<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/templates/header_client.php"; ?>
    <div class="container mt-5">
        <div class="text-center logo"><i class="fas fa-cookie-bite"></i> Shlagithon</div>
        <form class="input-group input-group-lg w-75 mx-auto mt-4">
            <input class="form-control mr-2" type="search" name="filter" id="search-input" placeholder="Chercher" aria-label="Chercher">
            <button class="btn btn-outline-dark my-2 my-sm-0" id="search-button"><i class="fas fa-search"></i></button>
        </form>
        <div class="mt-5">
            <div id="homeCarousel" class="carousel slide bg-secondary rounded" data-ride="carousel">
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
        </div>

        <div class="mt-5">
            <div class="row" id="filtered-recipes"></div>
        </div>

        <div class="mt-5">
            <ul class="nav nav-tabs nav-fill mb-4">
                <li class="nav-item">
                    <a class="nav-item nav-link text-dark active" id="nav-entrees-tab" data-toggle="tab" href="#nav-entrees" role="tab" aria-controls="nav-entrees" aria-selected="true">Entrées</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link text-dark" id="nav-dishes-tab" data-toggle="tab" href="#nav-dishes" role="tab" aria-controls="nav-dishes" aria-selected="false">Plats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link text-dark" id="nav-desserts-tab" data-toggle="tab" href="#nav-desserts" role="tab" aria-controls="nav-desserts" aria-selected="false">Desserts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link text-dark" id="nav-others-tab" data-toggle="tab" href="#nav-others" role="tab" aria-controls="nav-others" aria-selected="false">Autres</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="nav-entrees" role="tabpanel" aria-labelledby="nav-entrees-tab">
                    <div class="row">
                        <?php foreach ($entrees as $entree) { ?>
                            <div class="col-md-4">
                                <a href="recipe-details?id=<?php echo $entree->getId(); ?>" class="card mb-5 mx-auto text-dark" style="width: 18rem; height: 20rem;">
                                    <img class="card-img-top mx-auto" src="/Shlagithon/assets/images/<?php echo $entree->getImage(); ?>" alt="image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title mt-auto"><?php echo $entree->getName(); ?></h5>
                                        <div class="row">
                                            <div class="col-6 text-center">
                                                <?php
                                                $difficulty = $entree->getDifficulty();
                                                $difference = 5 - $difficulty;
                                                for ($i = 0; $i < $difficulty; $i++) {
                                                    echo "<span><i class='fas fa-circle'></i></span>";
                                                }
                                                for ($i = 0; $i < $difference; $i++) {
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
                                                $difficulty = $dish->getDifficulty();
                                                $difference = 5 - $difficulty;
                                                for ($i = 0; $i < $difficulty; $i++) {
                                                    echo "<span><i class='fas fa-circle'></i></span>";
                                                }
                                                for ($i = 0; $i < $difference; $i++) {
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
                                                $difficulty = $dessert->getDifficulty();
                                                $difference = 5 - $difficulty;
                                                for ($i = 0; $i < $difficulty; $i++) {
                                                    echo "<span><i class='fas fa-circle'></i></span>";
                                                }
                                                for ($i = 0; $i < $difference; $i++) {
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
                                                $difficulty = $other->getDifficulty();
                                                $difference = 5 - $difficulty;
                                                for ($i = 0; $i < $difficulty; $i++) {
                                                    echo "<span><i class='fas fa-circle'></i></span>";
                                                }
                                                for ($i = 0; $i < $difference; $i++) {
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
            </div>
        </div>
    </div>

    <?php include __DIR__ . "/templates/footer.php"; ?>
    <?php include __DIR__ . "/templates/scriptsjs.php"; ?>
    <script src="/Shlagithon/assets/js/ajax_filter_recipes.js"></script>
</body>

</html>