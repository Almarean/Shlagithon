<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative min-vh-100 bg-light">
    <?php include __DIR__ . "/../templates/header_member.php"; ?>

    <section class="container mt-5">
        <?php if (isset($_GET["favorite"])) { ?>
            <h1 class="text-center">Recettes favorites</h1>
        <?php } else { ?>
            <h1 class="text-center">Recettes publiées</h1>
        <?php } ?>
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
                        <th scope="col">Auteur</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recipes as $recipe) { ?>
                        <tr>
                            <td><img class="img-recipe" src="/Shlagithon/assets/images/<?php echo $recipe->getImage(); ?>" alt="image"></td>
                            <td><?php echo $recipe->getName(); ?></td>
                            <td><?php echo $recipe->getDifficulty(); ?></td>
                            <td><?php echo $recipe->getTime(); ?></td>
                            <td><?php echo $recipe->getNbPersons(); ?></td>
                            <td><?php echo $recipe->getType(); ?></td>
                            <td><?php echo strtoupper($recipe->getAuthor()->getName()) . " " . $recipe->getAuthor()->getFirstname(); ?></td>
                            <td style="display: inline-block; width: 100px; border-top: hidden;">
                                <div class="ml-1 d-inline"><a href="?id=<?php echo $recipe->getId(); ?>" class="table-link" title="DetailsRecipe"><i class="fas fa-eye"></i></a></div>
                                <?php if (isset($_GET["favorite"])) { ?>
                                    <div class="ml-1 d-inline"><a href="?favorite-id=<?php echo $recipe->getId(); ?>" class="table-link" title="Favorite"><i class="fas fa-star-half-alt"></i></a></div>
                                <?php } else { ?>
                                    <div class="ml-1 d-inline"><a href="?edit=<?php echo $recipe->getId(); ?>" class="table-link" title="EditRecipe"><i class="fas fa-pencil-alt"></i></a></div>
                                    <div class="ml-1 d-inline"><a href="?delete=<?php echo $recipe->getId(); if (isset($_GET["admin"])) { echo "&admin"; } ?>" class="table-link text-danger" title="DeleteRecipe"><i class="fas fa-trash"></i></a></div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>

</html>