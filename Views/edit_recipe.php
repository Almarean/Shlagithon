<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/templates/header_member.php"; ?>

    <div class="container">
        <section class="mt-5">
            <h1 class="text-center">Édition d'une recette</h1>
            <form action="?" method="POST" enctype="multipart/form-data">
                <div class="form-group col-md-6 mt-3 mx-auto">
                    <label for="image">Image de la recette</label>
                    <div class="mt-2">
                        <img src="<?php echo "/Shlagithon/assets/images/" . $recipe->getImage(); ?>" alt="image" class="mx-auto img-thumbnail">
                        <input type="file" name="image" id="image" required>
                    </div>
                </div>
                <div class="form-group col-md-6 mt-3 mx-auto">
                    <label for="name">Nom de la recette</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $recipe->getName(); ?>" required>
                </div>
                <div class="col-md-6 mx-auto mt-3">
                    <p>Auteur : <?php echo $recipe->getAuthor()->getFirstname() . " " . strtoupper($recipe->getAuthor()->getName()); ?></p>
                </div>
                <div class="form-group col-md-6 m-auto">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="5"><?php echo $recipe->getDescription(); ?></textarea>
                </div>
                <div class="form-row col-md-6 mx-auto mt-3">
                    <div class="col">
                        <label for="time">Temps de préparation (en minutes)</label>
                        <input type="number" name="time" class="form-control w-25" id="time" value="<?php echo $recipe->getTime(); ?>" min="1" max="1440" step="1">
                    </div>
                    <div class="col">
                        <label for="type">Type</label>
                        <select name="type" class="form-control" id="type">
                            <?php
                            if ($recipe->getType() === "ENTREE") {
                                echo "<option value='ENTREE' selected='selected'>Entrée</option>";
                            } else {
                                echo "<option value='ENTREE'>Entrée</option>";
                            }
                            if ($recipe->getType() === "PLAT") {
                                echo "<option value='PLAT' selected='selected'>Plat</option>";
                            } else {
                                echo "<option value='PLAT'>Plat</option>";
                            }
                            if ($recipe->getType() === "DESSERT") {
                                echo "<option value='DESSERT' selected='selected'>Dessert</option>";
                            } else {
                                echo "<option value='DESSERT'>Dessert</option>";
                            }
                            if ($recipe->getType() === "AUTRE") {
                                echo "<option value='AUTRE' selected='selected'>Autre</option>";
                            } else {
                                echo "<option value='AUTRE'>Autre</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row col-md-6 mx-auto mt-3">
                    <div class="col">
                        <label for="difficulty">Difficulté</label>
                        <input type="number" class="form-control" id="difficulty" name="difficulty" value="<?php echo $recipe->getDifficulty(); ?>" min="1" max="5" step="1">
                    </div>
                    <div class="col">
                        <label for="nb-persons">Nombre de personnes</label>
                        <input type="number" id="nb-persons" class="form-control" name="nbPersons" value="<?php echo $recipe->getNbPersons(); ?>" min="1" max="20" step="1">
                    </div>
                </div>
                <div class="form-group col-md-6 mx-auto mt-3">
                    <label for="advice">Conseils de préparation</label>
                    <textarea class="form-control" name="advice" id="advice" rows="5"><?php echo $recipe->getAdvice(); ?></textarea>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" name="validate" id="validate" value="<?php echo $recipe->getId(); ?>" class="btn btn-dark">
                        Appliquer les modifications
                    </button>
                    <a href="recipes" name="return" class="btn btn-warning">Retour</a>
                </div>
            </form>
        </section>
    </div>

    <?php include __DIR__ . "/templates/footer.php"; ?>
    <?php include __DIR__ . "/templates/scriptsjs.php"; ?>
</body>

</html>