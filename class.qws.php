<?php
class qws
{
	static function get($id){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT * FROM `qw` WHERE `lesson`='".$id."'";
		$connect->getarray($sql);
		$users=$connect->result;
		$connect->closeDB();
		return $users;
	}
	static function get1($id){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT * FROM `qw` WHERE `id`='".$id."'";
		$res=$connect->getelem($sql);
		$connect->closeDB();
		return $res;
	}
	static function del($id){
		$connect = new db;
		$connect->connectDB();
		$sql="DELETE FROM `qw` WHERE `id`='".$id."'";
		$res=$connect->dosql($sql);
		$connect->closeDB();
		return $res;
	}
	static function add($name,$lesson){
		$connect = new db;
		$connect->connectDB();
		$sql="INSERT INTO `qw`(`name`, `lesson`) VALUES ('".$name."','".$lesson."')";
		$res=$connect->dosql($sql);
		$connect->closeDB();
		return $res;
	}
}
