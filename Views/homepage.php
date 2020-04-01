<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body class="position-relative">
<?php
if (isset($_SESSION["admin"])) {
    include __DIR__ . "/templates/header_admin.php";
} elseif (isset($_SESSION["member"])) {
    include __DIR__ . "/templates/header_member.php";
} else {
    include __DIR__ . "/templates/header_client.php";
}
?>
<div class="container">
    <div id="homeCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#homeCarousel" data-slide-to="1"></li>
            <li data-target="#homeCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="recipe-details?id=<?php echo $dessertCaroussel->getId(); ?>">
                    <img src="<?php echo "/Shlagithon/assets/images/" . $dessertCaroussel->getImage(); ?>" alt="..">

                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $dessertCaroussel->getName(); ?></h5>
                    </div>
                </a>
            </div>
            <div class="carousel-item">
                <a href="recipe-details?id=<?php echo $platCaroussel->getId(); ?>">
                    <img src="<?php echo "/Shlagithon/assets/images/" . $platCaroussel->getImage(); ?>" alt="..">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $platCaroussel->getName(); ?></h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="carousel-item">
            <a href="recipe-details?id=<?php echo $platCaroussel->getId(); ?>">
                <img src="<?php echo "/Shlagithon/assets/images/" . $entreeCaroussel->getImage(); ?>" alt="..">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $entreeCaroussel->getName(); ?></h5>
                </div>
            </a>
        </div>
    </div>
    <a class="carousel-control-prev" href="#homeCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Recette précédente</span>
    </a>
    <a class="carousel-control-next" href="#homeCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <hr>

    <?php
    if (!isset($_GET["type"])) {
        ?>
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link active" href="/Shlagithon/index.php/">Desserts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?type=plats">Plats</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?type=entrees">Entrées</a>
            </li>
        </ul>
        </br>
        <div class="row">
            <?php foreach ($desserts as $dessert) { ?>
                <div class="col-md-4">
                    <div class="card mb-5 mx-auto" style="width: 18rem;">
                        <img class="card-img-top mx-auto"
                             src="<?php echo "/Shlagithon/assets/images/" . $dessert->getImage(); ?>"
                             style="width: 250px; height: 250px;" alt="..">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $dessert->getName(); ?></h5>
                            <p class="card-text"><?php echo $dessert->getDescription(); ?></p>
                            <a href="recipe-details?id=<?php echo $dessert->getId(); ?>"
                               class="btn btn-info">Visualiser</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>


    <?php } elseif ($_GET["type"] === "plats") { ?>
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="/Shlagithon/index.php/">Desserts</a>

            </li>
            <li class="nav-item">
                <a class="nav-link active" href="?type=plats">Plats</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?type=entrees">Entrées</a>
            </li>
        </ul>
        <div class="row">
            <?php foreach ($plats as $plat) { ?>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top mx-auto"
                             src="<?php echo "/Shlagithon/assets/images/" . $plat->getImage(); ?>"
                             style="width: 250px; height: 250px;" alt="..">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $plat->getName(); ?></h5>
                            <p class="card-text"><?php echo $plat->getDescription(); ?></p>
                            <a href="recipe-details?id=<?php echo $plat->getId(); ?>"
                               class="btn btn-info">Visualiser</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } elseif ($_GET["type"] === "entrees") { ?>
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="/Shlagithon/index.php/">Desserts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?type=plats">Plats</a>

            </li>
            <li class="nav-item">
                <a class="nav-link active" href="?type=entrees">Entrées</a>
            </li>
        </ul>
        <div class="row">
            <?php foreach ($entrees as $entree) { ?>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top mx-auto"
                             src="<?php echo "/Shlagithon/assets/images/" . $entree->getImage(); ?>"
                             style="width: 250px; height: 250px;" alt="..">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $entree->getName(); ?></h5>
                            <p class="card-text"><?php echo $entree->getDescription(); ?></p>
                            <a href="recipe-details?id=<?php echo $entree->getId(); ?>"
                               class="btn btn-info">Visualiser</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

</div>

<?php include __DIR__ . "/templates/footer.php"; ?>
<?php include __DIR__ . "/templates/scriptsjs.php"; ?>
</body>

</html>