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
                        <h4><?php echo $member->getFirstname() . " " . $member->getName(); ?></h4>
                        <p>Créée le <?php echo date_format(date_create($ticket->getWritingDate()), "d/m/Y"); ?> à <?php echo date_format(date_create($ticket->getWritingDate()), "H\hm"); ?></p>
                    </div>
                    <div class="col-md-9">
                        <h3><?php echo $ticket->getSubject(); ?></h3>
                        <p><?php echo $ticket->getText(); ?></p>
                    </div>
                </div>
                <?php if ($ticketAnswers) {
                    foreach ($ticketAnswers as $ticketAnwser) { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="text-center"><?php echo $ticketAnwser->getAuthor()->getName(); ?></h4>
                                <p><?php echo $ticket->getWritingDate(); ?></p>
                            </div>
                            <div class="col-md-9">
                                <p><?php echo $ticketAnwser->getText(); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>

            <?php if (!$ticket->getIsResolved()) { ?>
                <form id="form-ticket" action="?" method="POST">
                    <div class="form-group m-auto">
                        <label for="text" class="text-center">Ajouter un commentaire</label>
                        <textarea class="form-control" name="text" id="text" rows="5" required></textarea>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-dark" id="apply" name="apply" value="<?php echo $ticket->getId(); ?>" title="SendTicket">Envoyer</button>
                    </div>
                </form>
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