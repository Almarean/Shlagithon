<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
<?php include __DIR__ . "/../templates/header_member.php"; ?>

<div class="container mt-5">
    <h1 class="text-center">Mes requêtes</h1>
    <div class="mt-5 table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Sujet</th>
                <th scope="col">Date de création</th>
                <th scope="col">Dernière date de modification</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tickets as $ticket) { ?>
                <tr>
                    <td><?php echo $ticket->getSubject(); ?></td>
                    <td><?php echo $ticket->getWritingDate(); ?></td>
                    <td><?php echo $ticket->getLastUpdateDate(); ?></td>
                    <td style="display: inline-block; width: 100px; border-top: hidden;">
                        <div class="ml-1 d-inline"><a href="consult_ticket?ticketId=<?php echo $ticket->getId(); ?>" class="table-link" title="Consulter"><i class="fas fa-eye"></i></a></div>
                        <?php if(!$ticket->getIsResolved()){ ?>
                            <div class="ml-1 d-inline"><a href="?triggerResolved=<?php echo $ticket->getId(); ?>" class="table-link text-success" title="Passer en résolu"><i class="fas fa-check"></i></a></div>
                        <?php }?>
                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    </section>
</div>
</div>

<?php include __DIR__ . "/../templates/footer.php"; ?>
<?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>
</html>