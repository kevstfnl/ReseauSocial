<?php
session_start();

require_once("../core/Router.php");
require_once("../src/models/database/Database.php");
require_once("../src/models/users/UserHandler.php");
require_once("../src/models/users/User.php");
require_once("../src/models/users/UserTokenHandler.php");
require_once("../src/models/users/UserToken.php");
require_once("../src/models/post/PostHandler.php");
require_once("../src/models/post/Post.php");
require_once("../src/models/post/ReviewHandler.php");
require_once("../src/models/post/Review.php");
require_once("../src/controllers/Controller.php");
require_once("../src/controllers/MainController.php");
require_once("../src/controllers/connect/RegisterController.php");
require_once("../src/controllers/connect/LoginController.php");
require_once("../src/controllers/connect/DisconnectController.php");
require_once("../src/controllers/profile/ProfileController.php");
require_once("../src/controllers/profile/SettingsController.php");


if (!empty($_SESSION["user"])) {
    if ($_SESSION["user"]["agent"] !== $_SERVER["HTTP_USER_AGENT"] || $_SESSION["user"]["ip"] !== $_SERVER["REMOTE_ADDR"]) {
        session_destroy();
        header("Location: /");
    }
}

try {
    if (!defined("STARTED")) {
        require_once("../core/initializers/init_database.php");
        define("STARTED", true);
    }
    $router = new Router();
    $router->register(new MainController());
    $router->register(new RegisterController());
    $router->register(new LoginController());
    $router->register(new DisconnectController());
    $router->register(new ProfileController());
    $router->register(new SettingsController());
    $router->init();
} catch (Exception $e) {
    echo $e->getMessage();
}
