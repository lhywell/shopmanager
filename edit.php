<?php

require("./database.php");

$db = new DB("product");

$id =  $_GET["id"];
// echo ($id);
$result = $db->search("", $id);

// 利用session存储表单数据
session_start();

while ($row = $result->fetch_assoc()) {

    $_SESSION['pname'] = $row['pname'];
    $_SESSION['price'] =  $row['price'];
    $_SESSION['pcount'] =  $row['pcount'];
    $_SESSION['remark'] =  $row['remark'];
    $_SESSION['id'] =  $row['id'];
}

// echo( $_SESSION['pname']);
header("location:index.php#editModel");

?>