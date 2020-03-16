<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <?php require __DIR__ . "/templates/head.php"; ?>
</head>
<body>
    <?php
    foreach ($tags as $tag) {
        echo "<pre>";
        echo $tag->getLabel();
        echo "</pre>";
    }

    foreach ($allergens as $allergen) {
        echo "<pre>";
        echo $allergen->getLabel();
        echo "</pre>";
    }

    foreach ($ustencils as $ustencil) {
        echo "<pre>";
        echo $ustencil->getLabel();
        echo "</pre>";
    }

    foreach ($ingredients as $ingredient) {
        echo "<pre>";
        echo $ingredient->getLabel();
        echo "</pre>";
    }

    foreach ($members as $member) {
        echo "<pre>";
        echo $member->getName();
        echo "</pre>";
    }

    foreach ($recipes as $recipe) {
        echo "<pre>";
        echo $recipe->getName();
        echo "</pre>";
    }

    foreach ($steps as $step) {
        echo "<pre>";
        echo $step->getDescription();
        echo "</pre>";
    }
    ?>

    <?php require __DIR__ . "/templates/scriptsjs.php"; ?>
</body>
</html>