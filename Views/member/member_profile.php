<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>
<body class="position-relative">
    <?php include __DIR__ . "/../templates/header_client.php"; ?>

    <?php var_dump(unserialize($_SESSION["member"])); ?>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>
</html>