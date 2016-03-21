<?php
require_once('../page_public.php');

class exitPage extends page_user
{
    public function Content()
    {
        unset($_SESSION['username']);
        echo '<center><a href="../../../index.php"-->Вы вышли из личного кабинета!</a></center>';
    }
}

$page = new exitPage();
$page->Content();

?>