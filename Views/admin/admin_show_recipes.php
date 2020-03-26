<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/../templates/header_admin.php"; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" id="member-tab">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"><span>Recette</span></th>
                                    <th style="width: 10%;"><span>Utilisateur</span></th>
                                    <th style="width: 10%;"><span>Description</span></th>
                                    <th style="width: 10%;"><span>Difficulté</span></th>
                                    <th style="width: 10%;"><span>Nombre de personnes</span></th>
                                    <th style="width: 10%;"><span>Temps de préparation</span></th>
                                    <th style="width: 10%;"><span>Type</span></th>
                                    <th style="width: 10%;"><span>Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recipes as $recipe) { ?>
                                    <tr>
                                        <td style="width: 10%;">
                                            <img class="img-recipe" src="<?php echo $recipe->getImage();?>" alt="">
                                            <span class="user-subhead"><?php echo $recipe->getName(); ?></span>
                                        </td>
                                        <td style="width: 10%;">
                                            <?php echo strtoupper($recipe->getAuthor()->getName() . ' ' . $recipe->getAuthor()->getFirstname()); ?>
                                        </td>
                                        <td style="width: 10%;">
                                            <?php echo $recipe->getDescription(); ?>
                                        </td>
                                        <td style="width: 10%;">
                                            <?php echo $recipe->getDifficulty(); ?>
                                        </td>
                                        <td style="width: 10%;">
                                            <?php echo $recipe->getNbPersons(); ?>
                                        </td>
                                        <td style="width: 10%;">
                                            <?php echo $recipe->getTime(); ?>
                                        </td>
                                        <td style="width: 10%;">
                                            <?php echo $recipe->getType(); ?>
                                        </td>
                                        <td style="display: inline-block; width: 100px; border-top: hidden;">
                                            <div class="mx-2 d-inline"><a href="?editId=<?php echo $recipe->getId(); ?>" class="table-link"><i class="fas fa-pencil-alt"></i></a></div>
                                            <div class="mx-2 d-inline"><a href="?deleteId=<?php echo $recipe->getId(); ?>" class="table-link text-danger"><i class="fas fa-trash"></i></a></div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>

</html>