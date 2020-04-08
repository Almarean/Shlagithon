<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/../templates/header_member.php"; ?>

    <div class="container mt-5">
        <section>
            <h1 class="text-center">Publier une recette</h1>
            <div class="row">
                <div id="success" class="text-success"></div>
                <div class="col-md-6">
                    <form action="?" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-3 mx-auto">
                            <?php
                            if (isset($errors) && count($errors) > 0) {
                                echo "<div class='m-auto'>";
                                foreach ($errors as $error) {
                                    echo "<p class='text-danger'><i class='fas fa-exclamation-triangle'></i> " . $error . "</p>";
                                }
                                echo "</div>";
                            }
                            if (isset($_GET["success"])) {
                                echo "<div class='alert alert-success text-center' role='alert'><i class='fas fa-check'></i> Publication réussie !</div>";
                            }
                            ?>
                            <label for="image">Image de la recette</label>
                            <div class="mt-2">
                                <input type="file" name="image" id="image" required>
                            </div>
                        </div>
                        <div class="form-group mt-3 mx-auto">
                            <label for="name">Nom de la recette</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group m-auto">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="5" required></textarea>
                        </div>
                        <div class="form-row mx-auto mt-3">
                            <div class="col">
                                <label for="time">Temps de préparation (en minutes)</label>
                                <input type="number" name="time" class="form-control" id="time" value="1" min="1" max="1440" step="1" required>
                            </div>
                            <div class="col">
                                <label for="type">Type</label>
                                <select name="type" class="form-control" id="type" required>
                                    <option value="ENTREE">Entrée</option>
                                    <option value="PLAT">Plat</option>
                                    <option value="DESSERT">Dessert</option>
                                    <option value="AUTRE" selected="selected">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mx-auto mt-3">
                            <div class="col">
                                <label for="difficulty">Difficulté</label>
                                <input type="number" class="form-control" id="difficulty" name="difficulty" value="1" min="1" max="5" step="1" required>
                            </div>
                            <div class="col">
                                <label for="nb-persons">Nombre de personnes</label>
                                <input type="number" id="nb-persons" class="form-control" name="nbPersons" value="1" min="1" max="20" step="1" required>
                            </div>
                        </div>
                        <div class="form-group mx-auto mt-3">
                            <label for="advice">Conseils de préparation</label>
                            <textarea class="form-control" name="advice" id="advice" rows="5"></textarea>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-dark" id="apply" disabled>Appliquer</button>
                            <a href="recipes" name="return" class="btn btn-light">Retour</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 mt-3">
                    <div id="errors"></div>
                    <div class="my-3">
                        <h4>Ajouter des ustensiles</h4>
                        <div class="text-danger" id="ustencil-error"></div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" id="ustencil-quantity" value="1" min="1" max="2000">
                            </div>
                            <div class="input-group mb-5 col-md-8">
                                <input type="text" id="input-ustencil" class="form-control" placeholder="Ajouter un ustensile" aria-label="ustencil" aria-describedby="button-add-ustencil">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button" id="button-add-ustencil"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <ul id="ustencils"></ul>
                    </div>
                    <div class="my-3">
                        <h4>Ajouter des ingrédients</h4>
                        <div class="text-danger" id="ingredient-error"></div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <input type="number" class="form-control" id="ingredient-quantity" value="1" min="1" max="2000">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control" id="select-unit">
                                    <option value="Gramme.s">Grammes</option>
                                    <option value="Kilogramme.s">Kilogrammes</option>
                                    <option value="" selected="selected">Rien</option>
                                </select>
                            </div>
                            <div class="input-group mb-5 col-md-7">
                                <input type="text" id="input-ingredient" class="form-control" placeholder="Ajouter un ingrédient" aria-label="ingredient" aria-describedby="button-add-ingredient">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button" id="button-add-ingredient"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <ul id="ingredients"></ul>
                    </div>
                    <div class="my-3">
                        <h4>Ajouter des tags</h4>
                        <div class="input-group mb-3">
                            <input type="text" id="input-tag" class="form-control" placeholder="Ajouter un tag" aria-label="tag" aria-describedby="button-add-tag">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" id="button-add-tag"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div id="tags"></div>
                    </div>
                    <div class="my-3">
                        <h4>Ajouter des allergènes</h4>
                        <div class="input-group mb-3">
                            <input type="text" id="input-allergen" class="form-control" placeholder="Ajouter un allergène" aria-label="allergen" aria-describedby="button-add-allergen">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" id="button-add-allergen"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <ul id="allergens"></ul>
                    </div>
                    <div class="text-center">
                        <button id="add" class="btn btn-dark">Ajouter</button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
    <script src="/Shlagithon/assets/js/recipe_publication.js"></script>
    <script src="/Shlagithon/assets/js/ajax_publication_recipe.js"></script>
</body>

</html>