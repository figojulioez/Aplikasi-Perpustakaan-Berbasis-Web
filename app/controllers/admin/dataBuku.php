<?php 

class dataBuku extends controller {
		public function __construct () {

		// Jika belum login maka jangan biarkan user masuk
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
		}
	}


	public function index ($dataUrl = []) {
		$data["pilihan"] = "dataBuku";
		$buku = $this->model("bukuModels");

		// fitur searching
		$key = "";
		if ( isset($_POST["searchBuku"])  ) {
			$_SESSION["keyBuku"] = $_POST["keywordBuku"];
			$key = $_SESSION["keyBuku"];
		} else if ( isset($_SESSION["keyBuku"]) ) { $key = $_SESSION["keyBuku"]; }
		else {
			$key = "";
		}

		// fitur limit data
		if ( isset($_POST["limitBuku"])) {
			// jdp = jumlah data per halaman
			$_SESSION["jdpsBuku"] = $_POST["limitBuku"];
			$jdp = $_SESSION["jdpsBuku"];
		} else if ( isset($_SESSION["jdpsBuku"]) ) { $jdp = $_SESSION["jdpsBuku"]; }
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
		$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku"));
		if ( isset($_SESSION["keyBuku"]) ) {
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku WHERE no LIKE '%$key%' || judul LIKE '%$key%' || pengarang LIKE '%$key%' || gambarBuku LIKE '%$key%' || bukuDipinjam LIKE '%$key%' || jumlahBuku LIKE '%$key%' || sinopsis LIKE '%$key%' || jenisBuku LIKE '%$key%'  ORDER BY urutan DESC "));
		}


		//mengetahui jumlah pagination
		// jp = jumlah pagination
		$jp = ceil($jm /$jdp);
		

		// menghitung awal mulai
		// am = awal mulai
		$am = ( $hf - 1 ) * $jdp;




		$query = "SELECT * FROM buku WHERE no LIKE '%$key%' || judul LIKE '%$key%' || pengarang LIKE '%$key%' || gambarBuku LIKE '%$key%' || bukuDipinjam LIKE '%$key%' || jumlahBuku LIKE '%$key%' || sinopsis LIKE '%$key%' || jenisBuku LIKE '%$key%'  ORDER BY judul DESC LIMIT $am, $jdp "; 
		$data["buku"] = $buku->getBukuModel($query);

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



		$this->view("admin/templates/header",$data);
		$this->view("admin/dataBuku/index",$data);
		$this->view("admin/templates/footer",$data);
	}

	public function tambahBuku () {
		$buku = $this->model("bukuModels");
		if ( isset($_POST["btn"]) ) {
			if ( $buku->insert($_POST,$_FILES) == "sudah" ) {
				flasher::setFLash("Buku sudah","ditambahkan","danger");
				header("location: http://localhost/perpus/dataBuku");
				exit;
			}	

			if ( $buku->insert($_POST,$_FILES) == "kosong" ) {
				flasher::setFLash("Buku Gagal","ditambahkan, karena jumlah buku lebih kecil dari 1","danger");
				header("location: http://localhost/perpus/dataBuku");
				exit;
			}					

			if ( $buku->insert($_POST,$_FILES) >= 0 ) {
				flasher::setFLash("Buku Berhasil","ditambahkan","success");
				header("location: http://localhost/perpus/dataBuku");
				exit;
			} 
			else {
				flasher::setFLash("Buku Gagal","ditambahkan","danger");
				header("location: http://localhost/perpus/dataBuku");
				exit;

			}
		}
	}

	public function hapus ($link) {
		$bukuModels = $this->model("bukuModels");
			if ( $bukuModels->delete($link[0]) >= 0 ) {
				flasher::setFLash("Buku Berhasil","dihapus","success");
				header("location: http://localhost/perpus/dataBuku");
				exit;
			} 
			else {
				flasher::setFLash("Buku Gagal","diedit","danger");
				header("location: http://localhost/perpus/dataBuku");
				exit;

			}
		}		

	public function editBuku () {
		$no = $_POST["no"];
		$query = "SELECT * FROM buku WHERE no = '$no'";
		$bukuModels = $this->model("bukuModels");


		echo json_encode($bukuModels->getBukuModel($query)[0]);
	}

	public function ubahBuku () {
		$bukuModels = $this->model("bukuModels");
		if ( isset($_POST["btn"]) ) {

		$coba = $bukuModels->update($_POST,$_FILES);

			if ( $coba == "kosong" ) {
				flasher::setFLash("Buku Gagal","ditambahkan, karena jumlah buku lebih kecil dari 1","danger");
				header("location: http://localhost/perpus/dataBuku");
				exit;
			}					



			else if ( $coba >= 0 ) {
				flasher::setFLash("Buku Berhasil","diedit","success");
				header("location: http://localhost/perpus/dataBuku");
				exit;
			} 
			else {
				flasher::setFLash("Buku Gagal","diedit","danger");
				header("location: http://localhost/perpus/dataBuku");
				exit;

			}
		}		
	}


}