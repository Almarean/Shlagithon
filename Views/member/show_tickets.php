<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative min-vh-100 bg-light">
    <?php include __DIR__ . "/../templates/header_member.php"; ?>

    <section class="container mt-5">
        <h1 class="text-center">Mes demandes</h1>
        <div class="mt-5 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Sujet</th>
                        <th scope="col">Date de création</th>
                        <th scope="col">Date de dernière modification</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket) { ?>
                        <tr>
                            <td><?php echo $ticket->getSubject(); ?></td>
                            <td><?php echo $ticket->getWritingDate(); ?></td>
                            <td><?php echo $ticket->getLastUpdateDate(); ?></td>
                            <td class="border-top-0 d-inline-block">
                                <div class="ml-1 d-inline">
                                    <a href="consult-ticket?ticket-id=<?php echo $ticket->getId(); ?>" class="table-link" title="Consultation"><i class="fas fa-eye"></i></a>
                                </div>
                                <?php if (!$ticket->getIsResolved()) { ?>
                                    <div class="ml-1 d-inline">
                                        <a href="?ticket-id=<?php echo $ticket->getId(); ?>&trigger-resolved=<?php echo $ticket->getId(); ?>" class="table-link text-success" title="Resolved"><i class="fas fa-check"></i></a>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </sect>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>

</html>