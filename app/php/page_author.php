<?php
include "./rb.php";
include_once($_SERVER['DOCUMENT_ROOT'] . '/IOMusicProject/app/php/page_public.php');

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
                    <?php
                    for($i = 0;$i < count($likesDb);$i++) {

                    ?>
                    var nameObject, fullname, urlname, audioObject, buttonObject, likesDb, tagSong;
                    tagSong = $("#music");
                    filename = "<?php echo $likesDb[$i]['filename'];?>";
                    fullname = "<?php echo str_replace($array, " ", $likesDb[$i]['filename']); ?>";
                    urlname = "../../media/uploadform/" + filename;

                    likesDb = "<?php echo $likesDb[$i]['likes']; ?>";

                    audioObject = BuildAudioObject(urlname);
                    nameObject = NameObject(fullname);
                    //buttonObject = ButtonObject(likesDb);

                    tagSong.append(nameObject);
                    tagSong.append(audioObject);
                    //tagSong.append(buttonObject);
                    tagSong.append($("<br>"));
                    //$("#button").click(function () {
                    //    $.get("like.php",
                    //        {
                    //            song_id: "<?php
                    //                if (!empty($_SESSION['username'])) {
                    //                    print_r($likesDb[$i]['id']);
                    //                }?>",
                    //        },
                    //        function (data) {
                    //            $("#button").html(data);
                    //        });
                    //});
                });


                <?php
                }?>

                function NameObject(fullname) {
                    nameObject = $("<div>");
                    nameObject.html(fullname);
                    return nameObject;
                }
                //function ButtonObject(likesDb) {
                //    buttonObject = $("<button>");
                //    buttonObject.attr("id", "button");
                //    buttonObject.html(likesDb);
                //    return buttonObject;
                //}

            </script>

        </head>
        <body>
        <center>
            <div id="music">
                Stranica s autorom!<br><br>
            </div>
        </center>
        </body>
        <?php
    }

    public function Author()
    {

    }
}

$author = new Author();
$author->DisplayPage();
?>

