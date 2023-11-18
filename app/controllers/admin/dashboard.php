<?php 

class dashboard extends controller{
	public function __construct () {

		// Jika belum login maka jangan biarkan user masuk
		if ( !isset($_SESSION["klien"]) && !isset($_SESSION["identitas"]) && isset($_SESSION["login"]) ) {
			header("location: http://localhost/perpus/masuk");
			exit;
		}
	}

	public function index ($dataUrl = []) {
		$data["pilihan"] = "dashboard";
		$conn = mysqli_connect("localhost","root","","perpus");
		$pesanAdminModel = $this->model("pesanAdminModels");
		$data["jumlahPengembalian"] = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM riwayatPengembalian"));
		$data["jumlahPeminjaman"] = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM riwayatPeminjaman"));

		$data["jumlahBuku"] = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku"));
		$data["jumlahSiswa"] = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM siswa")) - 1;
		$query = "SELECT * FROM pesanAdmin ORDER BY urutan DESC LIMIT 5";



		$data["pesan"] = $pesanAdminModel->getPesanAdminModel($query);
		


		$this->view("admin/templates/header",$data);
		$this->view("admin/dashboard/index",$data);
		$this->view("admin/templates/footer");
	}

}