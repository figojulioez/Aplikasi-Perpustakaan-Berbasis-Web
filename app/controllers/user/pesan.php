<?php 

class pesan extends controller {
	public function __construct () {

		// Jika belum login maka jangan biarkan user masuk
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
			}
			$nis = $_SESSION["identitas"]["nis"];
			$conn = mysqli_connect("localhost","root","","perpus");
			if ( isset($_SESSION["isiPesanUser"]) ) {
				unset($_SESSION["isiPesanUser"]);

				$query = "UPDATE pesanUser SET keterangan = 'sudah' WHERE keterangan = 'belum' AND nis = '$nis' ";
				$q = mysqli_query($conn,$query);

			}

		}

		public function index ($dataUrl = []) {
			$data["pilihan"] = "pesan";
			$pesanUserModel = $this->model("pesanUserModels");
			$nis = $_SESSION["identitas"]["nis"];



		// mengetahui apa yang di searching
		if ( isset($_POST["searchPesan"])  ) {
			$_SESSION["keyPesan"] = $_POST["keywordPesan"];
			$key = $_SESSION["keyPesan"];
		} else if ( isset($_SESSION["keyPesan"]) ) { $key = $_SESSION["keyPesan"]; }
		else {
			$key = "";
		}

			// menghitung jumlah data per halaman
		if ( isset($_POST["limitPesan"])) {
			// jdp = jumlah data per halaman
			$_SESSION["jdpPesan"] = $_POST["limitPesan"];
			$jdp = $_SESSION["jdpPesan"];
		} else if ( isset($_SESSION["jdpPesan"]) ) { $jdp = $_SESSION["jdpPesan"]; }
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
		$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pesanUser WHERE nis = '$nis'"));
		if ( isset($_SESSION["keyPesan"]) ) {
			$jm = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pesanUser  WHERE  (isiPesan LIKE '%$key%' || tanggalPengirim LIKE '%$key%') AND nis = '$nis'"));

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
		
			$query = "SELECT * FROM pesanUser  WHERE  (isiPesan LIKE '%$key%' || tanggalPengirim LIKE '%$key%') AND nis = '$nis' ORDER BY urutan DESC LIMIT $am,$jdp";



			$data["pesan"] = $pesanUserModel->getPesanUserModel($query);


			$this->view("user/templates/header",$data);
			$this->view("user/pesan/index",$data);
			$this->view("user/templates/footer");



		}
	}