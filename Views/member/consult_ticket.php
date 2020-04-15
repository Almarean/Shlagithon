<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
<?php include __DIR__ . "/../templates/header_member.php"; ?>

<div class="container mt-5">
    <section>
        <div class="col">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="text-center"><?php echo $member->getName() ?></h4>
                    <p>Date du ticket : <?php echo $ticket->getWritingDate(); ?></p>
                    <p></p>
                </div>
                <div class="col-md-9">
                    <h3><?php echo $ticket->getSubject(); ?></h3>
                    <p><?php echo $ticket->getText(); ?></p>
                </div>
            </div>
            <?php
            if ($ticketAnswers) {
                foreach ($ticketAnswers as $ticketAnwser) { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="text-center"><?php echo $ticketAnwser->getAuthor()->getName() ?></h4>
                            <p><?php echo $ticket->getWritingDate(); ?></p>
                        </div>
                        <div class="col-md-9">
                            <p><?php echo $ticketAnwser->getText(); ?></p>
                        </div>
                    </div>
                <?php } ?>
                <hr>
            <?php } ?>
        </div>
        <hr>

        <?php if (!$ticket->getIsResolved()){ ?>
            <form id="form-ticket" action="?" method="POST" enctype="multipart/form-data">
                <div class="form-group m-auto">
                    <label for="text" class="text-center">Ajouter un commentaire</label>
                    <textarea class="form-control" name="text" id="text" rows="5" required></textarea>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-dark" id="apply" name="apply"
                            value="<?php echo $ticket->getId(); ?>" title="SendTicket">Envoyer
                    </button>
                </div>
            </form>
        <?php } else { ?>
        <div class="row">
            <h2 class="text-center text-success">Cette requête est passée à l'état résolu.</h2>
        </div>
        <?php }?>

</div>
</section>
</div>

<?php include __DIR__ . "/../templates/footer.php"; ?>
<?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>
</html>