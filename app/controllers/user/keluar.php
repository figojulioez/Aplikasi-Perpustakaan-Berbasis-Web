<?php 

class keluar {
	public function index () {
		session_destroy();
		header("location: http://localhost/perpus/masuk");
		exit;
	}
}