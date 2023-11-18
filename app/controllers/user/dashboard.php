<?php 

class dashboard extends controller{
	public function __construct () {

		// Jika belum login maka jangan biarkan user masuk
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
		}
	}

	public function index ($data = []) {
		$data["pilihan"] = "dashboard";
		$conn = mysqli_connect("localhost","root","","perpus");
		$nis = $_SESSION["identitas"]["nis"];
		$pesanUserModel = $this->model("pesanUserModels");
		$cookie = $_SESSION["identitas"]["cookie"];


		$data["jumlahPeminjaman"] = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM riwayatPeminjaman WHERE kodeTransaksi = '$cookie'"));
		$data["jumlahPengembalian"] = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM riwayatPengembalian WHERE kodeTransaksi = '$cookie'"));
		$data["jumlahBuku"] = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku"));
		$data["jumlahPesan"] = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pesanUser WHERE nis = '$nis' "));;
		$query = "SELECT * FROM pesanUser  WHERE  nis = '$nis' ORDER BY urutan DESC LIMIT 5";



		$data["pesan"] = $pesanUserModel->getPesanUserModel($query);


		$this->view("user/templates/header",$data);
		$this->view("user/dashboard/index",$data);
		$this->view("user/templates/footer");
	}

}