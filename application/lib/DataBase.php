<?php

namespace application\lib;
use application\lib\Utils;
use PDO;

class DataBase
{
	private $db;
	private $utils;
	
	function __construct(){
		$config = require 'application/config/db.php';
		$this->db = new PDO("mysql:host={$config['host']};dbname={$config['name']}", $config['user'], $config['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		$utils = new Utils();
		$this->utils = $utils;
	}

	public function doQuery($sql, $params=[]){
		$preparedDB = $this->db->prepare($sql);
		if(!empty($params)){
			if($this->utils->isAssoc($params)){
				foreach ($params as $key => $value) {
					$preparedDB->bindValue(':'.$key, $value);
				}
			} else {
				$preparedDB->execute($params);
				return $preparedDB;
			}
			
		}
		$preparedDB->execute();
		return $preparedDB;
	}

	public function getRows($sql, $params=[]){
		$queryResult = $this->doQuery($sql, $params);
		return $queryResult->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getRow($sql, $params=[]){
		$queryResult = $this->doQuery($sql, $params);
		return $queryResult->fetch(PDO::FETCH_ASSOC);
	}

	public function getColumn($sql, $params=[]){
		$queryResult = $this->doQuery($sql, $params);
		return $queryResult->fetchColumn();
	}
	
}