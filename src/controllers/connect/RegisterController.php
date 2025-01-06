<?php
class RegisterController extends Controller
{

    public function __construct()
    {
        parent::__construct("/register");
    }

    public function call($requestMethod)
    {
        if ($requestMethod == "POST" && !empty($_POST)) {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confpassword = $_POST["confpassword"];

            $error = &$_SESSION["error"]["register"];
            $error = null;

            if (empty($firstName)) $error["firstName"] = true;
            if (empty($lastName)) $error["lastName"] = true;
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || User::getByEmail($email)) $error["email"] = true;
            if (empty($password)) $error["password"] = true;
            if (empty($confpassword) || $password != $confpassword) $error["confpassword"] = true;

            if (!empty($error)) {
                include_once("../views/connect/register.php");
                return;
            }
            $user = new User($firstName, $lastName, $email, $password);
            User::create($user);
        }
        include_once("../views/connect/register.php");
    }
}
