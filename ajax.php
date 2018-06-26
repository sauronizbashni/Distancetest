<?php
session_start();
include "configuration.php";
include "sql.php";
include "class.profile.php";
include "class.lessons.php";
$lesson=lessons::get1($_POST["id"]);
$res["title"]=$lesson["name"];
$res["html"]=$lesson["text"];
echo json_encode($res);