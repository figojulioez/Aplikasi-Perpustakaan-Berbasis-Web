<?php 

class transaksiPeminjaman extends controller{
	public function __construct () {

		// Jika belum login maka jangan biarkan user masuk
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
		}


		$conn = mysqli_connect("localhost","root","","perpus");
		$nis = $_SESSION["identitas"]["nis"];
		$query = "SELECT * FROM praPeminjaman WHERE nis = '$nis'";
		$query = mysqli_query($conn,$query);
		
		if ( mysqli_num_rows($query) ) {
			$_SESSION["sudahPraPeminjaman"] = true;
		} else {
			unset($_SESSION["sudahPraPeminjaman"]);
		}


		$query = mysqli_query($conn,"SELECT * FROM riwayatPeminjaman WHERE nis = '$nis'");
		if ( mysqli_num_rows($query) ) {
			$_SESSION["ada"] = true;
		} else {
			unset($_SESSION["ada"]);
		}


	}

	public function formulirPeminjamanBuku ($dataUrl = []) {
		$praPeminjaman = $this->model("praPeminjamanModels");
		$daftarBuku = $this->model("daftarModels");
		$data["pilihan"] = "transaksiPeminjaman";
		$conn = mysqli_connect("localhost","root","","perpus");
		$nis = $_SESSION["identitas"]["nis"];
		$cookie = $_SESSION["identitas"]["cookie"];



		if ( !isset($_SESSION['sudahPraPeminjaman']) ) {
			$query = "SELECT * FROM daftarBuku WHERE nis = '$nis' ";
			$data["daftarBuku"] = $daftarBuku->getDaftarModel($query);
		} else {
			$bukuModels = $this->model("bukuModels");
			$query = "SELECT * FROM praPeminjaman INNER JOIN siswa ON praPeminjaman.nis = siswa.nis WHERE kodePraPeminjaman = '$cookie'  ORDER BY urutan DESC";

			$data["praPeminjaman"] = $praPeminjaman->getPraPeminjamanModel($query);
		}
		




		$this->view("user/templates/header",$data);
		$this->view("user/transaksiPeminjaman/formulirPeminjamanBuku",$data);
		$this->view("user/templates/footer");
	}

	public function riwayatPeminjamanBuku ($dataUrl = []) {
		$data["pilihan"] = "transaksiPeminjaman";
		$conn = mysqli_connect("localhost","root","","perpus");
		$riwayatPeminjamanModel = $this->model("riwayatPeminjamanModels");


		// mengetahui apa yang di searching
		if ( isset($_POST["searchR"])  ) {
			$_SESSION["keyR"] = $_POST["pencarianRiwayat"];
			$key = $_SESSION["keyR"];
		} else if ( isset($_SESSION["keyR"]) ) { $key = $_SESSION["keyR"]; }
		else {
			$key = "";
		}


		// menghitung jumlah data per halaman
		if ( isset($_POST["limit"])) {
			// jdp = jumlah data per halaman
			$_SESSION["jdpsR"] = $_POST["limit"];
			$jdp = $_SESSION["jdpsR"];
		} else if ( isset($_SESSION["jdpsR"]) ) { $jdp = $_SESSION["jdpsR"]; }
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
		$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM riwayatPeminjaman"));
		if ( isset($_SESSION["keyR"]) ) {
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM riwayatPeminjaman WHERE kodeTransaksi = '$cookie'AND ( judulBuku LIKE '%$key%' || tanggalPeminjaman LIKE '%$key%' || tanggalPengembalian LIKE '%$key%' ) "));			
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

		$cookie = $_SESSION["identitas"]["cookie"];


		$query = "SELECT * FROM riwayatPeminjaman WHERE kodeTransaksi = '$cookie'AND ( judulBuku LIKE '%$key%' || tanggalPeminjaman LIKE '%$key%' || tanggalPengembalian LIKE '%$key%' )  ORDER BY urutan DESC LIMIT $am,$jdp ";
		$data["riwayatPeminjaman"] = $riwayatPeminjamanModel->getRiwayatPeminjamanModel($query);






		$this->view("user/templates/header",$data);
		$this->view("user/transaksiPeminjaman/riwayatPeminjamanBuku",$data);
		$this->view("user/templates/footer");
	}

	public function hapus ($link) {
		$daftarModels = $this->model("daftarModels");
		if ( $daftarModels->delete($link[0]) === "kosong") {
			flasher::setFLash("Data Kosong","","danger");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;
		} else if ( $daftarModels->delete($link[0]) >= 0 ) {
			flasher::setFLash("Buku Berhasil","dihapus dari daftar","success");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;

		}
		else {
			flasher::setFLash("Buku Gagal","hapus dari daftar","danger");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;

		}
	}

	public function informasi () {
		$no = $_POST["no"];
		$query = "SELECT * FROM buku WHERE no = '$no'";
		$bukuModels = $this->model("bukuModels");


		echo json_encode($bukuModels->getBukuModel($query)[0]);
	}

	public function praPeminjaman ($link) {
		$praPeminjamanModels = $this->model("praPeminjamanModels");
		if ( $praPeminjamanModels->insert($link[0]) === "kosong") {
			flasher::setFLash("Daftar Peminjaman anda Kosong","","danger");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;
		} 
		else if ( $praPeminjamanModels->insert($link[0]) >= 0 ) {
			flasher::setFLash("Pra Peminjaman Berhasil","dilakukan","success");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;
		} 
		else {
			flasher::setFLash("Pra Peminjaman Gagal","dilakukan","danger");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;

		}	
	}

	public function hapusPraPeminjaman ($link = []) {
		$praPeminjaman = $this->model("praPeminjamanModels");
		if ( $praPeminjaman->delete($link) >= 0 ) {
			flasher::setFLash("Data Pra Peminjaman Berhasil","dihapus dari daftar","success");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;

		}
		else {
			flasher::setFLash("Data Pra Peminjaman Gagal","hapus dari daftar","danger");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;

		}	
	}



}