<?php 
class riwayatPengembalianModels {
	public $riwayatPengembalianModel = [];


	public function conn () {
		$conn = mysqli_connect("localhost","root","","perpus");
		return $conn;
	}

	public function getRiwayatPengembalianModel ($query = "SELECT * FROM riwayatPengembalian") {


		$q = mysqli_query($this->conn(),$query);

		while ( $rows = mysqli_fetch_assoc($q) ) {
			$this->riwayatPengembalianModel[] = $rows;
		}

		return $this->riwayatPengembalianModel;
	}

	public function insert ($data) {
		$kodeTransaksi = $data["kodeTransaksi"];
		$kondisiBuku = $data["kondisiBuku"];
		$noBuku = $data["noBuku"];
		$denda = $data["dendaz"];
		$tanggal = date("d-m-Y");
		$isiPesanUser = "Anda Berhasil Melakukan Transaksi Pengembalian Buku";
		$isiPesanAdmin = "Siswa Berhasil Melakukan Transaksi Pengembalian Buku";
		$query = mysqli_query($this->conn(),"SELECT * FROM siswa WHERE cookie = '$kodeTransaksi'");
		$f = mysqli_fetch_assoc($query);
		$nis = $f["nis"];

		$queryBuku = mysqli_query($this->conn(),"SELECT * FROM buku WHERE no = '$noBuku'");
		$fetch = mysqli_fetch_assoc($queryBuku);
			
		$jumlahBuku = $fetch["bukuDipinjam"] - 1;	
		$tanggalPeminjaman = mysqli_query($this->conn(),"SELECT * FROM riwayatPeminjaman WHERE kodeTransaksi = '$kodeTransaksi' AND noBuku = '$noBuku'");
		$a = mysqli_fetch_assoc($tanggalPeminjaman);
		$tanggalPengembalian = 	$a["tanggalPengembalian"];
		$tanggalPeminjaman	= $a["tanggalPeminjaman"];

		if ( $a["status"] == 'O' ) {
			$status = "On Time";
		} else {
			$status = "Telat";
		}

		if ( $denda > 0  ) {
			
			$sanksi = "Denda";
		} else {
			
			$sanksi = "-";
		}
		mysqli_query($this->conn(),"UPDATE buku SET bukuDipinjam = '$jumlahBuku' WHERE no = '$noBuku'");
		mysqli_query($this->conn(),"INSERT INTO riwayatPengembalian VALUES ('$kodeTransaksi','$noBuku','$denda','$tanggal','$kondisiBuku','','$tanggalPeminjaman','$status','$sanksi')");
		mysqli_query($this->conn(),"DELETE FROM riwayatPeminjaman WHERE kodeTransaksi = '$kodeTransaksi' AND noBuku = '$noBuku'");

		mysqli_query($this->conn(),"INSERT INTO pesanUser VALUES ('$nis','$isiPesanUser','$tanggal','belum','') ");
		mysqli_query($this->conn(),"INSERT INTO pesanAdmin VALUES ('$nis','$isiPesanAdmin','$tanggal','belum','') ");

		return mysqli_affected_rows($this->conn());





	}
}