<?php
class LoginController extends Controller
{

    public function __construct()
    {
        parent::__construct("/login");
    }

    public function call($requestMethod)
    {
        if ($requestMethod == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $keep = $_POST["keep"];

            $error = &$_SESSION["error"]["login"];
            $error = null;
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))  $error["email"] = true;
            if (empty($password)) $error["password"] = true;
            
            if (!empty($error)) {
                include_once("../views/connect/login.php");
                return;
            }
            $user = User::getByEmail($email);
            if (password_verify($password, $user->getPassword())) {
                $_SESSION["user"]["id"] = $user->getId();
                $_SESSION["user"]["agent"] = $_SERVER["HTTP_USER_AGENT"];
                $_SESSION["user"]["ip"] = $_SERVER["REMOTE_ADDR"];
                if ($keep == 1) {
                    $token = new UserToken($user->getId());
                    UserToken::create($token);
                }
                header("Location: /");
                return;
            } else {
                $error["password"] = true;
                include_once("../views/connect/login.php");
            }
            return;
        }
        include_once("../views/connect/login.php");
    }
}
