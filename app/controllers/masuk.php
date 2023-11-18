<?php
class masuk extends controller {
	public function index ($data = []) {
		$this->view("templates/header");
		$this->view("masuk/index",$data);
		$this->view("templates/footer");
	}

	public function login () {
		// Koneksi dengan database 
		$model = $this->model("siswaModels");
		$conn = $model->conn();
		$siswaModels = $model->getSiswaModel();

		if ( isset($_POST["btn"]) ) {
			// Jika button masuk di klik maka tangkap data yang masuk

			$username = $_POST["usrnm"];
			$password = $_POST["psw"];

			// menampilkan seluruh akun yang memiliki username yang sama dengan
			// username yang di kirimkan
			
$q = mysqli_query($conn,"SELECT * FROM siswa WHERE nis = '$username'");
				// cek apakah ada data yang di tampilkan
			if ( mysqli_num_rows($q) ) {

				// jika ada tangkap data tersebut
				$f = mysqli_fetch_assoc($q);
				$cookie = $f["cookie"];
				// cek password apakah password sesuai dengan pasword yang dikirimkan dan pasword yang ada pada table
				if ( $password == $f["password"] ) {
					// jika benar buat sesi
					// dan pindahkan ke halaman dashboard

					if ( $f["jenisAkun"] == "A" ) {
						$_SESSION["login"] = true;
						$_SESSION["klien"] = "admin";
						$_SESSION["identitas"] = $f;
						header("location: http://localhost/perpus/dashboard"); 
						exit;
					} else {
						$_SESSION["login"] = true;
						$_SESSION["klien"] = "user";
						$_SESSION["identitas"] = $f;
						header("location: http://localhost/perpus/dashboard"); 
						exit;
					}
				} else {
					$_SESSION["passwordTidakAda"] = true;
			header("location: http://localhost/perpus/masuk/index");
			exit;
				}
			}	else {
			$_SESSION["akunTidakAda"] = true;
			header("location: http://localhost/perpus/masuk/index");
			exit;
		} 

		} 

	}


}