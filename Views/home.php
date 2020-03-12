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

    foreach ($members1 as $m1) {
        echo "<pre>";
        echo $m1->getName();
        echo "</pre>";
    }
    ?>

    <?php require __DIR__ . "/templates/scriptsjs.php"; ?>
</body>
</html>