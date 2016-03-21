<?php
require_once(__DIR__ . '/page_public.php');

class Upload extends page_public
{
    protected function Content()
    {
        ?>
        <html>
        <head>
            <meta charset="utf-8"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <script src="../scripts/sendFile.js"></script>


        </head>
        <body>

            <form method="POST" enctype="multipart/form-data" id="fileform">
                Отправить этот файл: <input type="file" id="fileinput"/>
                <input type="button" value="Загрузка" onclick="sendFile()"/><br><br>
                Комментарии к песне: <input type=text id="comment" size=50/><br><br>

                <p id="comment1"></p>
            </form><br>

            <div id="data"><br>
            </div>
            <progress id="progress"></progress>


        </body>
        </html>

        <?php
    }

}

$search = new Upload();
$search->DisplayPage();
?>

