<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative min-vh-100 bg-light">
<?php include __DIR__ . "/../templates/header_member.php"; ?>

<div class="container mt-5">
    <h1 class="text-center">Liste des demandes</h1>
    <div class="col">
        <form action="?" method="POST">
            <label for="select-filter">Je souhaite ajouter des :</label>
            <div class="row">
                <div class="col-md-3">
                    <select name="select-filter" id="select-filter" class="form-control rounded">
                        <option value="allergene" <?php if ($formName === "allergene") {
                            echo "selected";
                        } ?> >Ajouter des allergènes
                        </option>
                        <option value="ingredient" <?php if ($formName === "ingredient") {
                            echo "selected";
                        } ?> >Ajouter des ingrédients
                        </option>
                        <option value="ustencil" <?php if ($formName === "ustencil") {
                            echo "selected";
                        } ?> >Ajouter des ustensilles
                        </option>
                        <option value="tag" <?php if ($formName === "tag") {
                            echo "selected";
                        } ?> >Ajouter des tags
                        </option>
                    </select>
                </div>
            </div>
        </form>
        <section>
            <?php ?>
            <?php switch ($formName) {
                case "ingredient": ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-3 mx-auto">
                                <label for="ingredient">Ajout d'ingrédients</label>
                                <input type="text" class="form-control" name="ingredient" id="ingredient" required>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-dark" id="apply" name="apply" title="SendIngred">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 overflow-auto" style="height: 344px" id="divIngred">
                            <ul class="list-group" id="list-group-ingredient">
                                <?php foreach ($ingredients as $ingredient) { ?>
                                    <li class="list-group-item"><?php echo $ingredient->getLabel(); ?>
                                        <a class=" text-danger" name="ingred" style="float:right;"
                                           title="removeIngredient" id="<?php echo $ingredient->getId(); ?>"><i
                                                    class="fas fa-trash""></i></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <?php break;
                case "allergene": ?>
                    <div class="col-md-6">
                        <form id="form-ticket" action="?" method="POST">
                            <div class="form-group mt-3 mx-auto">
                                <label for="subject">Ajout d'allergènes</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-dark" id="apply" name="apply" title="SendTicket">
                                    Envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                    <?php break;
                case "tag": ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-3 mx-auto">
                                <label for="tag">Ajout de tags</label>
                                <input type="text" class="form-control" name="tag" id="tag" required>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-dark" id="apply" name="apply" title="SendUst">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 overflow-auto" style="height: 344px" id="divIngred">
                            <ul class="list-group" id="list-group-tag">
                                <?php foreach ($tags as $tag) { ?>
                                    <li class="list-group-item"><?php echo $tag->getLabel(); ?>
                                        <a class=" text-danger" name="ta" style="float:right;"
                                           title="removeTag" id="<?php echo $tag->getId(); ?>"><i
                                                    class="fas fa-trash""></i></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <?php break;
                case "ustencil": ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-3 mx-auto">
                                <label for="ustencil">Ajout d'ustensilles</label>
                                <input type="text" class="form-control" name="ustencil" id="ustencil" required>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-dark" id="apply" name="apply" title="SendUst">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 overflow-auto" style="height: 344px" id="divIngred">
                            <ul class="list-group" id="list-group-ustencil">
                                <?php foreach ($ustencils as $ustencil) { ?>
                                    <li class="list-group-item"><?php echo $ustencil->getLabel(); ?>
                                        <a class=" text-danger" name="uste" style="float:right;"
                                           title="removeUste" id="<?php echo $ustencil->getId(); ?>"><i
                                                    class="fas fa-trash""></i></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <?php break;
            } ?>
        </section>
    </div>
    <div class="mt-5 table-responsive">

    </div>
</div>

<?php include __DIR__ . "/../templates/footer.php"; ?>
<?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
<script src="/Shlagithon/assets/js/ajax_filter_allergenes.js"></script>
</body>

</html>