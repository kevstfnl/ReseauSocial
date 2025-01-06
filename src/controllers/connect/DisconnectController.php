<?php
class DisconnectController extends Controller
{

    public function __construct()
    {
        parent::__construct("/disconnect");
    }

    public function call($requestMethod)
    {
        if (!empty($_SESSION["user"])) {
            UserToken::delete($_SESSION["user"]["id"]);
        }
        session_destroy();
        header("Location: /");
    }
}