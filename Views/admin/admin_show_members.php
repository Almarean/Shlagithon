<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/../templates/header_member.php"; ?>

    <div class="container mt-5">
        <section class="main-box clearfix">
            <h1 class="text-center mb-5">Gérer les membres</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Statut</th>
                            <th>Identité</th>
                            <th>Date de création</th>
                            <th>Dernière connexion</th>
                            <th>E-mail</th>
                            <th>Supprimé</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $member) { ?>
                            <tr>
                                <td><?php echo $member->getType(); ?></td>
                                <td><?php echo strtoupper($member->getName()) . " " . $member->getFirstname(); ?></td>
                                <td><?php echo $member->getCreationDate(); ?></td>
                                <td><?php echo $member->getLastConnectionDate(); ?></td>
                                <td><a href="mailto:<?php echo $member->getEmail(); ?>" class="text-dark"><?php echo $member->getEmail(); ?></a></td>
                                <td><?php if ($member->getIsDeleted()) { echo "Oui"; } ?></td>
                                <td>
                                    <div class="ml-1 d-inline"><a href="?edit=<?php echo $member->getId(); ?>" class="table-link" title="EditMember"><i class="fas fa-pencil-alt"></i></a></div>
                                    <div class="ml-1 d-inline"><a href="?delete=<?php echo $member->getId(); ?>" class="table-link text-danger" title="DeleteMember"><i class="fas fa-trash"></i></a></div>
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