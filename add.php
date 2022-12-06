<?php


require("./database.php");

$db = new DB("product");

$pname =  $_POST["pname"];
$price =  $_POST["price"];
$pcount =  $_POST["pcount"];
$remark =  $_POST["remark"];

// echo ($pname);
$db->insert($pname, $price, $pcount, $remark);


header("location:index.php");




?>