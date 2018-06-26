<?php
class profile
{
	public $id;
	public $login;
	public $password;
	public $type;
	function profile(){
		if((strlen($_SESSION['login-name'])>0)&&(strlen($_SESSION['login-password']))>0){
			$this->login=$_SESSION['login-name'];
			$this->password=$_SESSION['login-password'];
			$connect = new db;
			$connect->connectDB();
			$sql="SELECT * FROM `users` WHERE `login`='".$this->login."' AND `password`='".$this->password."'";
			$user=$connect->getelem($sql);
			$connect->closeDB();
			$this->id=$user["id"];
			$this->login=$user["login"];
			$this->password=$user["password"];
			$this->type=$user["type"];
		}else{
			$this->id=0;
			$_SESSION['login-name']='';
			$_SESSION['login-password']='';
		}
	}
}
