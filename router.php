<?php
session_start();
include "configuration.php";
include "sql.php";
include "class.profile.php";

if(!empty($_POST)){
	include "post.php";
}

$profile = new profile;
if(($profile->id)){
	include "main.php";
}else{
	include "login.php";
}