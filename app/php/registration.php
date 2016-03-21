<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/IOMusicProject/app/php/page_public.php');

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
                if ($this->FindLogin($user_login) == 0 ) {
                    // если указанного при регистрации email не нашлось в бд, продолжаем работу (email тоже должен быть уникальным)
                    if ($this->FindEmail($user_email) == 0 ) {
                        // теперь нам нужно отправить ссылку на указанную почту, для активации пользователя
                        //$from = 'site1@mail.ru';
                        $hash_code = rand(100000, 999999);
                        //$subject = "Подтверждение регистрации";
                        // отправляем письмо
                        R::exec("insert into users values (
                                              0,
                                              '$user_login',
                                              '$user_passwd',
                                              '$user_email',
                                              '$user_name',
                                              '$user_city',
                                              '$user_phone',
                                              '$hash_code',
                                              true)
                                              ");
                        echo "Вы зарегестрированы!";
                        //echo "</center><center><a href='./index.php'>На указанный почтовый ящик отправлено письмо с ссылкой для активации вашего личного кабинета.</a></center>";
                    } else
                        echo '<center><a href="./registration_form.php">Такой email уже есть в системе.</a></center>';
                } else
                    echo '<center><a href="./registration_form.php">Такой login уже есть в системе.</a></center>';
            } else
                echo '<center><a href="./registration_form.php">Пароли не совпадают.</a></center>';
        } else
            echo '<center><a href="./registration_form.php">Вы заполнили не все поля формы регистрации.</a></center>';
    }
}


$page = new registration();
$page->DisplayPage();
?>