<?php

//! Base controller
class Controller {

	//protected $db;

	function getWorldDb() {
		$db=new \DB\SQL('mysql:host=localhost;port=3306;dbname=rasaworld','rasa','rasa');
		return $db;
	}

	//! HTTP route pre-processor
	function beforeroute($f3) {
		//$db=new \DB\SQL('mysql:host=localhost;port=3306;dbname=rasaworld','rasa','rasa');
		//$f3->set("db", $db);
	}

	//! HTTP route post-processor
	function afterroute() {
		
	}

	//! Instantiate class
	function __construct() {
		//$f3=Base::instance();
	}
}
?>