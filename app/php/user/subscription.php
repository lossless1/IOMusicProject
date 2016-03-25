<?php
require_once('../page_user.php');
require_once('../rb.php');
session_start();

class Subscriptions extends page_user
{
    public function Subscriptions()
    {
        if (isset($_GET['author'])) {
            $this->AddSubscription();
        } else {
            $this->ShowSubscription();
        }

    }

    public function ShowSubscription()
    {
        $this->ConnectDB();

        $this->DisplayPage();

        $useridfromusers = R::findOne('users', 'user_login = ?', [$_SESSION['username']]);

        $userid = R::getAll('SELECT * FROM subscriptions WHERE userid = ?', [$useridfromusers['id']]);


        ?>
        <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <script src="../../scripts/sendMusic.js"></script>
            <script>
                $(document).ready(function () {
                    <?php for($i = 0;$i < count($userid);$i++)
                    {
                    ?>
                    $author = '<?php echo $userid[$i]['author']; ?>';

                    authorObject = BuildAuthorArray($author);
                    $("#authors").append(authorObject);

                    <?php
                    }
                    ?>
                });


            </script>
        </head>
        <body>
        <br>
        <div id="authors">

        </div>

        </body>


        <?php


    }

    public function AddSubscription()
    {
        $this->ConnectDB();
        $subs = R::dispense('subscriptions');
        $userid = R::findOne('users', 'user_login = ?', [$_SESSION['username']]);

        $checksub = R::findOne('subscriptions', 'author = ? AND userid = ?', [$_GET['author'], $userid['id']]);

        //var_dump($checksub);

        if (!$checksub) {
            $subs['userid'] = $userid['id'];
            $subs['author'] = $_GET['author'];
            R::store($subs);
            echo 'Подписано';
        } else {

            R::trash($checksub);
            echo 'Отписано';
        }
    }

    public function BeanToArray($bean)
    {
        $data = array();
        foreach ($bean as $beanKey => $beanValue) {

            $data[$beanKey] = $beanValue;
        }
        return $data;
    }

    public function BeansToArray($beans)
    {
        $result = array();
        foreach ($beans as $beansKey => $beansValue) {
            $data = BeanToArray($beansValue);
            $result[] = $data;
        }

        return $result;
    }

}

$subscr = new Subscriptions();


?>

