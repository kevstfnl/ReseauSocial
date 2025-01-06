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
            <h2>Page de connexion:</h2>
            <article class="bs">
                <h3>Deja inscrit ?</h3>
                <a href="/login" class="btn green bs">Se connecté</a>
            </article>
            <p class="text-center">ou</p>
            <article class="bs">
                <h3>Pas encore inscrit ?</h3>
                <a href="/register" class="btn yellow bs">Créer un compte</a>
            </article>
        </section>
    </main>
    <?php include_once("../views/components/footer.php") ?>
</body>

</html>