<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php
    if ($member->getType() === "ADMIN") {
        include __DIR__ . "/../templates/header_admin.php";
    } else {
        include __DIR__ . "/../templates/header_member.php";
    }
    ?>

    <div class="container">
        <section class="mt-5">
            <?php if ($member->getType() === "ADMIN") { ?>
                <h1 class="text-center">Édition d'un membre</h1>
            <?php } else { ?>
                <h1 class="text-center">Gérer le compte</h1>
            <?php } ?>
            <div class="row mt-5">
                <?php if ($member->getType() === "MEMBER") { ?>
                    <article class="col-md-6 m-auto">
                        <h3>Informations</h3>
                        <div class="lead">
                            <p>Nom : <span><?php echo strtoupper($member->getName()); ?></span></p>
                            <p>Prénom : <span><?php echo $member->getFirstname(); ?></span></p>
                            <p>E-mail : <span><?php echo $member->getEmail(); ?></span></p>
                        </div>
                    </article>
                <?php } ?>
                <article class="col-md-6 m-auto">
                    <?php if ($member->getType() === "MEMBER") { ?>
                        <h3 class="text-center">Modifier les informations</h3>
                        <?php if (isset($_GET["success"])) { ?>
                            <div class="alert alert-success text-center" role="alert"><i class="fas fa-check"></i> Modification réussie.</div>
                        <?php } ?>
                    <?php } ?>
                    <form action="?" method="POST">
                        <div class="form-group" hidden>
                            <label for="id" hidden>Id</label>
                            <input type="text" class="form-control" name="id" id="id" value="<?php echo $member->getId(); ?>" disabled hidden>
                        </div>
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $member->getName(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $member->getFirstname(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" autocomplete="username" value="<?php echo $member->getEmail(); ?>" required>
                        </div>
                        <?php if ($member->getType() === "ADMIN") { ?>
                            <div class="form-group">
                                <p>Type d'utilisateur</p>
                                <div class="form-check">
                                    <input type="radio" name="typeRadio" id="radio-admin" value="ADMIN">
                                    <label for="radio-admin">Administrateur</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="typeRadio" id="radio-member" value="MEMBER" checked>
                                    <label for="radio-member">Member</label>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Modifier le mot de passe" autocomplete="new-password">
                                <div id="password-comment" class="font-weight-light"></div>
                            </div>
                        <?php } ?>
                        <div class="text-center mt-3">
                            <?php if ($member->getType() === "ADMIN") { ?>
                                <button type="submit" name="validate" value="<?php echo $member->getId(); ?>" class="btn btn-dark">Appliquer les modifications</button>
                                <button type="submit" name="return" class="btn btn-light">Retour</button>
                            <?php } else { ?>
                                <button type="submit" class="btn btn-dark">Appliquer les modifications</button>
                            <?php } ?>
                        </div>
                    </form>
                </article>
            </div>
        </section>
    </div>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
    <script src="/Shlagithon/assets/js/edit_password.js"></script>
</body>

</html>