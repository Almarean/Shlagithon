<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body>
    <?php include __DIR__ . "/../templates/header_admin.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12" id="member-tab">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                                <tr>
                                    <th><span>Statut</span></th>
                                    <th><span>Identité</span></th>
                                    <th><span>Date de création</span></th>
                                    <th><span>Dernière connexion</span></th>
                                    <th><span>Email</span></th>
                                    <th><span>Actions</span></th>
                                </tr>
                            </thead>
                            <?php foreach ($members as $member) { ?>
                                <tr>
                                    <td>
                                        <span class="user-subhead"><?php echo $member->getType() ?></span>
                                    </td>
                                    <td>
                                        <a href="#" class="user-link"><?php echo $member->getName() . ' ' . $member->getFirstname(); ?> </a>
                                    </td>
                                    <td>
                                        <?php echo $member->getCreationDate(); ?>
                                    </td>
                                    <td>
                                        <?php echo $member->getLastConnectionDate(); ?>
                                    </td>
                                    <td>
                                        <a href="#"><?php echo $member->getEmail(); ?></a>
                                    </td>
                                    <td style="width: 30%;">
                                        <div class="mx-2 d-inline"><a href="?editId=<?php echo $member->getId(); ?>" class="table-link"><i class="fas fa-pencil-alt"></i></a></div>
                                        <div class="mx-2 d-inline"><a href="?deleteLogin=<?php echo $member->getId(); ?>" class="table-link"><i class="fas fa-trash" style="color: red"></i></a></div>
                                    </td>
                                </tr>
                            <?php } ?>
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