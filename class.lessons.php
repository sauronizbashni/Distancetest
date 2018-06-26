<?php
class lessons
{
	static function get(){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT * FROM `lessons`";
		$connect->getarray($sql);
		$users=$connect->result;
		$connect->closeDB();
		return $users;
	}
	static function getbycat($id){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT * FROM `lessons` WHERE `cat`='".$id."'";
		$connect->getarray($sql);
		$users=$connect->result;
		$connect->closeDB();
		return $users;
	}
	static function get1($id){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT * FROM `lessons` WHERE `id`='".$id."'";
		$res=$connect->getelem($sql);
		$connect->closeDB();
		return $res;
	}
	static function del($id){
		$connect = new db;
		$connect->connectDB();
		$sql="DELETE FROM `lessons` WHERE `id`='".$id."'";
		$res=$connect->dosql($sql);
		$connect->closeDB();
		return $res;
	}
	static function add($post,$files=''){
		$connect = new db;
		$connect->connectDB();
		if($post['type']=='text'){
			$sql="INSERT INTO `lessons`(`name`, `type`,`text`,`cat`) VALUES ('".$post['name']."','".$post['type']."','".$post['text']."','".$post['cat']."')";
			$res=$connect->dosql($sql);
		}elseif($post['type']=='test'){
			$sql="INSERT INTO `lessons`(`name`, `type`,`cat`) VALUES ('".$post['name']."','".$post['type']."','".$post['cat']."')";
			$res=$connect->dosql($sql);
		}elseif($post['type']=='file'){
			$namefil=$files["name"];
			$updir="download/".$namefil;
			move_uploaded_file($files["tmp_name"],$updir);
			$sql="INSERT INTO `lessons`(`name`, `type`,`text`,`cat`) VALUES ('".$post['name']."','".$post['type']."','".$namefil."','".$post['cat']."')";
			$res=$connect->dosql($sql);
		}
		$connect->closeDB();
		return $res;
	}
}
