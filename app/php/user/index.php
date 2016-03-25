<?php
require_once('../page_user.php');

class index extends page_user
{
    public function Content()
    {
        ?>
        <center>
            Личный кабинет. <br>

            <a href='./subscription.php'>Подписки на песни</a>
        </center>
        <?php
    }
}

$page = new index();
$page->DisplayPage();
?>