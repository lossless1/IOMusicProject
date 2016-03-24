<?php
include "./rb.php";
require_once(__DIR__ . '/page_public.php');

class Author extends page_public
{
    public function Content()
    {
        R::setup('mysql:host=localhost; dbname=musicdocs', 'root', '1234');
        $author = $_GET['author'];

        $array = array("_(zaycev.net)", ".mp3", ".mp4", ".mpeg", "_");
        $likesDb = R::getAll('SELECT * FROM testmusic WHERE author = ?', [$author]);

        $i = null;

        ?>
        <head>
            <script src="../scripts/sendFile.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

            <script src="../scripts/sendMusic.js"></script>
            <script>
                $(document).ready(function () {

                    var author = '<?php echo $author;?>';

                    $("#subscribe").click(function (){
                        $.get('./user/subscription.php',
                            {
                                author :  author
                            },
                            function (data){
                                $("#subscribe").text(data);
                            });
                    });

                    <?php
                    for($i = 0;$i < count($likesDb);$i++) {

                    ?>
                    var nameObject, fullname, urlname, audioObject, likesDb, tagSong;
                    tagSong = $("#music");
                    filename = "<?php echo $likesDb[$i]['filename'];?>";
                    fullname = "<?php echo str_replace($array, " ", $likesDb[$i]['filename']); ?>";
                    urlname = "../../media/uploadform/" + filename;


                    audioObject = BuildAudioObject(urlname);
                    nameObject = NameObject(fullname);
                    tagSong.append(nameObject);
                    tagSong.append(audioObject);

                    tagSong.append($("<br>"));
                <?php
                }?>
                });
                function NameObject(fullname) {
                    nameObject = $("<div>");
                    nameObject.html(fullname);
                    return nameObject;
                }

            </script>

        </head>
        <body>
        <center>
            <div id="music">
                Страница с автором!<br>
                <font size="10"><?php echo $author;?></font><br>
                <button id="subscribe">Подписаться на этого автора.</button>
                <br><br><br>
            </div>
        </center>
        </body>
        <?php
    }
}

$author = new Author();
$author->DisplayPage();
?>

