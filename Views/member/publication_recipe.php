<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative min-vh-100 bg-light">
    <?php include __DIR__ . "/../templates/header_member.php"; ?>

    <div class="container mt-5">
        <section>
            <h1 class="text-center">Publier une recette</h1>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div id="comments"></div>
                    <div class="my-3">
                        <h5>Ajouter des ustensiles</h5>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="ustencil-quantity" hidden>Quantité de l'ustensile</label>
                                <input type="number" class="form-control" id="ustencil-quantity" value="1" min="1" max="2000">
                            </div>
                            <div class="form-group input-group col-md-8">
                                <label for="input-ustencil" hidden>Ajouter un ustensile</label>
                                <select name="input-ustencil" aria-label="ustencil" aria-describedby="button-add-ustencil" class="form-control rounded-left" id="input-ustencil">
                                    <?php foreach ($ustencils as $ustencil) { ?>
                                        <option value="<?php echo $ustencil->getLabel(); ?>"><?php echo $ustencil->getLabel(); ?></option>
                                    <?php } ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button" id="button-add-ustencil" title="AddUstencil"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <ul id="ustencils"></ul>
                    </div>
                    <div class="my-3">
                        <h5>Ajouter des ingrédients</h5>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="ingredient-quantity" hidden>Quantité de l'ingrédient</label>
                                <input type="number" class="form-control" id="ingredient-quantity" value="1" min="1" max="2000">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="select-unit" hidden>Unité</label>
                                <select class="form-control" id="select-unit">
                                    <option value="Gramme.s">Grammes</option>
                                    <option value="Kilogramme.s">Kilogrammes</option>
                                    <option value="" selected="selected">Rien</option>
                                </select>
                            </div>
                            <div class="form-group input-group col-md-7">
                                <label for="input-ingredient" hidden>Ajouter un ingrédient</label>
                                <select name="input-ingredient" aria-label="ingredient" aria-describedby="button-add-ingredient" class="form-control rounded-left" id="input-ingredient">
                                    <?php foreach ($ingredients as $ingredient) { ?>
                                        <option value="<?php echo $ingredient->getLabel(); ?>"><?php echo $ingredient->getLabel(); ?></option>
                                    <?php } ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button" id="button-add-ingredient" title="AddIngredient"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <ul id="ingredients"></ul>
                    </div>
                    <div class="my-3">
                        <h5>Ajouter des tags</h5>
                        <div class="input-group mb-3">
                            <label for="input-tag" hidden>Ajouter un tag</label>
                            <select name="input-tag" aria-label="tag" aria-describedby="button-add-tag" class="form-control rounded-left" id="input-tag">
                                <?php foreach ($tags as $tag) { ?>
                                    <option value="<?php echo $tag->getLabel(); ?>"><?php echo $tag->getLabel(); ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" id="button-add-tag" title="AddTag"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div id="tags"></div>
                    </div>
                    <div class="my-3">
                        <h5>Ajouter des étapes</h5>
                        <div class="input-group mb-3">
                            <label for="input-step" hidden>Ajouter une étape</label>
                            <textarea class="form-control" id="input-step" name="description" id="description" placeholder="Ajouter une étape" rows="5" required></textarea>
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" id="button-add-step" title="AddStep"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <ol id="steps"></ol>
                    </div>
                </div>
                <div class="col-md-6">
                    <form id="form-recipe" action="?" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-3 mx-auto">
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
                                <select name="type" class="form-control" id="type">
                                    <option value="AUTRE" selected="selected">Autre</option>
                                    <option value="ENTREE">Entrée</option>
                                    <option value="PLAT">Plat</option>
                                    <option value="DESSERT">Dessert</option>
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
                            <button type="submit" class="btn btn-dark" id="apply" title="ApplyPublication" disabled>Appliquer</button>
                        </div>
                    </form>
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