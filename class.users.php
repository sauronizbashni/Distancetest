<?php
class users
{
	static function get(){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT * FROM `users`";
		$connect->getarray($sql);
		$users=$connect->result;
		$connect->closeDB();
		return $users;
	}
	static function add($login,$pass,$type){
		$connect = new db;
		$connect->connectDB();
		
		$sql="SELECT * FROM `users` WHERE `login`='".$login."'";
		$res=$connect->getelem($sql);
		
		if(count($res)==0){
			$sql="INSERT INTO `users`(`login`, `password`, `type`) VALUES ('".$login."','".$pass."','".$type."')";
			$res=$connect->dosql($sql);
		}
		$connect->closeDB();
		return $res;
	}
	static function del($id){
		$connect = new db;
		$connect->connectDB();
		$sql="DELETE FROM `users` WHERE `id`='".$id."'";
		$res=$connect->dosql($sql);
		$connect->closeDB();
		return $res;
	}
}
