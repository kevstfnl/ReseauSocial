<?php
class ProfileController extends Controller {

    public function __construct()
    {
        parent::__construct("/profile");
    }

    public function call($requestMethod)
    {
        
        if ($requestMethod == "GET") {
            if (!empty($_GET["id"]) && !empty($_SESSION["user"]["id"])) {
                include_once("../views/profile/profile.php");
                return;
            }
        }
        header("Location: /");
    }
}
