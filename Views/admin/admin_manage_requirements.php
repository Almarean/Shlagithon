<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative min-vh-100 bg-light">
    <?php include __DIR__ . "/../templates/header_member.php"; ?>

    <section class="container mt-5">
        <h1 class="text-center">Gérer les prérequis</h1>
        <div id="comments"></div>
        <div class="mt-5">
            <div class="row">
                <div class="col-md-3">
                    <label for="select-requirement">Je souhaite ajouter des :</label>
                    <select name="select-filter" id="select-requirement" class="form-control rounded">
                        <option value="">-- Choisir --</option>
                        <option value="allergen">Allergènes</option>
                        <option value="ingredient">Ingrédients</option>
                        <option value="ustencil">Ustensiles</option>
                        <option value="tag">Tags</option>
                    </select>
                </div>
            </div>
            <div id="requirements-list"></div>
        </div>
    </section>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
    <script src="/Shlagithon/assets/js/ajax/ajax_manage_requirements.js"></script>
    <script src="/Shlagithon/assets/js/confirm_delete.js"></script>
</body>

</html>