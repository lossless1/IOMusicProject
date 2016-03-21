<?php
require_once(__DIR__ . '/page_public.php');

class SearchPage extends page_public
{
    protected function Content()
    {


        ?>
        <html>
        <head>
            <meta charset="utf-8"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <script src="../scripts/sendMusic.js"></script>
        </head>
        <body>
        <center>
            <form method="GET" enctype="multipart/form-data" id="textform">
                Введите название песни:<br>
                <input id="name" type=text value="" size="20"/>
                <button onclick="sendMusic(); return false;">Поиск<br></button>
            </form>


            <div id="player"></div>

            <div id="song"></div>

            <div id="dataSong"></div>

        </center>


        <!-- so.addParam('flashvars','file=2x2.sdp&provider=rtmp&streamer=rtmp://213.21.0.16/2x2'); -->
        </body><!-- http://www.youtube.com/watch?v=O6ExAru7s58 -->
        </html>
        <?php
    }
}

$search = new SearchPage();
$search->DisplayPage();
?>

