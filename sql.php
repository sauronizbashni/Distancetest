<?php
session_start();
class db
{
	public $connect;
	public $counts;
	public $result;
	public $lastID;
	function connectDB(){
		global $mysqli;
		$mysqli = new mysqli(DBhost,DBuser,DBpass,DBname);
		$this->connect=$mysqli;
		$mysqli->query("SET NAMES 'utf8'");	
	}

	function closeDB(){
		global $mysqli;
		$mysqli->close();	
	}
	function getarray($sql){
		global $mysqli;
		$result_set = $mysqli->query($sql);	
		$res=sql::resultSetToArray($result_set);
		$this->counts=count($res);
		$this->result=$res;
	}
	function getelem($sql){
		global $mysqli;
		$result_set = $mysqli->query($sql);	
		return $result_set->fetch_assoc();
	}
	function dosql($sql){
		global $mysqli;
		$success = $mysqli->query($sql);
		return $success;
	}
	function dosqlLastId($sql){
		global $mysqli;
		$success = $mysqli->query($sql);
		if($success){
			$this->lastID = $mysqli->insert_id;
		}
		return $success;
	}
}
class sql
{
	static function resultSetToArray($result_set){
		$array = array();
		while (($row = $result_set->fetch_assoc()) != false)
		$array [] = $row;
		return $array;
	}
}