<?php
require_once(__DIR__ . '../page_user.php');

class index extends page_user
{
    public function Content()
    {
        echo "<center>Личный кабинет.</center>";

    }
}

$page = new index();
$page->DisplayPage();
?>