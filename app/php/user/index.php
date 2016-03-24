<?php
require_once('../page_user.php');

class index extends page_user
{
    public function Content()
    {
        echo "<center>Личный кабинет.</center>";
        echo "<a href='./subscription.php'>Подписки на песни</a>";
    }
}

$page = new index();
$page->DisplayPage();
?>