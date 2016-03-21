<?php
include "./rb.php";
$login = $_GET["login"];
$password = md5($_GET["password"]);
$err = "Wrong";

LoginDB();

function LoginDB()
{
    R::setup('mysql:host=localhost; dbname=musicdocs', 'root', '1234');
    $searchLog = R::find('logs', 'login LIKE ?', [$GLOBALS['login']]);
    $searchPass = R::find('logs', 'password LIKE ?', [$GLOBALS['password']]);
    if ($searchLog && $searchPass) {
        session_start();
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/IOMusicProject/search.html");
    } else {
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/IOMusicProject/index.html");
    }
}


?>
