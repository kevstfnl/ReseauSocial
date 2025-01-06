<header>
    <h1><a href="/">LOGO</a></h1>
    <div class="h-controllers">
        <?php if (!empty($_SESSION["user"])) {
            $userId = $_SESSION["user"]["id"]; ?>
            <a href="/new" class="btn green">Poster</a>
            <a href="/disconnect" class="btn red">Déconnection</a>

            <a href="/profile?id=<?= $userId ?>" class="btn profilebtn">
                <picture>
                    <source srcset="./uploads/<?= file_exists("./uploads/$userId/avatar.webp") ? "$userId/avatar.webp" : "default.webp" ?>" type="image/webp">
                    <img src="./uploads/<?= file_exists("./uploads/$userId/avatar.webp") ? "$userId/avatar.webp" : "default.webp" ?>" alt="Profile">
                </picture>
            </a>
        <?php } ?>
        <button id="theme"></button>
    </div>
</header>