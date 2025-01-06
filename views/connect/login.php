<?php $error = &$_SESSION["error"]["login"] ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="stylesheet" href="./styles/main.css">
    <script src="./scripts/theme.js" defer></script>
    <title>Social</title>
</head>

<body>
    <?php include_once("../views/components/header.php") ?>
    <main>
        <section>
            <h2>Création de compte:</h2>
            <form action="/login" method="post" class="bs">
                <div class="input-text-container <?= isset($error) && $error["email"] ? "error" : "" ?>">
                    <input type="text" name="email" id="email" placeholder="">
                    <label for="email"><?= isset($error) &&  $error["email"] ? "Email incorect" : "Email" ?></label>
                </div>
                <div class="input-text-container <?= isset($error) &&  $error["password"] ? "error" : "" ?>">
                    <input type="password" name="password" id="password" placeholder="">
                    <label for="password"><?= isset($error) &&  $error["email"] ? "Mot de passe incorect" : "Mot de passe" ?></label>
                </div>
                <div class="input-checkbox">
                    <input type="checkbox" name="keep" id="keep">
                    <label for="keep">Se souvenir de moi</label>
                </div>
                <div class="form-btn">
                    <a href="/" class="btn red bs">Retour</a>
                    <button class="btn green bs">S'inscrire</button>
                </div>
            </form>
        </section>

    </main>
    <?php include_once("../views/components/footer.php") ?>
</body>

</html>