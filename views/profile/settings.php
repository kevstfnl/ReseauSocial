<?php
$error = &$_SESSION["error"]["settings"];
$userId = $_SESSION["user"]["id"];
?>
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
            <h2>Paramètres:</h2>
            <form action="/settings" method="post" class="bs" enctype="multipart/form-data">
                <textarea name="description" id="description" placeholder="Description" maxlength="255"></textarea>
                <div class="input-file-container">
                    <label for="avatar">Photo de profil:</label>
                    <input type="file" name="avatar" id="avatar" accept="image/*">
                </div>

                <div class="form-btn">
                    <a href="/profile?id=<?= $userId ?>" class="btn red bs">Retour</a>
                    <button class="btn yellow bs">Modifier</button>
                </div>
            </form>
        </section>

    </main>
    <?php include_once("../views/components/footer.php") ?>
</body>

</html>