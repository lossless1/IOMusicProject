<?php
include "./rb.php";
echo "<pre>";
echo __LINE__."    ".$_SERVER['HTTP_HOST'] . "<br> ";
echo __LINE__."    ".$_SERVER['GATEWAY_INTERFACE'] . "<br> " ;
echo __LINE__."    ".$_SERVER['SERVER_ADDR'] . "<br> " ;
echo __LINE__."    ".$_SERVER['SERVER_NAME'] . "<br> " ;
echo __LINE__."    ".$_SERVER['SERVER_SOFTWARE'] . "<br> " ;
echo __LINE__."    ".$_SERVER['SERVER_PROTOCOL'] . "<br> " ;
echo __LINE__."    ".$_SERVER['REQUEST_METHOD'] . "<br> " ;
echo __LINE__."    ".$_SERVER['REQUEST_TIME'] . "<br> " ;
echo __LINE__."    ".$_SERVER['REQUEST_TIME_FLOAT'] . "<br> " ;
echo __LINE__."    ".$_SERVER['QUERY_STRING'] . "<br> " ;
echo __LINE__."    ".$_SERVER['DOCUMENT_ROOT'] . "<br> " ;
echo __LINE__."    ".$_SERVER['HTTP_ACCEPT'] . "<br> " ;
echo __LINE__."    ".$_SERVER['HTTP_ACCEPT_ENCODING'] . "<br> " ;
echo __LINE__."    ".$_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br> " ;
echo __LINE__."    ".$_SERVER['HTTP_CONNECTION'] . "<br> " ;
echo __LINE__."    ".$_SERVER['HTTP_HOST'] . "<br> " ;
echo __LINE__."    ".$_SERVER['HTTP_REFERER'] . "<br> " ;


echo __LINE__."    ".$_SERVER['REMOTE_ADDR'] . "<br> " ;

echo __LINE__."    ".$_SERVER['REMOTE_PORT'] . "<br> " ;


echo __LINE__."    ".$_SERVER['SCRIPT_FILENAME'] . "<br> " ;
echo __LINE__."    ".$_SERVER['SERVER_ADMIN'] . "<br> " ;
echo __LINE__."    ".$_SERVER['SERVER_PORT'] . "<br> " ;
echo __LINE__."    ".$_SERVER['SERVER_SIGNATURE'] . "<br>" ;

echo __LINE__."    ".$_SERVER['SCRIPT_NAME'] . "<br> ";
echo __LINE__."    ".$_SERVER['REQUEST_URI'] . "<br> " ;



echo "<br>";


echo __LINE__ . "<br>";
echo __DIR__ . "<br>";
echo __FILE__ . "<br>";
//echo __FUNCTION__ . "<br>";
echo __CLASS__ . "<br>";
echo __TRAIT__ . "<br>";
//echo __METHOD__ . "<br>";
echo __NAMESPACE__ . "<br>";

echo __LINE__."    ".$_SERVER['REMOTE_ADDR'];




?>
