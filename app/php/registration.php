<?php
require_once(__DIR__ . '/rb.php');
require_once(__DIR__ . '/page_public.php');

class registration extends page_public
{
    protected function Content()
    {
        // обрабатываем полученные данные от формы регистрации методом CheckUserData
        $this->ConnectDB();
        $user_login = $this->CheckUserData($_POST['user_login']);
        $user_passwd = $this->CheckUserData($_POST['user_passwd']);
        $user_passwd2 = $this->CheckUserData($_POST['user_passwd2']);
        $user_email = $this->CheckUserData($_POST['user_email']);
        $user_name = $this->CheckUserData($_POST['user_name']);
        $user_city = $this->CheckUserData($_POST['user_city']);
        $user_phone = $this->CheckUserData($_POST['user_phone']);

        $table = 'users';
        $this->CheckTable($table);


        // если все поля заполнены то продолжаем работу с данными
        if (
            $user_login != "" &&
            $user_passwd != "" &&
            $user_passwd2 != "" &&
            $user_email != "" &&
            $user_name != "" &&
            $user_city != "" &&
            $user_phone != ""
        ) {
            // если пароль и проверочный пароли равны, то продолжаем работу
            if ($user_passwd == $user_passwd2) {
                // если указанного при регистрации логина не нашлось в бд, продолжаем работу (логины должны быть уникальными)
                if ($this->FindLogin($user_login) == 0) {
                    // если указанного при регистрации email не нашлось в бд, продолжаем работу (email тоже должен быть уникальным)
                    if ($this->FindEmail($user_email) == 0) {
                        // теперь нам нужно отправить ссылку на указанную почту, для активации пользователя
                        //$from = 'site1@mail.ru';

                        //$subject = "Подтверждение регистрации";

                        $users = R::dispense('users');
                        $users["user_login"] = $user_login;
                        $users["user_passwd"] = $user_passwd;
                        $users["user_email"] = $user_email;
                        $users["user_name"] = $user_name;
                        $users["user_city"] = $user_city;
                        $users["user_phone"] = $user_phone;

                        R::store($users);

                        echo "Вы зарегестрированы!";

                        //header("Location: http://localhost:8080/IOMusicProject/index.php");
                        //echo "</center><center><a href='./index.php'>На указанный почтовый ящик отправлено письмо с ссылкой для активации вашего личного кабинета.</a></center>";
                    } else
                        echo '<center><a href="./page_registration.php">Такой email уже есть в системе.</a></center>';
                } else
                    echo '<center><a href="./page_registration.php">Такой login уже есть в системе.</a></center>';
            } else
                echo '<center><a href="./page_registration.php">Пароли не совпадают.</a></center>';
        } else
            echo '<center><a href="./page_registration.php">Вы заполнили не все поля формы регистрации.</a></center>';
    }
}


$page = new registration();
$page->DisplayPage();
?>