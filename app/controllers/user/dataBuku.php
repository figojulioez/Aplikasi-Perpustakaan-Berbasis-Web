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
		if ( isset($_POST["btnJenisBuku"])) {
			// jdp = jumlah data per halaman

			if ( $_POST["jenisBuku"] == "All" ) {
				$_SESSION["jenisBuku"] = "";
				$jenisBuku = $_SESSION["jenisBuku"];
			} else {
				$_SESSION["jenisBuku"] = $_POST["jenisBuku"];
				$jenisBuku = $_SESSION["jenisBuku"];
			}
		} else if ( isset($_SESSION["jenisBuku"]) ) { $jenisBuku = $_SESSION["jenisBuku"]; }
		else {
			$jenisBuku = "";
		}

		$jdp = 4;

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
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku WHERE ( no LIKE '%$key%' || judul LIKE '%$key%' || pengarang LIKE '%$key%' || gambarBuku LIKE '%$key%' || sinopsis LIKE '%$key%' ) AND jenisBuku LIKE '%$jenisBuku%' AND jumlahBuku > bukuDipinjam"));
		}
		//mengetahui jumlah pagination
		// jp = jumlah pagination
		$jp = ceil($jm /$jdp);
		

		// menghitung awal mulai
		// am = awal mulai
		$am = ( $hf - 1 ) * $jdp;




		$query = "SELECT * FROM buku WHERE ( no LIKE '%$key%' || judul LIKE '%$key%' || pengarang LIKE '%$key%' || gambarBuku LIKE '%$key%' || sinopsis LIKE '%$key%' ) AND jenisBuku LIKE '%$jenisBuku%' AND jumlahBuku > bukuDipinjam ORDER BY judul DESC LIMIT $am, $jdp "; 
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



		$this->view("user/templates/header",$data);
		$this->view("user/dataBuku/index",$data);
		$this->view("user/templates/footer",$data);
	}

	public function editBuku () {
		$no = $_POST["no"];
		$query = "SELECT * FROM buku WHERE no = '$no'";
		$bukuModels = $this->model("bukuModels");


		echo json_encode($bukuModels->getBukuModel($query)[0]);
	}

	public function daftarBuku () {
		$daftarBuku = $this->model("daftarModels");
		if ( isset($_POST["btn"]) ) {
			if ( $daftarBuku->insert($_POST) === "sudah" ) {
				flasher::setFLash("Anda Sudah menambahkan Buku ","ke dalam daftar","danger");
				header("location: http://localhost/perpus/dataBuku");
				exit;
			} 

			if ( $daftarBuku->insert($_POST) === "tidak" ) {
				flasher::setFLash("Anda Sedang Meminjam Buku","","danger");
				header("location: http://localhost/perpus/dataBuku");
				exit;
			} 
			if ( $daftarBuku->insert($_POST) === "batas") {
			flasher::setFLash("Batas Peminjaman","hanya 3 buku","danger");
			header("location: http://localhost/perpus/dataBuku");
			exit;
		}
			if ( $daftarBuku->insert($_POST) === "p") {
			flasher::setFLash("Anda sudah melakukan","Pra Peminjaman","danger");
			header("location: http://localhost/perpus/dataBuku");
			exit;
		}
		

			else if ( $daftarBuku->insert($_POST) >= 0 ) {
				flasher::setFLash("Buku Berhasil","ditambahkan ke dalam daftar","success");
				header("location: http://localhost/perpus/dataBuku");
				exit;
			} 
			else {
				flasher::setFLash("Buku Gagal","ditambahkan ke dalam daftar","danger");
				header("location: http://localhost/perpus/dataBuku");
				exit;

			}
		}
	}
	
}