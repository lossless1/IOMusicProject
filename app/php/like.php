<?php


include_once("./rb.php");

require_once(__DIR__ . '/page_public.php');

class Likes extends page_public
{
    public function Likes()
    {
        if (!isset($_GET) || !isset($_GET["song_id"])) {
            die('stop');
        }
        $this->ConnectDB();

        $user = R::findOne('users', 'user_login = ?', [$_SESSION['username']]);

        $iduser = $user['id'];
        $idsong = $_GET['song_id'];

        //var_dump($_SESSION['username']);
        //$likes = $_GET['likes'];

        //var_dump($_SESSION['username']);

        $likes = R::findOne("likes", "id_user = ?", [$iduser]);

        //var_dump($trash);
        if (empty($likes['id_user'])) {
            $likes = R::dispense('likes');
            echo true;
            $likes["idUser"] = $iduser;

            $likes["idSong"] = $idsong;
            //R::exec("UPDATE likes SET idUser = ?, idSong = ?, likes = ?",[$idUser,$idSong,$likes]);
            R::store($likes);
        } else {

            R::trash($likes);

            //$dbLikes["idSong"] = $songid;
            //R::trash($dbLikes);
            //R::trash($dbLikes["idSong"]);
            //R::exec("UPDATE likes SET idUser = ?, idSong = ?, likes = ?",[$idUser,$idSong,$likes]);
            //R::store($dbLikes);

        }
    }
}
$start = new Likes();

?>