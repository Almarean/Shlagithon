<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/../templates/header_member.php"; ?>

    <div class="container">
        <section class="mt-5">
            <h1 class="text-center">Recettes publiées</h1>
            <div class="mt-5 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Difficulté</th>
                            <th scope="col">Temps</th>
                            <th scope="col">Nb personnes</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($member->getWrittenRecipes() as $recipe) { ?>
                            <tr>
                                <td><?php echo $recipe->getImage(); ?></td>
                                <td><?php echo $recipe->getName(); ?></td>
                                <td><?php echo $recipe->getDifficulty(); ?></td>
                                <td><?php echo $recipe->getTime(); ?></td>
                                <td><?php echo $recipe->getNbPersons(); ?></td>
                                <td><?php echo $recipe->getType(); ?></td>
                                <td><a href="?id=<?php echo $recipe->getId(); ?>" class="table-link"><i class="fas fa-eye"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>

</html>