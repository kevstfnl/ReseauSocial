<?php
class SettingsController extends Controller
{

    public function __construct()
    {
        parent::__construct("/settings");
    }

    public function call($requestMethod)
    {
        if (!empty($_SESSION["user"]["id"])) {
            if ($requestMethod == "GET") {
                include_once("../views/profile/settings.php");
                return;
            }
            if ($requestMethod == "POST" && !empty($_POST)) {
                $error = &$_SESSION["error"]["settings"];
                $error = null;
                if (strlen($_POST["description"]) > 255) {
                    $error["description"] = true;
                }
                if (isset($_FILES['avatar']) && !empty($_FILES['avatar'])) {
                    $path = "./uploads/" . $_SESSION["user"]["id"];

                    $uploadedFile = $_FILES['avatar']['tmp_name'];
                    if (is_uploaded_file($uploadedFile) && $this->isImageValid($uploadedFile)) {
                        if (!file_exists($path)) mkdir($path, 0777, true);
                        if ($this->convertToWebP($uploadedFile, $path . "/avatar.webp")) {
                            header("Location: /profile?id=" . $_SESSION["user"]["id"]);
                        } else {
                            $error["avatar"] = true;
                        }
                    }
                }
                if (!empty($error)) {

                    include_once("../views/profile/settings.php");
                    return;
                }
                var_dump($_SESSION["user"]["id"]);
                UserHandler::updateDescription($_SESSION["user"]["id"], $_POST["description"]);
                header("Location: /profile?id=" . $_SESSION["user"]["id"]);
                return;
            }
        }
        header("/");
    }

    private function isImageValid($filePath)
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $fileMimeType = mime_content_type($filePath);
        if (!in_array($fileMimeType, $allowedMimeTypes)) return false;

        $imageInfo = getimagesize($filePath);
        if ($imageInfo === false) return false;

        $maxWidth = 1000;
        $maxHeight = 1000;
        if ($imageInfo[0] > $maxWidth || $imageInfo[1] > $maxHeight) return false;

        $maxFileSize = 2 * 1024 * 1024;
        if (filesize($filePath) > $maxFileSize) return false;
        return true;
    }

    function convertToWebP($sourcePath, $destinationPath)
    {
        $mimeType = mime_content_type($sourcePath);

        switch ($mimeType) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($sourcePath);
                break;
            case 'image/webp':
                return copy($sourcePath, $destinationPath);
            default:
                return false;
        }

        return imagewebp($image, $destinationPath, 80);
    }
}
