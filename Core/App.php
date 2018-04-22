<?php 
	class App{
		protected $url;
		protected $controller = 'Home';
		protected $method = 'index';
		protected $params = [];

		public function __construct(){
			$this->url = $this->parseUrl();
			$this->loadTwig();
			$this->setController();
		}

		public function setController(){
			
			try{
				if(file_exists('../App/controllers/'. $this->url[0] . '.php')){
					$this->controller = $this->url[0];
					unset($this->url[0]);

					require_once('../App/controllers/'. $this->controller .'.php');

					$controller = 'App\controllers\\' . $this->controller;
					$this->controller = new  $controller;

					if(isset($this->url[1])){
						if(method_exists($this->controller, $this->url[1])){
							$this->method = $this->url[1];
							unset($this->url[1]); 
						}
					}	

					$this->params =  $this->url ? array_values($this->url) : [];
					call_user_func_array([$this->controller, $this->method], $this->params);						
				}else{
					throw new Exception('404 Page');
				}

			} catch(Exception $ex) {
 				echo 'Error ' . $ex->getMessage();
 				die;
			} 
					
		}

		public function parseUrl(){
			if(isset($_GET['url'])){
				$filterUrl = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
				return explode('/', $filterUrl);
			}else{
				return ['Home', 'index'];
			}
		}

		public function loadTwig(){
			require_once('../vendor/autoload.php');
			Twig_Autoloader::register();
		}

		

	}