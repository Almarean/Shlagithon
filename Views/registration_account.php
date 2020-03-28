<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/templates/header_client.php"; ?>

    <div class="container">
        <section class="mt-5">
            <h1 class="text-center">Inscription</h1>
            <article>
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
                        <label for="inputName">Nom</label>
                        <input type="text" class="form-control" id="input-name" name="name" value="<?php if (isset($_POST["name"])) { echo $_POST["name"]; } ?>" required>
                    </div>
                    <div class="form-group col-md-6 m-auto">
                        <label for="input-firstname">Prénom</label>
                        <input type="text" class="form-control" id="input-firstname" name="firstname" value="<?php if (isset($_POST["firstname"])) { echo $_POST["firstname"]; } ?>" required>
                    </div>
                    <div class="form-group col-md-6 m-auto">
                        <label for="input-email">Email</label>
                        <input type="email" class="form-control" id="input-email" name="email" value="<?php if (isset($_POST["email"])) { echo $_POST["email"]; } ?>" autocomplete="username" required>
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
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-dark">S'inscrire</button>
                    </div>
                </form>
            </article>
        </section>
    </div>

    <?php include __DIR__ . "/templates/footer.php"; ?>
    <?php include __DIR__ . "/templates/scriptsjs.php"; ?>
    <script src="/Shlagithon/assets/js/registration.js"></script>
</body>

</html>