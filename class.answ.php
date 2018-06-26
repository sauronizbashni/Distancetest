<?php
class answ
{
	static function get($id){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT * FROM `answ` WHERE `qw`='".$id."'";
		$connect->getarray($sql);
		$users=$connect->result;
		$connect->closeDB();
		return $users;
	}
	static function del($id){
		$connect = new db;
		$connect->connectDB();
		$sql="DELETE FROM `answ` WHERE `id`='".$id."'";
		$res=$connect->dosql($sql);
		$connect->closeDB();
		return $res;
	}
	static function add($name,$qw,$stat){
		$connect = new db;
		$connect->connectDB();
		$sql="INSERT INTO `answ`(`name`, `qw`, `stat`) VALUES ('".$name."','".$qw."','".$stat."')";
		$res=$connect->dosql($sql);
		$connect->closeDB();
		return $res;
	}
}
