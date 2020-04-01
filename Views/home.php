<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/templates/header_client.php"; ?>

    <div class="container mt-5">
        <section>
            <div class="row" id="filtered-recipes">

            </div>
        </section>
    </div>

    <?php include __DIR__ . "/templates/footer.php"; ?>
    <?php include __DIR__ . "/templates/scriptsjs.php"; ?>
    <script src="/Shlagithon/assets/js/ajax.js"></script>
</body>

</html>