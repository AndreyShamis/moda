<?

require_once "header.php";
require_once "db.php";
require_once "function.php";

require_once "class_auth.php";
    $user = new auth();
    $user->login();
?>