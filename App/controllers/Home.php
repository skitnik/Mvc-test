<?php
	namespace App\controllers;

	class Home extends \Core\Controller{
		public function index(){
			$this->loadView('home');
		}
		
	}