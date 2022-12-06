<?php


require("./database.php");

$db = new DB("product");

$id =  $_GET["id"];

$pname =  $_POST["pname"];
$price =  $_POST["price"];
$pcount =  $_POST["pcount"];
$remark =  $_POST["remark"];

// echo ($pname);
$db->update($pname, $price, $pcount, $remark, $id);


header("location:index.php");




?>