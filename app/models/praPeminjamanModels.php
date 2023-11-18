<?php 

class praPeminjamanModels {
	public $praPeminjamanModel = [];


	public function conn () {
		$conn = mysqli_connect("localhost","root","","perpus");
		return $conn;
	}

	public function getPraPeminjamanModel ($query = "SELECT * FROM praPeminjaman") {


		$q = mysqli_query($this->conn(),$query);

		while ( $rows = mysqli_fetch_assoc($q) ) {
			$this->praPeminjamanModel[] = $rows;
		}

		return $this->praPeminjamanModel;
	}

	public function insert ($data) {
		
		$query = "SELECT * FROM daftarBuku INNER JOIN buku  ON daftarBuku.noBuku = buku.no WHERE nis = '$data'";
		

		$q = mysqli_query($this->conn(),$query);


		if ( mysqli_num_rows($q) === 0 ) {
			return "kosong";
		}


		$q = mysqli_query($this->conn(),$query);

		$query = mysqli_query($this->conn(), "SELECT * FROM praPeminjaman WHERE nis = '$data'");



		if ( mysqli_num_rows($query) ) {
			return -1;
		}

		$query = "SELECT cookie FROM siswa WHERE nis = '$data'";
		$kode = mysqli_query($this->conn(),$query);
		$kode = mysqli_fetch_assoc($kode);



		while ( $f = mysqli_fetch_assoc($q) ) {
			date_default_timezone_set('Asia/Jakarta');
			$nis = $f["nis"];
			$kodePraPeminjaman = $kode["cookie"];
			$waktuTenggat = date("d",time()+3600*24*2);
			$tanggal = date('d-m-Y');
			$noBuku = $f["noBuku"];
			$isiPesanUser = "Pra peminjaman berhasil dilakukan, Pesanan anda akan otomatis terhapus apabila sudah melewati jangka waktu 1 hari tanpa menerima persetujuan dari admin";

			$isiPesanAdmin = "Siswa berhasil melakukan Pra Peminjaman";

			mysqli_query($this->conn(),"INSERT INTO praPeminjaman VALUES ('$nis','$kodePraPeminjaman','$waktuTenggat','$noBuku','')");
		}
		mysqli_query($this->conn(),"INSERT INTO pesanUser VALUES ('$nis','$isiPesanUser','$tanggal','belum','') ");
		mysqli_query($this->conn(),"INSERT INTO pesanAdmin VALUES ('$nis','$isiPesanAdmin','$tanggal','belum','') ");


		mysqli_query($this->conn(),"DELETE FROM daftarBuku WHERE nis = '$data'");


		return mysqli_affected_rows($this->conn());

	}

	public function delete ($link = [],$akun = "user") {
		$noBuku = $link[0];
		$nis = $link[1];
		$tanggal = date("d-m-Y");


		mysqli_query($this->conn(),"DELETE FROM praPeminjaman WHERE noBuku = '$noBuku' AND nis = '$nis' ");
		if ( $akun == "admin" ) {
			$isiPesanUser = "Transaksi Pra Peminjaman anda tidak disetujui oleh Admin";
			mysqli_query($this->conn(),"INSERT INTO pesanUser VALUES ('$nis','$isiPesanUser','$tanggal','belum','') ");
		}

		return mysqli_affected_rows($this->conn());
	}


}