<?php
require_once "parse.class.php";
$parse = new Parse();
$results = $parse->results($_GET['text']);
echo $results;
?>