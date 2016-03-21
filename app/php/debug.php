<?php
include "./rb.php";
echo "<pre>";
echo $_SERVER['HTTP_HOST'] . "<br>";
echo $_SERVER['GATEWAY_INTERFACE'] . "<br>";
echo $_SERVER['SERVER_ADDR'] . "<br>";
echo $_SERVER['SERVER_NAME'] . "<br>";
echo $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo $_SERVER['SERVER_PROTOCOL'] . "<br>";
echo $_SERVER['REQUEST_METHOD'] . "<br>";
echo $_SERVER['REQUEST_TIME'] . "<br>";
echo $_SERVER['REQUEST_TIME_FLOAT'] . "<br>";
echo $_SERVER['QUERY_STRING'] . "<br>";
echo $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo $_SERVER['HTTP_ACCEPT'] . "<br>";
//echo $_SERVER['HTTP_ACCEPT_CHARSET'] . "<br>";
echo $_SERVER['HTTP_ACCEPT_ENCODING'] . "<br>";
echo "<br>";


echo __FILE__ . "<br>";
echo __LINE__ . "<br>";
echo __DIR__ . "<br>";
echo __FUNCTION__ . "<br>";
echo __CLASS__ . "<br>";
echo __TRAIT__ . "<br>";
echo __METHOD__ . "<br>";
echo __NAMESPACE__ . "<br>";

echo $_SERVER['REMOTE_ADDR'];




?>
