<?php
class MainController extends Controller
{

    public function __construct()
    {
        parent::__construct("/");
    }

    public function call($requestMethod)
    {

        if (empty($_SESSION["user"]) && !UserToken::validate()) {
            $_SESSION["error"] = null;
            include_once("../views/connect/connect.php");
        } else {
            include_once("../views/home.php");
        }
    }
}
