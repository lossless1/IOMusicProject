<?php
include "./rb.php";

class Upload
{
    public $array, $uploadDir, $tmpName, $pathFile, $orgname, $filename, $dateTime, $comment, $author, $uniqid, $songname;
    public function Upload()
    {
        $array = array("_(zaycev.net)", ".mp3", ".mp4", ".mpeg");
        $uploadDir = 'E:\\xampp\\htdocs\\dashboard\\IOMusicProject\\media\\uploadform\\';

        $tmpName = $_FILES['userfile']['tmp_name'];
        $pathFile = $uploadDir . $_FILES['userfile']['name'];
        $orgname = str_replace($array, "", basename($_FILES['userfile']['name']));
        $filename = $_FILES['userfile']['name'];
        $dateTime = Date('Y-m-d H:i:s');
        $comment = $_POST["comment"];

        $author = $this->Author($orgname);
        $songname = $this->SongName($orgname);


        $md5 = md5($orgname);

        if (empty($_FILES)) {
            echo "Передайте файлы!!.<br>";
        } else {
            $this->UploadMusic($filename, $comment, $author, $dateTime, $tmpName, $pathFile, $orgname, $md5, $songname);

        }
    }
    public function CreateDatabase($filename, $description, $author, $date, $orgname, $md5 ,$songname)
    {

        $musics = R::dispense('testmusic');
        $musics["filename"] = $filename;
        $musics["description"] = $description;
        $musics["author"] = $author;
        $musics["songname"] = $songname;
        $musics["date"] = $date;
        $musics["orgname"] = $orgname;
        $musics["md5"] = $md5;
        $musics["likes"] = 0;

        R::store($musics);
    }
    public function UploadMusic($filename, $comment, $author, $dateTime, $tmpName, $pathFile, $orgname, $md5, $songname)
    {
        R::setup('mysql:host=localhost; dbname=musicdocs', 'root', '1234');
        //$i=0;
        echo '<pre>';
        $md5Music = R::getRow('SELECT * FROM testmusic WHERE md5 LIKE ? LIMIT 1', [$md5]);
        //$md5Music = R::findOne('testmusic', 'md5 = ?', [$md5]);
        //print_r($md5Music);

        if ($md5 == $md5Music['md5']) {
            echo "Такая песня уже есть! Загрузите что-то другое!";
            exit;
        } else {
            $this->CreateDatabase($filename, $comment, $author, $dateTime, $orgname, $md5, $songname);
            if (move_uploaded_file($tmpName, $pathFile)) {
                echo "UPLOAD_SUCCESS\n";
            } else {
                echo "UPLOAD_FAIL\n";
            }
            echo 'Here is some more debugging info:<br><br>';
            //print_r($GLOBALS["orgname"]);
            echo " Успешно загружен " . $author."-".$songname;
            echo "<br>";
            echo '<pre>';
        }

    }
    public function Author($orgname)
    {
        $arrayAuthor = explode("-",$orgname);
        $arrayAuthor = str_replace("_"," ",$arrayAuthor);
        $stringAuthor = ucwords($arrayAuthor[0]);
        return $stringAuthor;
    }
    public function SongName($orgname){
        $arraySongName = explode("-",$orgname);
        $arraySongName = str_replace("_"," ",$arraySongName);
        return $arraySongName[1];
    }
}

$upload = new Upload();

?>
