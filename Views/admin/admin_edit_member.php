<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include __DIR__ . "/../templates/head.php"; ?>
</head>

<body class="position-relative">
    <?php include __DIR__ . "/../templates/header_admin.php"; ?>

    <div class="container">
        <section class="mt-5">
            <h1 class="text-center">Édition d'un membre</h1>
            <article>
                <form action="?" method="POST">
                    <div class="form-group col-md-6 m-auto" hidden>
                        <label for="id" hidden>Id</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $member->getId(); ?>" disabled hidden>
                    </div>
                    <div class="form-group col-md-6 m-auto">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $member->getName(); ?>" required>
                    </div>
                    <div class="form-group col-md-6 m-auto">
                        <label for="firstname">Prénom</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $member->getFirstname(); ?>" required>
                    </div>
                    <div class="form-group col-md-6 m-auto">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="name" value="<?php echo $member->getEmail(); ?>" required>
                    </div>
                    <div class="form-group col-md-6 m-auto">
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
                    <div class="text-center mt-3">
                        <button type="submit" name="validate" value="<?php echo $member->getId(); ?>" class="btn btn-dark">Appliquer les modifications</button>
                        <button type="submit" name="return" class="btn btn-warning">Retour</button>
                    </div>
                </form>
            </article>
        </section>
    </div>

    <?php include __DIR__ . "/../templates/footer.php"; ?>
    <?php include __DIR__ . "/../templates/scriptsjs.php"; ?>
</body>

</html>