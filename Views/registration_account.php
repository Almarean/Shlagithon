<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body class="position-relative min-vh-100 bg-light">
    <?php include __DIR__ . "/templates/header_client.php"; ?>
    <div class="container-fluid cover-registration">
        <div class="container">
            <section class="my-5 py-5 bg-light shadow-card rounded">
                <div class="text-center logo"><i class="fas fa-cookie-bite"></i></div>
                <h1 class="h3 mb-3 font-weight-normal text-center">Rejoindre la communauté</h1>
                <div>
                    <?php
                    if (isset($errors) && count($errors) > 0) {
                        echo "<div class='col-md-6 m-auto'>";
                        foreach ($errors as $error) {
                            echo "<p class='text-danger'><i class='fas fa-exclamation-triangle'></i> " . $error . "</p>";
                        }
                        echo "</div>";
                    }
                    ?>
                    <form action="?" method="POST">
                        <div class="form-group col-md-6 m-auto">
                            <label for="input-name">Nom</label>
                            <input type="text" class="form-control" id="input-name" name="name" value="<?php if (isset($_POST["name"])) { echo $_POST["name"]; } ?>" required>
                        </div>
                        <div class="form-group col-md-6 m-auto">
                            <label for="input-firstname">Prénom</label>
                            <input type="text" class="form-control" id="input-firstname" name="firstname" value="<?php if (isset($_POST["firstname"])) { echo $_POST["firstname"]; } ?>" required>
                        </div>
                        <div class="form-group col-md-6 m-auto">
                            <label for="input-email">Email</label>
                            <input type="email" class="form-control" id="input-email" name="email" value="<?php if (isset($_POST["email"])) { echo $_POST["email"]; } ?>" required>
                        </div>
                        <div class="form-group col-md-6 m-auto">
                            <label for="input-password">Mot de passe</label>
                            <input type="password" class="form-control" id="input-password" name="password" autocomplete="new-password" required>
                            <p id="password-comment" class="font-weight-light"></p>
                        </div>
                        <div class="form-group col-md-6 m-auto">
                            <label for="input-confirm-password">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="input-confirm-password" name="confirmPassword" autocomplete="new-password" required>
                            <p id="confirm-password-comment" class="font-weight-light"></p>
                        </div>
                        <div class="text-center">
                            <div class="g-recaptcha d-inline-block" data-sitekey="6LchM_cUAAAAADeQAGFApGK7z0rNKKzfbTm-KFD-"></div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-dark" title="Registration">S'inscrire</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <?php include __DIR__ . "/templates/footer.php"; ?>
    <?php include __DIR__ . "/templates/scriptsjs.php"; ?>
    <script src="/Shlagithon/assets/js/check_password.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>