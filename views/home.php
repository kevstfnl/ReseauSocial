<?php 
$posts = PostHandler::getRecentPost();
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
        <section class="posts-container">
            <article class="post box">
                <a href="#" class="post-profile">
                    <picture>
                        <source srcset="./uploads/<?= "default.webp" ?>" type="image/webp">
                        <img src="./uploads/<?= "default.webp" ?>" alt="Avatar de l'utilisateur">
                    </picture>
                </a>
                <div class="post-content">
                    <h4>Nom - Prenom</h4>
                    <p>Contenue 50</p>
                </div>
                <form action="/review" method="post" class="review">
                    <button value="1" class="btn">↑</button>
                    <p>0</p>
                    <button value="0" class="btn">↓</button>
                </form>
            </article>
        </section>
    </main>
    <?php include_once("../views/components/footer.php") ?>
</body>

</html>