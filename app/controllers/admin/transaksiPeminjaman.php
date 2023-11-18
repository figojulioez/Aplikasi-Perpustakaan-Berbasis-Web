<?php 

class transaksiPeminjaman extends controller{
	public function __construct () {

		// Jika belum login maka jangan biarkan user masuk
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
		}




	}

	public function formulirPeminjamanBuku ($dataUrl = []) {
		$praPeminjaman = $this->model("praPeminjamanModels");
		$daftarBuku = $this->model("daftarModels");
		$data["pilihan"] = "transaksiPeminjaman";
		$conn = mysqli_connect("localhost","root","","perpus");


		if ( isset($_POST["search"])  ) {
			$_SESSION["keyFormulir"] = $_POST["keyFormulir"];
			$key = $_SESSION["keyFormulir"];
		} else if ( isset($_SESSION["keyFormulir"]) ) { $key = $_SESSION["keyFormulir"]; }
		else {
			$key = "";
		}





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
		$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM praPeminjaman"));
		if (  isset($_SESSION["keyFormulir"])) {
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM praPeminjaman INNER JOIN siswa ON praPeminjaman.nis = siswa.nis WHERE kodePraPeminjaman LIKE '%$key%' || nama LIKE '%$key%'"));
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

		$_SESSION["na"] = $nomorAwal;
		$_SESSION["nr"] = $nomorAkhir;
		$_SESSION["hf"] = $hf;
		$_SESSION["jp"] = $jp;
		// hal-hal yang akan dibutuhkan






		$bukuModels = $this->model("bukuModels");
		$query = "SELECT * FROM praPeminjaman INNER JOIN siswa ON praPeminjaman.nis = siswa.nis WHERE kodePraPeminjaman LIKE '%$key%' || nama LIKE '%$key%' ORDER BY urutan DESC LIMIT $am, $jdp";
		$data["praPeminjaman"] = $praPeminjaman->getPraPeminjamanModel($query);



		$this->view("admin/templates/header",$data);
		$this->view("admin/transaksiPeminjaman/formulirPeminjamanBuku",$data);
		$this->view("admin/templates/footer");




	}


	public function informasi () {
		$no = $_POST["no"];
		$query = "SELECT * FROM buku WHERE no = '$no'";
		$bukuModels = $this->model("bukuModels");


		echo json_encode($bukuModels->getBukuModel($query)[0]);
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

		$this->view("admin/templates/header",$data);
		$this->view("admin/transaksiPeminjaman/riwayatPeminjamanBuku",$data);
		$this->view("admin/templates/footer");
	}

	public function hapusPraPeminjaman ($link = []) {
		$praPeminjaman = $this->model("praPeminjamanModels");
		if ( $praPeminjaman->delete($link,"admin") >= 0 ) {
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

	public function setuju ($link) {
		$riwayatPeminjaman = $this->model("riwayatPeminjamanModels");
		if ( $riwayatPeminjaman->insert($link[0]) >= 0 ) {
			flasher::setFLash("Peminjaman Berhasil","dilakukan","success");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;

		}
		else {
			flasher::setFLash("Peminjaman Gagal","dilakukan","danger");
			header("location: http://localhost/perpus/transaksiPeminjaman/formulirPeminjamanBuku");
			exit;

		}	
	}

}