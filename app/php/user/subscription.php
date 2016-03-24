<?php
require_once('../page_user.php');
require_once('../rb.php');
session_start();

class Subscriptions extends page_user
{
    public function Subscriptions()
    {

        $this->AddSubscription();
        //$this->ShowSubscription();

    }

    public function ShowSubscription()
    {
        $this->ConnectDB();

        $this->DisplayPage();

        $useridfromusers = R::findOne('users','user_login = ?',[$_SESSION['username']]);

        $userid = R::getAll('SELECT * FROM subscriptions WHERE userid = ?',[$useridfromusers['id']]);
        echo "<pre>";
        var_dump($userid);

        ?>
        <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

            <script>
                $(document).ready(function(){
                    authorObject = BuildAuthorObject(data);
                    tagSong.append(authorObject);

                });

                function BuildAuthorObject(data){
                    var author;
                    author = $("<div>");
                    author.html("<b>Author:</b>");

                    authorObject = $("<a>");
                    authorObject.attr("href","../page_author.php?id="+data.id+"&author="+data.author);/////
                    authorObject.html(data.author);
                    author.append(authorObject);
                    return author;
                }
            </script>
        </head>
        <body>
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

        $checksub = R::findOne('subscriptions', 'userid = ?', [$userid['id']]);

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
}

$subscr = new Subscriptions();


?>

