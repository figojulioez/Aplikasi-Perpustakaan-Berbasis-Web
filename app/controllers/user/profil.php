<?php 

class profil extends controller {
	public function _construct () {
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
		}
	}

	public function index ($dataUrl = []) {
		$data["pilihan"] = "profil";



		$this->view("user/templates/header",$data);
		$this->view("user/profil/index",$data);
		$this->view("user/templates/footer");
	}

	public function setuju () {
		$siswaModels = $this->model("siswaModels");
		if ( isset($_POST["btn"]) ) {
			if ( $siswaModels->update($_POST) >= 0 ) {
				flasher::setFLash("Profil Anda Berhasil","diedit","success");
				header("location: http://localhost/perpus/profil");
				exit;
			} 
			else {
				flasher::setFLash("Data Siswa Gagal","diedit","danger");
				header("location: http://localhost/perpus/profil");
				exit;

			}
		}
	}



}

