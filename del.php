<?php


require("./database.php");

$db = new DB("product");

$id =  $_GET["id"];
// echo ($id);
$db->delete($id);


header("location:index.php");




?>