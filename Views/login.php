<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body class="position-relative min-vh-100 bg-light">
    <?php include __DIR__ . "/templates/header_client.php"; ?>
    <div class="container-fluid cover-login">
        <div class="container my-5">
            <section class="bg-light rounded py-5 shadow-card">
                <div class="text-center logo"><i class="fas fa-cookie-bite"></i></div>
                <h1 class="h3 mb-3 font-weight-normal text-center">Se connecter</h1>
                <div class="col-md-4 m-auto">
                    <?php
                    if (isset($errors) && count($errors) > 0) {
                        echo "<div class='text-center'>";
                        foreach ($errors as $error) {
                            echo "<p class='text-danger'><i class='fas fa-exclamation-triangle'></i> " . $error . "</p>";
                        }
                        echo "</div>";
                    }
                    if (isset($_GET["success"])) {
                        if ($_GET["success"] === "1") {
                            echo "<p class='text-success text-center'><i class='far fa-envelope-open'></i> Un mail de confirmation vous a été envoyé.</p>";
                        } else {
                            echo "<p class='text-warning text-center'><i class='fas fa-exclamation-triangle'></i> Une erreur est survenue lors de l'envoi du mail de confirmation.</p>";
                        }
                    }
                    if (isset($_GET["confirmed"])) {
                        if ($_GET["confirmed"] === "1") {
                            echo "<p class='text-success text-center'><i class='fas fa-check'></i> Votre compte a été confirmé.</p>";
                        } else {
                            echo "<p class='text-warning text-center'><i class='fas fa-exclamation-triangle'></i> Une erreur est survenue lors de la confirmation de votre compte.</p>";
                        }
                    }
                    ?>
                    <form class="form-signin" action="?" method="POST">
                        <label for="input-email" class="sr-only">E-mail</label>
                        <input type="email" id="input-email" class="form-control" placeholder="E-mail" name="email" value="<?php if (isset($_GET["email"])) { echo $_GET["email"]; } ?>" required autofocus>
                        <label for="input-password" class="sr-only">Mot de passe</label>
                        <input type="password" id="input-password" class="form-control" placeholder="Mot de passe" name="password" autocomplete="current-password" required>
                        <button class="btn btn-lg btn-dark btn-block mt-5" type="submit">Se connecter</button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <?php include __DIR__ . "/templates/footer.php"; ?>
    <?php include __DIR__ . "/templates/scriptsjs.php"; ?>
</body>

</html>