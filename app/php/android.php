<?php

class android
{
    public function android()
    {
        if (empty($_GET)) {


            echo "_GET";
            var_dump($_GET);
            echo "REMOTE_ADDR <br>";
            var_dump($_SERVER['REMOTE_ADDR']);
            echo "gethostbyname gethostbyname <br>";
            $ipAddress = gethostbyname($_SERVER['SERVER_NAME']);
            var_dump($ipAddress);
            echo "SERVER_NAME <br>";
            var_dump($_SERVER['SERVER_NAME']);



            header('Content-type: text/html; charset=utf-8');
            header('Content-Encoding: gzip');
            echo gzinflate(substr(file_get_contents("http://www.nozu.ru"), 10));
        }
    }
}
$android = new android();
?>