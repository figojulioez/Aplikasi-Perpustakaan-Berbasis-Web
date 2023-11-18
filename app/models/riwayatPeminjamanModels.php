<?php 

class riwayatPeminjamanModels {
	public $riwayatPeminjamanModel = [];


	public function conn () {
		$conn = mysqli_connect("localhost","root","","perpus");
		return $conn;
	}

	public function getRiwayatPeminjamanModel ($query = "SELECT * FROM riwayatPeminjaman") {


		$q = mysqli_query($this->conn(),$query);

		while ( $rows = mysqli_fetch_assoc($q) ) {
			$this->riwayatPeminjamanModel[] = $rows;
		}

		return $this->riwayatPeminjamanModel;
	}

	public function insert ($data) {
		


		$query = "SELECT * FROM siswa INNER JOIN praPeminjaman ON siswa.cookie = praPeminjaman.kodePraPeminjaman INNER JOIN buku ON praPeminjaman.noBuku = buku.no WHERE noBuku = '$data' ";
		$kode = mysqli_query($this->conn(),$query);
		$kode = mysqli_fetch_assoc($kode);

		if ( $kode["jumlahBuku"] == $kode["bukuDipinjam"] ) {
			return -1;
		}


		date_default_timezone_set('Asia/Jakarta');
		$nis = $kode["nis"];
		$kodeTransaksi = $kode["cookie"];
		$nama = $kode["nama"];
		$judulBuku = $kode["judul"];
		$tanggalPeminjaman = date("d-m-Y");
		$tanggalPengembalian = date("d-m-Y",time()+3600 * 24 * 3);
		$noBuku = $kode["noBuku"];
		$bukuDipinjam = $kode["bukuDipinjam"] + 1;
		$isiPesanUser = "Anda Berhasil Melakukan Transaksi Peminjaman Buku, Harap mengembalikan buku sebelum batas waktu yang ditentukan";
		$isiPesanAdmin = "Siswa Berhasil Melakukan Transaksi Peminjaman";

		mysqli_query($this->conn(),"INSERT INTO riwayatPeminjaman VALUES ('$kodeTransaksi','$nama','$judulBuku','$tanggalPeminjaman','$tanggalPengembalian','$noBuku','$nis','0','','O')");

		mysqli_query($this->conn(),"UPDATE buku SET bukuDipinjam = '$bukuDipinjam' WHERE no = '$noBuku'");

		mysqli_query($this->conn(),"DELETE FROM praPeminjaman WHERE nis = '$nis' AND noBuku = '$noBuku' ");

		mysqli_query($this->conn(),"INSERT INTO pesanUser VALUES ('$nis','$isiPesanUser','$tanggalPeminjaman','belum','') ");

		mysqli_query($this->conn(),"INSERT INTO pesanAdmin VALUES ('$nis','$isiPesanAdmin','$tanggalPeminjaman','belum','') ");



		return mysqli_affected_rows($this->conn());

	}





}