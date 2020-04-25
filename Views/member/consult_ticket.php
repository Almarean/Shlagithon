<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative min-vh-100 bg-light">
<?php include __DIR__ . "/../templates/header_member.php"; ?>

<div class="container mt-5">
    <div>
        <div class="col">
            <div class="row">
                <div class="col-md-3">
                    <h4><?php echo $member->getFirstname() . " " . strtoupper($member->getName()); ?></h4>
                    <p>Créée le <?php echo date_format(date_create($ticket->getWritingDate()), "d/m/Y"); ?> à <?php echo date_format(date_create($ticket->getWritingDate()), "H\hm"); ?></p>
                </div>
                <div class="col-md-9">
                    <h3><?php echo $ticket->getSubject(); ?></h3>
                    <p class="border p-3 rounded bg-white"><?php echo $ticket->getText(); ?></p>
                </div>
            </div>
            <?php if ($ticketAnswers) {
                foreach ($ticketAnswers as $ticketAnswer) { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <?php if ($ticketAnswer->getAuthor()->getType() === "ADMIN") { ?>
                                <h4 class="text-success"><span>Administrateur</span></h4>
                            <?php } else { ?>
                                <h4><?php echo $ticketAnswer->getAuthor()->getName() . " " . strtoupper($ticketAnswer->getAuthor()->getName()); ?></h4>
                            <?php } ?>
                            <p>À répondu le <?php echo date_format(date_create($ticketAnswer->getWritingDate()), "d/m/Y"); ?> à <?php echo date_format(date_create($ticketAnswer->getWritingDate()), "H\hm"); ?></p>
                        </div>
                        <div class="col-md-9">
                            <p class="border p-3 rounded bg-dark text-white"><?php echo $ticketAnswer->getText(); ?></p>
                        </div>
                    </div>
                <?php } } ?>
        </div>

        <?php if (!$ticket->getIsResolved()) { ?>
            <form id="form-ticket" action="?" method="POST">
                <div class="form-group m-auto">
                    <label for="text">Ajouter un commentaire</label>
                    <textarea class="form-control" name="text" id="text" rows="5" required></textarea>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-dark" id="apply" name="apply" value="<?php echo $ticket->getId(); ?>" title="SendTicket">Envoyer</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="show-tickets?ticket-id=<?php echo $ticket->getId(); ?>" class="btn btn-success" title="Resolved"><i class="fas fa-check"></i> Mettre en résolu</a>
            </div>
        <?php } else { ?>
            <div class="col-md-6 m-auto">
                <div class="alert alert-success text-center" role="alert">Cette demande est résolue !</div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include __DIR__ . "/../templates/footer.php"; ?>
<?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>

</html>