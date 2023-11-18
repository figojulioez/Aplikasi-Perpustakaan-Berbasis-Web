<?php 

class laporan extends controller{
	public function __construct () {

		// Jika belum login maka jangan biarkan user masuk
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
		}


	}	public function riwayatPeminjaman () {
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
		if ( isset(	$_SESSION["keyR"] ) ) {
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM riwayatPeminjaman WHERE kodeTransaksi LIKE '%$key%' || nama LIKE '%$key%' || judulBuku LIKE '%$key%' || tanggalPeminjaman LIKE '%$key%' || tanggalPengembalian LIKE '%$key%'"));
			
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


		$query = "SELECT * FROM riwayatPeminjaman WHERE kodeTransaksi LIKE '%$key%' || nama LIKE '%$key%' || judulBuku LIKE '%$key%' || tanggalPeminjaman LIKE '%$key%' || tanggalPengembalian LIKE '%$key%' ORDER BY urutan DESC LIMIT $am,$jdp ";
		$data["riwayatPeminjaman"] = $riwayatPeminjamanModel->getRiwayatPeminjamanModel($query);

		$this->view("admin/laporan/header");
		$this->view("admin/laporan/laporanRiwayatPeminjaman",$data);
		$this->view("admin/laporan/footer");


	}

	public function riwayatPengembalian () {
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
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku INNER JOIN riwayatPengembalian ON buku.no = riwayatPengembalian.noBuku INNER JOIN siswa ON riwayatPengembalian.kodeTransaksi = siswa.cookie WHERE kodeTransaksi LIKE '%$key%' || nama LIKE '%$key%' || kelas LIKE '%$key%' || judul LIKE '%$key%' || denda LIKE '%$key%' || kondisiBuku like '%$key%' || tanggalPengembalian LIKE '%$key%'"));
			
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




		$query = "SELECT * FROM buku INNER JOIN riwayatPengembalian ON buku.no = riwayatPengembalian.noBuku INNER JOIN siswa ON riwayatPengembalian.kodeTransaksi = siswa.cookie WHERE kodeTransaksi LIKE '%$key%' || nama LIKE '%$key%' || kelas LIKE '%$key%' || judul LIKE '%$key%' || denda LIKE '%$key%' || kondisiBuku like '%$key%' || tanggalPengembalian LIKE '%$key%' ORDER BY urutan DESC LIMIT $am,$jdp";
		$data["riwayatPengembalianBuku"] = $buku->getBukuModel($query);

		$this->view("admin/laporan/header");
		$this->view("admin/laporan/laporanRiwayatPengembalian",$data);
		$this->view("admin/laporan/footer");

	}
}