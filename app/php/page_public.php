<?php
// подключаем файл с классом dataprocessing
require_once(__DIR__ . '/rb.php');
require_once(__DIR__ . '/dataprocessing.php');

// создаем класс для отображения общедоступных страниц скрипта page_user
// и наследуем его от dataprocessing
class page_public extends dataprocessing
{
    // метод для вывода содержания страницы
    public function DisplayPage()
    {
        $this->MetaTag();
        $this->Menu();
        $this->Content();


    }

    // мета теги
    public function MetaTag()
    {
        $session = $_SESSION['username'];
        if (empty($_SESSION['username'])) {

            echo "<p align=center>Добро пожаловать!</p>";
        } else {
            echo "<p align=center>Добро пожаловать  $session !</p>";

        }
    }
    // основное содержание страницы
    public function Menu()
    {
        ?>
        <table align="center">
            <tbody>
            <tr>
                <?php
                if (empty($_SESSION['username'])) {
                    echo "
                <td ><a href = '../../index.php'> Вход</a ></td >";
                } ?>
                <td><a href="./page_registration.php">Форма регистрации</a></td>
                <td><a href="./page_search_public.php">Поиск</a></td>
                <td><a href="./debug.php">Debug Site</a></td>
                <td><a href="./user/index.php">Личный кабинет</a></td>
                <td><a href="./page_upload_user.php">Загрузка песни</a></td>
            </tr>
            </tbody>
        </table><br>
        <?php
    }

    protected function Content()
    {

    }

    // меню

}

?>