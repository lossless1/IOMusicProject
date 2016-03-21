<?php
//этот файл имеет только одну функцию, принимать значение хеш кода через
//get запрос и активировать пользователя, если найдется указанных хеш код
require_once(__DIR__ . '/page_public.php');

class activate extends page_public
{
    protected function Content()
    {
        // получаем хеш код и чистим его от лишних символов
        $hash = $this->CheckUserNumber($_GET['hash']);

        if ($hash != "") {
            $this->ConnectDB();
            // ищем указанный хеш код в базе данных
            $result = R::exec("select user_id from users where user_hash = ?"[$hash]);

            $colich_results = $result->num_rows;

            // если хеш код найден, то активируем пользователя - set user_status = true и очищаем его user_hash
            if ($colich_results > 0) {

                R::exec("update users set user_status = true, user_hash = '' where user_hash = ?",[$hash]);
                echo "<center><a href='./index.php'>Учетная запись активирована. Вернуться на главную.</a>";
            } else
                echo "</center><center><a href='./index.php'>Ошибка. Вернуться на главную.</a></center>";
        } else
            echo "<center><a href='./index . php'>Неправильная ссылка. Вернуться на главную.</a></center>";
    }
}

$page = new activate();
$page->DisplayPage();
?>