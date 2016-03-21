<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/IOMusicProject/app/php/dataprocessing.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/IOMusicProject/app/php/rb.php');

class page_user extends dataprocessing
{
    public function DisplayPage()
    {
        $this->AuthorizationUser();
        $this->MetaTag();
        $this->Menu();
        $this->Content();
    }

    private function MetaTag()
    {
        ?>

        <?php
    }

    public function Content()
    {
    }

    private function Menu()
    {

        ?>

        <table width="100%">
            <tbody>
            <tr>
                <td><a href="../page_search_public.php">Вернуться на главную страницу</a></td>
                <td><p align="right"><a href="./exit.php">Выйти из личного кабинета</a></p></td>
            </tr>
            </tbody>
        </table>
        <?php
    }

//авторизация пользователя
    public function AuthorizationUser()
    {

        @ $username = $this->CheckUserData($_POST['user_login']);

        @ $passwd = $this->CheckUserData($_POST['user_passwd']);


        if ($username && $passwd) {
            try {
                $this->CheckLoginAndPasswd($username, $passwd);
                $_SESSION['username'] = $username;
            } catch (Exception $e) {

                $this->MetaTag();
                echo "<center><a href='../../../index.php'>" . $e->getMessage() . "</a>";
                exit;
            }
        } else
            $this->CheckUserLogin();
    }

    private function CheckLoginAndPasswd($username, $passwd)
    {
        $this->ConnectDB();

        $result = R::exec("select * from users where user_login = ? and user_passwd = ?",[$username,$passwd]);
        //$row = $result->fetch_object();
        if (!$result) {
            //throw new Exception('Не удается выполнить запрос к базе данных.');
            throw new Exception('Вы не правильно ввели данные для входа в систему.');
        }
//        if ($result->num_rows > 0)
//            if ($row->user_status != 1)
//                throw new Exception('Вы не активировали учетную запись.');
//            else
//                return true;}
        //else
        //    throw new Exception('Вы не правильно ввели данные для входа в систему.');


    }

    public function CheckUserLogin()
    {
        if (empty($_SESSION['username'])) {
            $this->MetaTag();
            echo "<center><a href='../../../index.php'>Логин или пароль введены неверно.</a></center>";
            exit;
        }
    }
}

?>