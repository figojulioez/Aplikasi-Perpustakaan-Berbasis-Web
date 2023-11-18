<?php 

class daftarModels {
	public $daftarBukuModel = [];

	public function conn () {
		$conn = mysqli_connect("localhost","root","","perpus");
		return $conn;
	}

	public function getDaftarModel ($query = "SELECT * FROM daftarBuku") {


		$q = mysqli_query($this->conn(),$query);

		while ( $rows = mysqli_fetch_assoc($q) ) {
			$this->daftarBukuModel[] = $rows;
		}

		return $this->daftarBukuModel;
	}

	public function insert ($data) {
		$judul = $data["judulBuku"];
		$nis = htmlspecialchars($data["nis"]);
		$gambar = htmlspecialchars($data["inputGambarBuku"]);
		$noBuku = htmlspecialchars($data["noBuku"]);

		// cek nis
		$query = mysqli_query($this->conn(),"SELECT * FROM daftarBuku WHERE namaBuku = '$judul' AND nis = '$nis'"); 
		if ( mysqli_num_rows($query) ) {
			return "sudah";
		}

		$query = mysqli_query($this->conn(),"SELECT * FROM daftarBuku WHERE nis = '$nis'"); 
		if ( mysqli_num_rows($query) >= 3 ) {
			return "batas";
			die;
		}

		$query = mysqli_query($this->conn(),"SELECT * FROM praPeminjaman WHERE nis = '$nis'");
		if ( mysqli_num_rows($query) ) {
			return "p";
		}

		$query = mysqli_query($this->conn(),"SELECT * FROM riwayatPeminjaman WHERE nis = '$nis'");
		if ( mysqli_num_rows($query) ) {
			return "tidak";
		}


		$query = "INSERT INTO daftarBuku VALUES ('','$judul','$nis','$gambar','$noBuku')";

		mysqli_query($this->conn(),$query);

		return mysqli_affected_rows($this->conn());

	}

	public function delete ($data) {
		$query = mysqli_query($this->conn(),"SELECT * FROM daftarBuku WHERE nis = '$data'");
		

		if ( mysqli_num_rows($query) == 0 ) {
			return "kosong";
		} else {




			mysqli_query($this->conn(),"DELETE FROM daftarBuku WHERE nis = '$data'");



			return mysqli_affected_rows($this->conn());
		}
	}


}