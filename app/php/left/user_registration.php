<?php
include "../php/rb.php";
$login = CheckUserData($_GET["login"]);
$password = CheckUserData(md5($_GET["password"]));
$password2 = CheckUserData(md5($_GET["password2"]));
$email = CheckUserData($_GET["user_email"]);
$name = CheckUserData($_GET["user_name"]);
$userPhoneNumber = CheckUserData($GET["user_phone"]);
$userBirth = $GET["date"];
registerDB();

function registerDB()
{
    R::setup('mysql:host=localhost; dbname=musicdocs', 'root', '1234');
    $dbReg = R::dispense('logs');
    $dbReg['login'] = $GLOBALS["login"];
    $dbReg['password'] = $GLOBALS["password"];
    $dbReg['password2'] = $GLOBALS["password2"];
    $dbReg['email'] = $GLOBALS["email"];
    $dbReg['name'] = $GLOBALS["name"];
    $dbReg['userPhoneNumber'] = $GLOBALS["userPhoneNumber"];
    $dbReg['userBirth'] = $GLOBALS['userBirth'];

    R::store($dbReg);

    if($dbReg['login']&&$dbReg['password']){
        echo "Registration success!!!<br><a href='../../index.html'>Your private profile.</a>";
    }else{
        echo "Registrarion failed <br><a ref='../../index.html'>Index HTML.";
    }
}

function CheckUserData($var)
{
    $res = htmlspecialchars($var, ENT_QUOTES);
    return addslashes($res);
}

/*function CheckUserNumber($number)
{
    $patt = '[[:alpha:]]|[[:punct:]]|[[:cntrl:]]|[[:space:]]';
    $replace = '';
    return preg_replace($patt, $replace, $number);
}*/

?>
