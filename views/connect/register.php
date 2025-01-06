<?php $error = &$_SESSION["error"]["register"] ?>
<!DOCTYPE html>
<html lang="fr" >

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
            <form action="/register" method="post" class="bs">
                <div class="input-text-container <?= isset($error) && $error["firstName"] ? "error" : "" ?>">
                    <input type="text" name="firstName" id="firstName" placeholder="">
                    <label for="firstName">Nom</label>
                </div>
                <div class="input-text-container <?= isset($error) && $error["lastName"] ? "error" : "" ?>">
                    <input type="text" name="lastName" id="lastName" placeholder="">
                    <label for="lastName">Prenom</label>
                </div>
                <div class="input-text-container <?= isset($error) && $error["email"] ? "error" : "" ?>">
                    <input type="text" name="email" id="email" placeholder="">
                    <label for="email"><?= isset($error) && $error["email"] ? "Email incorrecte" : "Email" ?></label>
                </div>
                <div class="input-text-container <?= isset($error) && $error["password"] ? "error" : "" ?>">
                    <input type="password" name="password" id="password" placeholder="">
                    <label for="password"><?= isset($error) && $error["password"] ? "Mot de passe incorrecte" : "Mot de passe" ?></label>
                </div>
                <div class="input-text-container <?= isset($error) && $error["confpassword"] ? "error" : "" ?>">
                    <input type="password" name="confpassword" id="confpassword" placeholder="">
                    <label for="confpassword"><?= isset($error) && $error["confpassword"] ? "Confirmation incorrecte" : "Confirmation du mot de passe" ?></label>
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