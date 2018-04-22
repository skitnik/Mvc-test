<?php
	namespace App\controllers;

	class Test extends \Core\Controller{
		public function index(){
			$test = $this->loadModel('test');
			$data['text'] = $test->getSomeData();
			$this->loadView('test', $data);
		}
		
	}