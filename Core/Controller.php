<?php

namespace Core;

class Controller{
	
	public function loadModel($model){
		require_once('../App/Models/' . $model . '.php');
		$newModel = 'App\models\\' . $model;
		return new $newModel;
	}

	public function loadView($view, $data = []){
		
		static $twig = null;
		if($twig === null){
			$loader = new \Twig_Loader_Filesystem('../App/views/');
			$twig = new \Twig_Environment($loader);
		}
		
		echo $twig->render($view.'.html', $data);
	}
}	