<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/../templates/header_admin.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12" id="member-tab">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"><span>Statut</span></th>
                                    <th style="width: 20%;"><span>Identité</span></th>
                                    <th style="width: 20%;"><span>Date de création</span></th>
                                    <th style="width: 20%;"><span>Dernière connexion</span></th>
                                    <th style="width: 20%;"><span>Email</span></th>
                                    <th style="width: 10%;"><span>Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($members as $member) { ?>
                                    <tr>
                                        <td style="width: 10%;">
                                            <span class="user-subhead"><?php echo $member->getType(); ?></span>
                                        </td>
                                        <td style="width: 20%;">
                                            <?php echo strtoupper($member->getName()) . " " . $member->getFirstname(); ?>
                                        </td>
                                        <td style="width: 20%;">
                                            <?php echo $member->getCreationDate(); ?>
                                        </td>
                                        <td style="width: 20%;">
                                            <?php echo $member->getLastConnectionDate(); ?>
                                        </td>
                                        <td style="width: 20%;">
                                            <a href="mailto:<?php echo $member->getEmail(); ?>"><?php echo $member->getEmail(); ?></a>
                                        </td>
                                        <td style="width: 10%;">
                                            <div class="mx-2 d-inline"><a href="?editId=<?php echo $member->getId(); ?>" class="table-link"><i class="fas fa-pencil-alt"></i></a></div>
                                            <div class="mx-2 d-inline"><a href="?deleteLogin=<?php echo $member->getId(); ?>" class="table-link text-danger"><i class="fas fa-trash"></i></a></div>
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