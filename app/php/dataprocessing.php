<?php
require_once(__DIR__ . '/rb.php');

//класс для обработки данных, этот класс является родителем всех остальных

class dataprocessing
{

    //конструктор класса dataprocessing
    public function __construct()
    {
        session_start();
        @ $sessionGoogle = $_GET['session'];

        if(empty($_SESSION['username'])){

            @$_SESSION['username'] = $_POST['user_login'];
            @$_SESSION['username'] = $_GET['session'];
        }



    }

    //Подключение к базе данных
    public function ConnectDB()
    {

        R::setup('mysql:host=localhost; dbname=musicdocs', 'root', '1234');
        //if (!$result)
            //throw new Exception('Не удалось подключиться к базе данных.');
        //else
            //return $result;

    }

    public function CheckUserData($var)
    {
        $res = htmlspecialchars($var, ENT_QUOTES);

        return addslashes($res);

        //описание работы htmlspecialchars и addslashes вы можете посмотреть в любом справочнике php
    }

    public function CheckUserNumber($number)
    {
        // составляем шаблон
        $patt = '[[:alpha:]]|[[:punct:]]|[[:cntrl:]]|[[:space:]]';
        // или вот так $patt = '[^0-9]';
        //меняем на '', т.е. на пустое место
        $replace = '';
        return preg_replace($patt, $replace, $number);
    }

    //Поиск логина в базе данных
    public function FindLogin($login)
    {
        //соединяемся с бд


        //осуществляем поиск $login в базе данных

        $result = R::exec("select id from users where user_login = ?",[$login]);
        var_dump($result);
        //получаем количество результатов поиска
        //$colich_results = $result->num_rows;
        //возвращаем количество результатов поиска
        return $result;
    }

    //Поиск email'а в базе данных
    public function FindEmail($email)
    {
        //соединяемся с бд
        //$this->ConnectDB();
        //осуществляем поиск $email в базе данных
        $result = R::exec("select id from users where user_email = ?",[$email]);
        //получаем количество результатов поиска
        //$colich_results = $result->num_rows;
        //возвращаем количество результатов поиска
        return $result;
    }
    public function CheckTable($table){
        $uer = R::exec("SHOW TABLES LIKE ?", [$table]);
        if (!$uer) {
            $user = R::exec('create table users
            (
            id integer not null auto_increment primary key,
            user_login varchar(20),
            user_passwd varchar(40),
            user_email varchar(35),
            user_name varchar(60),
            user_city varchar(30),
            user_phone varchar(11)
            )');
            R::store($user);
        }
    }
}

?>