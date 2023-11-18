	<?php 

class app {
	protected $klien = "";
	protected $controller = "masuk";
	protected $method = "index";
	protected $params = [];

	public function __construct () {
		// Panggil instruksi dari url
		$url = $this->parseUrl();

		// Pisahkan antara controller, method, dan params pada instruksi url 
		// cek file
		if ( isset($url[0]) ) {

			if ( isset($_SESSION["klien"])	 ) {
				$this->klien = $_SESSION["klien"];

				if ( file_exists("app/controllers/" . $this->klien . "/" . $url[0] . ".php") ) {
					$this->controller = $url[0];
					unset($url[0]);
				}
			} else {


			// Kalau ada masukan ke dalam properti controller
				if ( file_exists("app/controllers/". $url[0] . ".php") ) {
					$this->controller = $url[0];
					unset($url[0]);
				} else {
					header("location: http://localhost/perpus/". $this->controller);
				} 
			}
		} else { header("location: " . $this->controller); }

		// Apabila file ada hubungkan dengan file tersebut lalu instansi classnya
		if ( isset($_SESSION["klien"]) ) {


			require "app/controllers/" . $this->klien . "/" . $this->controller . ".php";
			$this->controller = new $this->controller; 

		} else {
				require "app/controllers/". $this->controller . ".php";
				$this->controller = new $this->controller; 
		}
		// cek method
		if ( isset($url[1]) ) {

			// Kalau ada masukan ke dalam properti method
			if ( method_exists($this->controller,$url[1]) ) {
				$this->method = $url[1];
				unset($url[1]);
			} 
		}



		// cek parameter 
		if ( !empty($url) ) {
			$this->params[] = array_values($url);
		}
		// masukan params kedalam controler, dan method yang sudah diketahui
		call_user_func_array([$this->controller,$this->method], $this->params);
		
	}

	// instruksi URL 
	public function parseUrl () {
		if ( isset($_GET["url"]) ) {
			// Tankap Url
			$url = $_GET["url"];

			// Bersihlan Url
			$url = rtrim($url,"/");
			$url = filter_var($url,FILTER_SANITIZE_URL);

			// Pisahkan Url
			$url = explode("/", $url);

			// Kembalikan Nilai
			return $url;
		}
	}
}