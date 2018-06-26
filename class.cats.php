<?php
class cats
{
	static function get(){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT * FROM `cats`";
		$connect->getarray($sql);
		$users=$connect->result;
		$connect->closeDB();
		return $users;
	}
	static function getbypar($id){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT * FROM `cats` WHERE `parent`='".$id."'";
		$connect->getarray($sql);
		$users=$connect->result;
		$connect->closeDB();
		return $users;
	}
	static function catname($id){
		$connect = new db;
		$connect->connectDB();
		$sql="SELECT `name` FROM `cats` WHERE `id`='".$id."'";
		$res=$connect->getelem($sql);
		$connect->closeDB();
		return $res["name"];
	}
	static function printoptlist($id=0,$pref=''){
		$cats=cats::getbypar($id);
		foreach($cats as $cat){
			echo '<option value="'.$cat["id"].'">'.$pref.$cat["name"].'</option>';
			cats::printoptlist($cat["id"],$pref.'-');
		}
	}
	static function printlinklist($id=0,$before='',$after=''){
		$cats=cats::getbypar($id);
		if(count($cats)>0){
			echo $before;
			foreach($cats as $cat){
				echo '<li class="nav-item"><a class="nav-link';
				if($_GET["cat"]==$cat["id"]) echo ' active';
				echo '" href="/?cat='.$cat["id"].'">'.$cat["name"].'</a>';
				cats::printlinklist($cat["id"],$before,$after);
				echo '</li>';
			}
			echo $after;
		}
	}
	static function add($name,$parent){
		$connect = new db;
		$connect->connectDB();
		$sql="INSERT INTO `cats`(`name`, `parent`) VALUES ('".$name."','".$parent."')";
		$res=$connect->dosql($sql);
		$connect->closeDB();
		return $res;
	}
	static function del($id){
		$connect = new db;
		$connect->connectDB();
		$sql="DELETE FROM `cats` WHERE `id`='".$id."'";
		$res=$connect->dosql($sql);
		$connect->closeDB();
		return $res;
	}
}
