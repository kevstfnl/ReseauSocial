<?php
$userId = $_SESSION['user']["id"];
$profileId = (int)$_GET["id"];
$user = User::getById($profileId);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="stylesheet" href="./styles/profile.css">
    <script src="./scripts/theme.js" defer></script>
    <title>Social</title>
</head>

<body>
    <?php include_once("../views/components/header.php") ?>
    <main class="profile">
        <nav class="box">
            <h3>Postes:</h3>
            <div class="filters">
                <a href="/profile?id=<?= $profileId ?>">Récents</a>
                <a href="/profile?id=<?= $profileId ?>&filter=popular">Populaires</a>
                <a href="/profile?id=<?= $profileId ?>&filter=liked">Aimé</a>
            </div>
        </nav>
        <section class="box details">
            <div class="profile-contents">
                <div class="image-container">
                    <picture>
                        <source srcset="./uploads/<?= file_exists("./uploads/$profileId/avatar.webp") ? "$profileId/avatar.webp" : "default.webp" ?>" type="image/webp">
                        <img src="./uploads/<?= file_exists("./uploads/$profileId/avatar.webp") ? "$profileId/avatar.webp" : "default.webp" ?>" alt="Avatar de l'utilisateur">
                    </picture>
                </div>

                <div class="infos">
                    <p><?= $user->getFirstName() ?></p>
                    <p><?= $user->getLastName() ?></p>
                    <p><?= $user->getDescription() ?></p>
                </div>

            </div>

            <?php if ($userId === $profileId) { ?>
                <div class="edit">
                    <a href="/settings" class="btn yellow">Modifier</a>
                </div>
            <?php } ?>

        </section>
        <section class="box posts">
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