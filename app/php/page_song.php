<?php
include "./rb.php";
require_once(__DIR__ . '/page_public.php');

class Song extends page_public
{
    public function Content()
    {
        R::setup('mysql:host=localhost; dbname=musicdocs', 'root', '1234');
        $fullname = $_GET['fullname'];
        $array = array("_(zaycev.net)", ".mp3", ".mp4", ".mpeg","_");
        $likesDb = R::getRow('SELECT * FROM testmusic WHERE filename = ?', [$fullname]);
        ?>
        <head>
            <script src="../scripts/sendFile.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

            <script src="../scripts/sendMusic.js"></script>
            <script>
                $(document).ready(function () {
                    var nameObject, fullname, urlname, audioObject, buttonObject, likesDb, tagSong;
                    tagSong = $("#music");
                    filename = "<?php echo $_GET['fullname'];?>";
                    fullname = "<?php echo str_replace($array," ",$_GET['fullname']); ?>";
                    urlname = "../../media/uploadform/" + filename;

                    //makeString = 'akosh and sakosh - sog indim';
                    //makeString1 = makeString.split("-");
                    //console.log(makeString1);
                    //makeString2 = makeString1[0].split(" ");
                    //console.log(makeString2[0]);
                    //console.log(makeString2[0].length);
                    //
                    //string = makeString2[0];
                    //console.log(makeString2[0]);
                    //replacestring = string.replace(string[0],string[0].toUpperCase());
                    //console.log(replacestring);


                    likesDb = "<?php echo $likesDb['likes']; ?>";

                    audioObject = BuildAudioObject(urlname);
                    nameObject = NameObject(fullname);
                    buttonObject = ButtonObject(likesDb);

                    tagSong.append(nameObject);
                    tagSong.append(audioObject);
                    <?php if(!empty($_SESSION['username'])){?>
                    tagSong.append(buttonObject);
                    <?php
                    }
                    ?>
                    tagSong.append($("<br>"));


                    $("#button").click(function () {
                        $.get("like.php",
                            {
                                song_id: "<?php
                                    if (!empty($_SESSION['username'])) {
                                        print_r($likesDb['id']);
                                    }?>",
                            },
                            function (data) {
                                $("#button").html(data);
                            })
                    });
                });

                function NameObject(fullname) {
                    nameObject = $("<div>");
                    nameObject.html(fullname);
                    return nameObject;
                }
                function ButtonObject(likesDb) {
                    buttonObject = $("<button>");
                    buttonObject.attr("id", "button");
                    buttonObject.html(likesDb);
                    return buttonObject;
                }

            </script>

        </head>
        <body>
        <div id="music">
            Stranica s loisom!<br><br>
        </div>
        </body>
        <?php
    }
}

$song = new Song();
$song->DisplayPage();
//$song->Likes();