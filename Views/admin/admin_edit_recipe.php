<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body>
<?php include __DIR__ . "/../templates/header_admin.php"; ?>

<div class="container">
    <section class="mt-5">
        <h1 class="text-center">Édition d'une recette</h1>
        <article>
            <form action="?" method="POST">
                <div class="form-group col-md-6 m-auto green-border-focus">
                    <label for="name">Nom de la recette</label>
                    <input type="text" class="form-control" name="name" id="name"
                           value="<?php echo $recipe->getName(); ?>" required>
                </div>
                <div class="form-group col-md-6 m-auto green-border-focus">
                    <label for="users">Utilisateur</label>
                    <input type="text" readonly class="form-control-plaintext" name="users" id="users"
                           value="<?php echo $recipe->getAuthor()->getName() . " " . $recipe->getAuthor()->getFirstname(); ?>">
                </div>
                <div class="form-group col-md-6 m-auto green-border-focus">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description"
                              rows="5"><?php echo $recipe->getDescription(); ?></textarea>
                </div>
                <div class="form-group col-md-6 m-auto green-border-focus">
                    <label for="time">Temps de préparation (en minutes)</label>
                    <input type="number" name="time" id="time" value="<?php echo $recipe->getTime(); ?>" min="1"
                           max="1440" step="1"/>
                </div>
                <div class="form-row col-md-6 m-auto green-border-focus">
                    <div class="col">
                        <label for="difficulty">Difficulté</label>
                        <input type="number" id="difficulty" name="difficulty"
                               value="<?php echo $recipe->getDifficulty(); ?>" min="1" max="10" step="1"/>
                    </div>
                    <div class="col">
                        <label for="nbPersons">Nombre de personnes</label>
                        <input type="number" name="nbPersons" id="nbPersons"
                               value="<?php echo $recipe->getNbPersons(); ?>" min="1" max="20" step="1"/>
                    </div>
                </div>
                <div class="form-group col-md-6 m-auto green-border-focus">
                    <label for="advice">Conseil de préparation</label>
                    <textarea class="form-control" name="advice" id="advice"
                              rows="5"><?php echo $recipe->getAdvice(); ?></textarea>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" name="validate" value="<?php echo $recipe->getId(); ?>" class="btn btn-dark">
                        Appliquer les modifications
                    </button>
                    <button type="submit" name="return" class="btn btn-warning">Retour</button>
                </div>
            </form>
        </article>
    </section>
</div>

<?php include __DIR__ . "/../templates/footer.php"; ?>
<?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>

</html>