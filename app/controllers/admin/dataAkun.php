<?php 

class dataAkun extends controller{
	public function __construct () {

		// Jika belum login maka jangan biarkan user masuk
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
		}
	}

	public function index ($dataUrl = []) {
		$data["pilihan"] = "dataAkun";
		$siswa = $this->model("siswaModels");


		// mengetahui apa yang di searching
		if ( isset($_POST["search"])  ) {
			$_SESSION["keyTambah"] = $_POST["keyword"];
			$key = $_SESSION["keyTambah"];
		} else if ( isset($_SESSION["keyTambah"]) ) { $key = $_SESSION["keyTambah"]; }
		else {
			$key = "";
		}

		// menghitung jumlah data per halaman
		if ( isset($_POST["limit"])) {
			// jdp = jumlah data per halaman
			$_SESSION["jdpsAkun"] = $_POST["limit"];
			$jdp = $_SESSION["jdpsAkun"];
		} else if ( isset($_SESSION["jdpsAkun"]) ) { $jdp = $_SESSION["jdpsAkun"]; }
		else {
			$jdp = 10;
		}

		// mengetahui halaman aktif
		$hf = 1;
		if ( !empty($dataUrl[0]) ) {
			// hf = halaman aktif
			
			$hk = explode("=", $dataUrl[0]);
			if ( in_array("page", $hk) ) {
				$hf = end($hk);
			}
		}

		// mengetahui jumlah halaman
		// jm = jumlah halaman
		$conn = mysqli_connect("localhost","root","","perpus");
		$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM siswa"));
		if ( isset(	$_SESSION["keyTambah"] ) ) {
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM siswa WHERE (
		nis LIKE '%$key%' || gambar LIKE '%$key%' || nama LIKE '%$key%' || kelas LIKE '%$key%' || password LIKE '%$key%' || noTelp LIKE '%$key%' ) AND jenisAkun = 'U'  ORDER BY nis ASC"));
		}


		//mengetahui jumlah pagination
		// jp = jumlah pagination
		$jp = ceil($jm /$jdp);
		

		// menghitung awal mulai
		// am = awal mulai
		$am = ( $hf - 1 ) * $jdp;

		// menghitung jumlah link
		$jumlahLink = 1;
		if ( $hf > $jumlahLink ) {
			$nomorAwal = $hf - $jumlahLink;
		} else {
			$nomorAwal = 1;
		}
		if ( $hf < ($jp - $jumlahLink) ) {
			$nomorAkhir = $hf + $jumlahLink;
		} else {
			$nomorAkhir = $jp;
		}

		$data["na"] = $nomorAwal;
		$data["nr"] = $nomorAkhir;
		$data["hf"] = $hf;
		$data["jp"] = $jp;
		// hal-hal yang akan dibutuhkan


		$query = "SELECT * FROM siswa WHERE (
		nis LIKE '%$key%' || gambar LIKE '%$key%' || nama LIKE '%$key%' || kelas LIKE '%$key%' || password LIKE '%$key%' || noTelp LIKE '%$key%' ) AND jenisAkun = 'U' ORDER BY nis ASC LIMIT $am, $jdp "; 
		$data["siswa"] = $siswa->getSiswaModel($query);

		$this->view("admin/templates/header",$data);
		$this->view("admin/dataAkun/index",$data);
		$this->view("admin/templates/footer");

	}

	public function tambahSiswa () {
		if ( isset($_POST["btn"]) ) {
			if ( $this->model("siswaModels")->insert($_POST,$_FILES) >= 0 ) {
				flasher::setFLash("Akun Berhasil","ditambahkan","success");
				header("location: http://localhost/perpus/dataSiswa");
				exit;
			} 
			else {
				flasher::setFLash("Akun Gagal","ditambahkan","danger");
				header("location: http://localhost/perpus/dataSiswa");
				exit;

			}
		}



	}

	public function editSiswa () {
		$nis = $_POST["nis"];
		$query = "SELECT * FROM siswa WHERE nis = '$nis'";
		$siswaModels = $this->model("siswaModels");


		echo json_encode($siswaModels->getSiswaModel($query)[0]);
		


	} 


	public function ubahSiswa () {
		$siswaModels = $this->model("siswaModels");
		if ( isset($_POST["btn"]) ) {
			if ( $siswaModels->updateAkun($_POST) >= 0 ) {
				flasher::setFLash("Akun Berhasil","diedit","success");
				header("location: http://localhost/perpus/dataAkun");
				exit;
			} 
			else {
				flasher::setFLash("Akun Gagal","diedit","danger");
				header("location: http://localhost/perpus/dataAkun");
				exit;

			}
		}		

	}

	public function hapus ($link) {
		$siswaModels = $this->model("siswaModels");
		if ( $siswaModels->delete($link[0]) >= 0 ) {
			flasher::setFLash("Akun Berhasil","dihapus","success");
			header("location: http://localhost/perpus/dataAkun");
			exit;
		} 
		else {
			flasher::setFLash("Akun Gagal","diedit","danger");
			header("location: http://localhost/perpus/dataAkun");
			exit;

		}
	}		
}