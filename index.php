<?php
//подключаем класс page_public

require_once(__DIR__ . '/app/php/page_public.php');

//require_once($_SERVER['DOCUMENT_ROOT'] . '/IOMusicProject/app/php/google_auth.php');
//создаем класс для главной страницы и наследуем все свойства от page_public
class index extends page_public
{

    public function Index()
    {
        ?>
        <html>
        <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">


            <script>


                $(document).ready(function () {
                    $.get('./app/php/facebook_login.php', function (data) {
                        $("#loginFb").html(data);
                    });
                    $.get('./app/php/google_auth.php', function (data) {
                        $("#googleLg").html(data);
                    });
                });


            </script>
        </head>
    <body>

        <table align="center">
            <tbody>
            <tr>
                <center>Добро пожаловать!</center>
                <br>
                <?php
                if (empty($_SESSION['username'])) {
                    echo "
                <td ><a href = './index.php'> Вход</a ></td >";
                } ?>
                <td><a href="./app/php/page_registration.php">Форма регистрации</a></td>
                <td><a href="./app/php/page_search_public.php">Поиск</a></td>
                <td><a href="./app/php/debug.php">Debug Site</a></td>
                <td><a href="./app/php/user/index.php">Личный кабинет</a></td>
                <td><a href="./app/php/page_upload_user.php">Загрузка песни</a></td>
            </tr>
            </tbody>
        </table><br>
        <?php
        if (empty($_SESSION['username'])) {
            ?>

            <form action="./app/php/user/index.php" method="post">
                <table border="0" width="50%" align="center">
                    <tbody>
                    <tr>
                        <td>Логин</td>
                        <td><input  name="user_login" size="50%" type="text"/></td>
                    </tr>
                    <tr>
                        <td>Пароль</td>
                        <td><input name="user_passwd" size="50%" type="password"/></td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" colspan="2">
                            <input type="submit" value="Войти в личный кабинет"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <p id="googleLg"></p>
                            <p id="loginFb"></p>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </form>


            <div id="name"></div>

            </body>
            </html>
            <?php
        } else {
            echo '<center>Вы уже вошли!</center>';
        }
        ?>


        <?php
    }
}

$page = new index();

?>