<?php
require_once(__DIR__ . '/page_public.php');

class registration extends page_public
{
    protected function Content()
    {
        // обрабатываем полученные данные от формы регистрации методом CheckUserData
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
            if ($user_passwd == $user_passwd2) {
                if ($this->FindLogin($user_login) == 0) {
                    if ($this->FindEmail($user_email) == 0) {
                        $from = 'site1@mail.ru';
                        $hash_code = rand(100000, 999999);
                        $subject = "Подтверждение регистрации";
                        $message = "Вы подали заявку на регистрацию в сервисе БИРЖА ССЫЛОК. " .
                            "Подтвердите свою заявку по предложенной ссылке: " .
                            "http://site.ru/activate.php?hash=" . $hash_code;
                        if (!mail($user_email, $subject, $message, 'From: ' . $from))
                            echo "<center><a href='./page_registrationpage_registration.php'>Вы не правильно указали почту.</a>";
                        else {
                            $conn = $this->ConnectDB();
                            $conn->query("insert into users values (
                                              0,
                                              '$user_login',
                                              '$user_passwd',
                                              '$user_email',
                                              '$user_name',
                                              '$user_city',
                                              '$user_phone',
                                              '$hash_code',
                                              false)
                                              ");
                            echo "Вы зарегестрированы!";
                            echo "</center><center><a href='./index.php'>На указанный почтовый ящик отправлено письмо с ссылкой для активации вашего личного кабинета.</a></center>";
                        }
                    } else
                        echo '<center><a href="./page_registration.php">Такой email уже есть в системе.</a></center>';
                } else
                    echo '<center><a href="./page_registration.php">Такой логин уже есть в системе.</a></center>';
            } else
                echo '<center><a href="./page_registration.php">Пароли не совпадают.</a></center>';
        } else
            echo '<center><a href="./page_registration.php">Вы заполнили не все поля формы регистрации.</a></center>';
    }
}

$page = new registration();
$page->DisplayPage();
?>