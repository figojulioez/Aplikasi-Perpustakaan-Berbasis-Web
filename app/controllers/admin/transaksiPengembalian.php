<?php 

class transaksiPengembalian extends controller {
	public function __construct () {

		// Jika belum login maka jangan biarkan user masuk
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
		}
	}

	public function formulirPengembalianBuku($dataUrl = []) {
		$data["pilihan"] = "transaksiPengembalian";
		$riwayatPeminjamanModel = $this->model("riwayatPeminjamanModels");



		if ( isset($_POST["search"])  ) {
			$_SESSION["keyFormulirp"] = $_POST["keyFormulirp"];
			$key = $_SESSION["keyFormulirp"];
		} else if ( isset($_SESSION["keyFormulirp"]) ) { $key = $_SESSION["keyFormulirp"]; }
		else {
			$key = "";
		}

		if ( isset($_POST["kondisiPengembalian"]) ) {
			$_SESSION["kondisiPengembalian"] = $_POST["kondisiPengembalian"];
			$kondisi = $_SESSION["kondisiPengembalian"];
		} else if ( isset($_SESSION["kondisiPengembalian"]) ) { $kondisi = $_SESSION["kondisiPengembalian"]; }
		else {
			$kondisi = "Tidak Telat";
		}



		// menghitung jumlah data per halaman
		$jdp = 3;
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

		if ( isset($_SESSION["keyFormulirp"]) ) {
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM riwayatPeminjaman INNER JOIN siswa ON riwayatPeminjaman.kodeTransaksi = siswa.cookie WHERE kodeTransaksi LIKE '%$key%' ORDER BY urutan DESC "));

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

		$_SESSION["nap"] = $nomorAwal;
		$_SESSION["nrp"] = $nomorAkhir;
		$_SESSION["hfp"] = $hf;
		$_SESSION["jpp"] = $jp;
		// hal-hal yang akan dibutuhkan


		if ( $kondisi == "Telat" ) {
			$query = "SELECT * FROM riwayatPeminjaman INNER JOIN siswa ON riwayatPeminjaman.kodeTransaksi = siswa.cookie WHERE kodeTransaksi LIKE '%$key%' AND denda > 0 ORDER BY urutan DESC LIMIT $am, $jdp";

			$data["peminjaman"] = $riwayatPeminjamanModel->getRiwayatPeminjamanModel($query);

		} else {
			$query = "SELECT * FROM riwayatPeminjaman INNER JOIN siswa ON riwayatPeminjaman.kodeTransaksi = siswa.cookie WHERE kodeTransaksi LIKE '%$key%' AND denda = 0 ORDER BY urutan DESC LIMIT $am, $jdp";

			$data["peminjaman"] = $riwayatPeminjamanModel->getRiwayatPeminjamanModel($query);

		}
		
		$this->view("admin/templates/header",$data);
		$this->view("admin/transaksiPengembalian/formulirPengembalianBuku",$data);
		$this->view("admin/templates/footer");
	}

	public function informasi () {
		$no = $_POST["no"];
		$kode = $_POST["nis"];

		$riwayatPeminjamanModel = $this->model("riwayatPeminjamanModels");
		$query = "SELECT * FROM riwayatPeminjaman WHERE noBuku = '$no' and kodeTransaksi = '$kode' ";


		echo json_encode($riwayatPeminjamanModel->getRiwayatPeminjamanModel($query)[0]);	

	}

	public function setuju () {
		$Pengembalian = $this->model("riwayatPengembalianModels");
		if ( $Pengembalian->insert($_POST) >= 0 ) {
			flasher::setFLash("Pengembalian Berhasil","dilakukan","success");
			header("location: http://localhost/perpus/transaksiPengembalian/formulirPengembalianBuku");
			exit;

		}
		else {
			flasher::setFLash("Pengembalian Gagal","dilakukan","danger");
			header("location: http://localhost/perpus/transaksiPengembalian/formulirPengembalianBuku");
			exit;

		}
	}

	public function riwayatPengembalianBuku ($dataUrl = []) {
		$data["pilihan"] = "transaksiPengembalian";
		$buku = $this->model("bukuModels");



		// mengetahui apa yang di searching
		if ( isset($_POST["searchPengembalian"])  ) {
			$_SESSION["keyPengembalian"] = $_POST["keywordPengembalian"];
			$key = $_SESSION["keyPengembalian"];
		} else if ( isset($_SESSION["keyPengembalian"]) ) { $key = $_SESSION["keyPengembalian"]; }
		else {
			$key = "";
		}

		if ( isset($_POST["limitPengembalian"])) {
			// jdp = jumlah data per halaman
			$_SESSION["jdpsPengembalian"] = $_POST["limitPengembalian"];
			$jdp = $_SESSION["jdpsPengembalian"];
		} else if ( isset($_SESSION["jdpsPengembalian"]) ) { $jdp = $_SESSION["jdpsPengembalian"]; }
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
		$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM riwayatPengembalian	"));
		if ( isset(	$_SESSION["keyPengembalian"] ) ) {
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku INNER JOIN riwayatPengembalian ON buku.no = riwayatPengembalian.noBuku INNER JOIN siswa ON riwayatPengembalian.kodeTransaksi = siswa.cookie WHERE kodeTransaksi LIKE '%$key%' || nama LIKE '%$key%' || kelas LIKE '%$key%' || judul LIKE '%$key%' || kondisiBuku like '%$key%' || tanggalPeminjaman LIKE '%$key%' || tanggalPengembalian LIKE '%$key%' || status = '%$key%' || sanksi = '%$key%' "));
			
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




		$query = "SELECT * FROM buku INNER JOIN riwayatPengembalian ON buku.no = riwayatPengembalian.noBuku INNER JOIN siswa ON riwayatPengembalian.kodeTransaksi = siswa.cookie WHERE kodeTransaksi LIKE '%$key%' || nama LIKE '%$key%' || kelas LIKE '%$key%' || judul LIKE '%$key%' || kondisiBuku like '%$key%' || tanggalPeminjaman LIKE '%$key%' || tanggalPengembalian LIKE '%$key%' || status = '%$key%' || sanksi = '%$key%'  ORDER BY urutan DESC LIMIT $am,$jdp";
		$data["riwayatPengembalianBuku"] = $buku->getBukuModel($query);


		$this->view("admin/templates/header",$data);
		$this->view("admin/transaksiPengembalian/riwayatPengembalianBuku",$data);
		$this->view("admin/templates/footer");
	}


}
