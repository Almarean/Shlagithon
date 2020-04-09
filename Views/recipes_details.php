<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php if (isset($_SESSION["member"])) {
        include __DIR__ . "/templates/header_member.php";
    } else {
        include __DIR__ . "/templates/header_client.php";
    } ?>

    <div class="container">
        <section class="mt-5">
            <h1 class="text-center"><?php echo $recipe->getName(); ?></h1>
            <h4 class="text-center mt-3 font-weight-lighter">
                <?php
                echo ucwords(strtolower($recipe->getType()));
                foreach ($recipe->getTags() as $tag) {
                    echo "<span class='badge badge-pill badge-dark mx-1'>" . $tag->getLabel() . "</span>";
                }
                ?>
            </h4>
            <div class="lead text-center mt-5">
                <p class="d-inline mx-5"><i class="fas fa-stopwatch"></i> <?php echo $recipe->getTime(); ?> min</p>
                <p class="d-inline mx-5"><i class="fas fa-users"></i> <?php echo $recipe->getNbPersons(); ?> personne.s</p>
                <p class="d-inline mx-5">Difficulté
                    <?php
                    $difficulty = $recipe->getDifficulty();
                    $difference = 5 - $difficulty;
                    for ($i = 0; $i < $difficulty; $i++) {
                        echo "<span><i class='fas fa-circle'></i></span>";
                    }
                    for ($i = 0; $i < $difference; $i++) {
                        echo "<span><i class='far fa-circle'></i></span>";
                    }
                    ?>
                </p>
            </div>
            <div class="lead text-center mt-5">
                <form action="" method="POST" enctype="multipart/form-data">
                    <button type="submit"><p class="d-inline mx-5"><i class="fas fa-star"></i> Ajouter aux favoris</p></button>
                </form>
            </div>
            <div class="col mx-auto mt-5">
                <p class="lead text-justify"><?php echo $recipe->getDescription(); ?></p>
            </div>
            <div class="text-center">
                <img src="/Shlagithon/assets/images/<?php echo $recipe->getImage(); ?>" class="img-fluid rounded" alt="image">
            </div>
            <div class="row mx-auto mt-5">
                <article class="col-md-3">
                    <h5>Ustensiles</h5>
                    <ul>
                        <?php foreach ($ustencils as $ustencil) {
                            echo "<li>" . $ustencil->getQuantity() . " " . strtolower($ustencil->getLabel()) . "</li>";
                        } ?>
                    </ul>
                </article>
                <article class="col-md-3">
                    <h5>Ingrédients</h5>
                    <ul>
                        <?php foreach ($ingredients as $ingredient) {
                            echo "<li>" . $ingredient->getQuantity() . " " . strtolower($ingredient->getLabel()) . "</li>";
                        } ?>
                    </ul>
                </article>
                <article class="col-md-3">
                    <h5>Etapes</h5>
                    <ol>
                        <?php foreach ($recipe->getSteps() as $step) {
                            echo "<li>" . $step->getDescription() . "</li>";
                        } ?>
                    </ol>
                </article>
                <article class="col-md-3">
                    <h5>À propos de cette recette</h5>
                    <ul>
                        <?php foreach ($allergens as $allergen) {
                            echo "<li>" . $allergen->getLabel() . "</li>";
                        } ?>
                    </ul>
                </article>
            </div>
            <?php if ($recipe->getAdvice()) { ?>
                <div class="col-md-6 m-auto">
                    <p class="text-justify"><i class="far fa-lightbulb"></i> <?php echo $recipe->getAdvice(); ?></p>
                </div>
            <?php } ?>
            <div class="row mx-auto mt-5">
                <div class="col-md-12">
                    <h4 class="text-center">Commentaires</h4>
                    <div class="container">
                        <?php if(!empty($commentaries)){ ?>
                            <?php foreach($commentaries as $commentary){?>
                                <div class="row" style="margin-top: 20px">
                                    <div class="col-sm-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <strong><?php echo $commentary->getAuthor()->getFirstname() . " " .$commentary->getAuthor()->getName() ?></strong> <span class="text-muted"><?php echo $commentary->getWritingDate() ?></span>
                                            </div>
                                            <div class="panel-body">
                                                <?php echo $commentary->getText()  ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        <?php }?>
                        <?php if(isset($_SESSION["member"])){ ?>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="comment">Ajouter un commentaire</label>
                                                    <textarea name="comment" class="form-control" rows="3"></textarea>
                                                </div>
                                                <button type="submit" name="validate" id="validate" class="btn btn-lg btn-dark btn-block mt-5">Poster</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include __DIR__ . "/templates/footer.php"; ?>
    <?php include __DIR__ . "/templates/scriptsjs.php"; ?>
</body>

</html>