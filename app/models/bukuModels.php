<?php

class bukuModels  {	
	public $bukuModel = [];

	public function conn () {
		$conn = mysqli_connect("localhost","root","","perpus");
		return $conn;
	}


	public function getBukuModel ($query = "SELECT * FROM buku") {


		$q = mysqli_query($this->conn(),$query);

		while ( $rows = mysqli_fetch_assoc($q) ) {
			$this->bukuModel[] = $rows;
		}

		return $this->bukuModel;
	}

	public function insert ($data,$file) {
		$judul = htmlspecialchars($data["judul"]);
		$pengarang = htmlspecialchars($data["pengarang"]);
		$bukuDipinjam = htmlspecialchars($data["bukuDipinjam"]);
		$jumlahBuku = htmlspecialchars($data["jumlahBuku"]);
		$sinopsis = htmlspecialchars($data["sinopsis"]);
		$jenisBuku = htmlspecialchars($data["jenisBuku"]);

		$gambar = $this->upload($file);

		// cek nis
		
		$query = "SELECT * FROM buku WHERE judul = '$judul' AND pengarang = '$pengarang'";
		$q = mysqli_query($this->conn(),$query);
		if ( mysqli_num_rows($q) > 0 ) {
			return "sudah";
		}

		if ( $jumlahBuku < 1 ) {
			return "kosong";
		}


		$query = "INSERT INTO buku VALUES ('','$judul','$pengarang','$gambar','$bukuDipinjam','$jumlahBuku','$sinopsis','$jenisBuku')";

		mysqli_query($this->conn(),$query);

		return mysqli_affected_rows($this->conn());

	}

	public function upload ($file) {
		$nama = $_FILES["gambar"]["name"];
		$tmpName = $_FILES["gambar"]["tmp_name"];
		$size = $_FILES["gambar"]["size"];
		$error = $_FILES["gambar"]["error"];

			// pisahkan ekstensi
		$ek = []; 
		$ek = explode(".", $nama);
		$ek = end($ek);

			// ekstensi yang di perbolehkan
		$eks = ["png","jpeg","jpg"];

			// cek ekstensi
		if ( !in_array($ek,$eks) ) {
			return false;
		} 
		
			// cek ukuran
		if ( !$size >  1000000) {
			return false;
		}

		// acak nama gambar agar tidak terjadi kesalahan
		$nama = uniqid();
		$nama .= ".";
		$nama .= $ek;

		// pindahkan lokasi
		move_uploaded_file($tmpName,"assets/img/" . $nama);

		return $nama;
	}

	public function delete ($link) {
		mysqli_query($this->conn(),"DELETE FROM buku WHERE no = '$link'");


		return mysqli_affected_rows($this->conn());
	}

	public function update ($data,$file) {
		$no = htmlspecialchars($data["no"]);
		$judul = htmlspecialchars($data["judul"]);
		$jenisBuku = htmlspecialchars($data["jenisBuku"]);
		$pengarang = htmlspecialchars($data["pengarang"]);
		$bukuDipinjam = htmlspecialchars($data["bukuDipinjam"]);
		$jumlahBuku = htmlspecialchars($data["jumlahBuku"]);
		$sinopsis = htmlspecialchars($data["sinopsis"]);


		$gambar = $this->upload($file);


		if( !$gambar ) {
		 $gambar = htmlspecialchars($data["gambarLama"]); }
		// cek nis

		 if ( $jumlahBuku < 1 ) {
			return "kosong";
		} 

		$query = "UPDATE buku SET sinopsis = '$sinopsis', judul = '$judul', jenisBuku = '$jenisBuku', jumlahBuku = '$jumlahBuku', pengarang = '$pengarang', gambarBuku='$gambar', bukuDipinjam = '$bukuDipinjam' WHERE no = '$no' ";

		mysqli_query($this->conn(),$query);

		return mysqli_affected_rows($this->conn());

	}



}