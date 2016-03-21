<?php
include "./rb.php";

class Search
{
    public function Search()
    {
        //$dir = 'E:\\xampp\\htdocs\\dashboard\\IOMusicProject\\media\\uploadform\\';
        R::setup('mysql:host=localhost; dbname=musicdocs', 'root', '1234');

        R::dispense('testmusic');
        $word = '%' . $_GET['name'] . '%';
        $search = R::findAll('testmusic', ' filename LIKE ? ', [$word]);
        $colMas = 0;
        if ($_GET['name'] == '*') {
            $_GET['name'] = "";
            $word = '%' . $_GET['name'] . '%';
            $search = R::findAll('testmusic', ' filename LIKE ? ', [$word]);
            $this->ShowSongs($search, $colMas);
        } elseif ($_GET['name'] == '') {
            echo "Введите название песни";
        } elseif (empty($_GET['name'])) {
            echo "Такой песни не найдено";
            //print_r($json);
        } else {
            $this->ShowSongs($search, $colMas);
        }
    }

    public function ShowSongs($search, $colMas)
    {
        foreach ($search as $value) {
            $colMas++;

            $onPath = "../../media/uploadform/";
            $pathFile = $onPath . $value['filename'];

            $arr = array(
                'id'=>$value['id'],
                'name' => $value['orgname'],
                'source' => $pathFile,
                'description' => $value['description'],
                'author' => $value['author'],
                'likes' => $value['likes'],
                'fullname' => $value['filename']);
            //$arr = str_replace("_"," ",$arr);
            $jsonMas[$colMas] = $arr;
        }

        @$json = json_encode($jsonMas, JSON_FORCE_OBJECT);
        echo $json;
    }
}

$search = new Search();
?>

