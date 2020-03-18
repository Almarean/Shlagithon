<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body>
    <?php include __DIR__ . "/templates/header_client.php"; ?>
    <div class="container mt-5">
        <section>
            <div class="text-center logo"><i class="fas fa-cookie-bite"></i></div>
            <h1 class="h3 mb-3 font-weight-normal text-center">Se connecter</h1>
            <div class="col-md-4 m-auto">
                <form class="form-signin" action="../Controllers/LoginController.php" method="POST">
                    <label for="input-email" class="sr-only">E-mail</label>
                    <input type="email" id="input-email" class="form-control" placeholder="E-mail" name="email" required autofocus>
                    <label for="input-password" class="sr-only">Mot de passe</label>
                    <input type="password" id="input-password" class="form-control" placeholder="Mot de passe" name="password" required>
                    <button class="btn btn-lg btn-dark btn-block mt-5" type="submit">Se connecter</button>
                </form>
            </div>
        </section>
    </div>

    <?php include __DIR__ . "/templates/footer.php"; ?>
    <?php include __DIR__ . "/templates/scriptsjs.php"; ?>
</body>

</html>