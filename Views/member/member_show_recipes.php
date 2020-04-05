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
                                <td><img class="img-recipe" src="/Shlagithon/assets/images/<?php echo $recipe->getImage(); ?>" alt="image"></td>
                                <td><?php echo $recipe->getName(); ?></td>
                                <td><?php echo $recipe->getDifficulty(); ?></td>
                                <td><?php echo $recipe->getTime(); ?></td>
                                <td><?php echo $recipe->getNbPersons(); ?></td>
                                <td><?php echo $recipe->getType(); ?></td>
                                <td style="display: inline-block; width: 100px; border-top: hidden;">
                                    <div class="mx-2 d-inline"><a href="?editId=<?php echo $recipe->getId(); ?>" class="table-link"><i class="fas fa-pencil-alt"></i></a></div>
                                    <div class="mx-2 d-inline"><a href="?deleteId=<?php echo $recipe->getId(); ?>" class="table-link text-danger"><i class="fas fa-trash"></i></a></div>
                                    <div class="mx-2 d-inline"><a href="?id=<?php echo $recipe->getId(); ?>" class="table-link"><i class="fas fa-eye"></i></a></div>
                                </td>
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