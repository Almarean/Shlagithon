<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/../templates/header_member.php"; ?>

    <div class="container">
        <section class="mt-5">
            <?php if ($member->getType() === "ADMIN") { ?>
                <h1 class="text-center">Édition d'un membre</h1>
            <?php } else { ?>
                <h1 class="text-center">Gérer le compte</h1>
            <?php } ?>
            <div class="row mt-5">
                <article class="col-md-6 m-auto">
                    <h3>Informations</h3>
                    <div class="lead">
                        <p>Nom : <span><?php echo strtoupper($memberToModify->getName()); ?></span></p>
                        <p>Prénom : <span><?php echo $memberToModify->getFirstname(); ?></span></p>
                        <p>E-mail : <span><?php echo $memberToModify->getEmail(); ?></span></p>
                    </div>
                </article>
                <article class="col-md-6 m-auto">
                    <h3 class="text-center">Modifier les informations</h3>
                    <?php if (isset($_GET["success"]) && $_GET["success"] === "1") { ?>
                        <div class="alert alert-success text-center" role="alert"><i class="fas fa-check"></i> Modification réussie.</div>
                    <?php } elseif (isset($errors) && count($errors) > 0) {
                        echo "<div>";
                        foreach ($errors as $error) {
                            echo "<p class='text-danger'><i class='fas fa-exclamation-triangle'></i> " . $error . "</p>";
                        }
                        echo "</div>";
                    }
                    ?>
                    <form action="?" method="POST">
                        <div class="form-group" hidden>
                            <label for="id" hidden>Id</label>
                            <input type="text" class="form-control" name="id" id="id" value="<?php echo $memberToModify->getId(); ?>" disabled hidden>
                        </div>
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $memberToModify->getName(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $memberToModify->getFirstname(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $memberToModify->getEmail(); ?>" required>
                        </div>
                        <?php if ($member->getType() === "ADMIN") { ?>
                            <div class="form-group">
                                <p>Type d'utilisateur</p>
                                <div class="form-check">
                                    <input type="radio" name="typeRadio" id="radio-admin" value="ADMIN" <?php if ($memberToModify->getType() === "ADMIN") { echo "checked"; } ?>>
                                    <label for="radio-admin">Administrateur</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="typeRadio" id="radio-member" value="MEMBER" <?php if ($memberToModify->getType() === "MEMBER") { echo "checked"; } ?>>
                                    <label for="radio-member">Membre</label>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="input-password">Mot de passe</label>
                            <input type="password" class="form-control" name="password" id="input-password" placeholder="Modifier le mot de passe" autocomplete="new-password">
                            <div id="password-comment" class="font-weight-light"></div>
                        </div>
                        <div class="form-group">
                            <label for="input-confirm-password">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="input-confirm-password" name="confirmPassword" placeholder="Confirmer le mot de passe" autocomplete="new-password">
                            <p id="confirm-password-comment" class="font-weight-light"></p>
                        </div>
                        <div class="text-center mt-3">
                            <?php if ($member->getType() === "ADMIN") { ?>
                                <button type="submit" name="validate" value="<?php echo $memberToModify->getId(); ?>" class="btn btn-dark">Appliquer</button>
                                <button type="submit" name="return" class="btn btn-light">Retour</button>
                            <?php } else { ?>
                                <button type="submit" class="btn btn-dark">Appliquer</button>
                            <?php } ?>
                        </div>
                    </form>
                </article>
            </div>
        </section>
    </div>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
    <script src="/Shlagithon/assets/js/check_password.js"></script>
</body>

</html>