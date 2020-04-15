<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
<?php include __DIR__ . "/../templates/header_member.php"; ?>

<div class="container mt-5">
    <section>
        <h1 class="text-center">Faire une requête</h1>
        <div class="col">
            <form id="form-ticket" action="?" method="POST" enctype="multipart/form-data">
                <div class="form-group mt-3 mx-auto">
                    <label for="subject">Sujet de la demande</label>
                    <input type="text" class="form-control" name="subject" id="subject" required>
                </div>
                <div class="form-group m-auto">
                    <label for="text" class="text-center">Description de la demande</label>
                    <textarea class="form-control" name="text" id="text" rows="5" required></textarea>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-dark" id="apply" name="apply" title="SendTicket">Envoyer
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

<?php include __DIR__ . "/../templates/footer.php"; ?>
<?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>
</html>