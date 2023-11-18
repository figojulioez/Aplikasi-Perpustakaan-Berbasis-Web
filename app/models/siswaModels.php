<?php 

class siswaModels {
	private $siswaModel = [];

	public function conn () {
		$conn = mysqli_connect("localhost","root","","perpus");
		return $conn;
	}

	public function getSiswaModel ($query = "SELECT * FROM siswa") {


		$q = mysqli_query($this->conn(),$query);

		while ( $rows = mysqli_fetch_assoc($q) ) {
			$this->siswaModel[] = $rows;
		}

		return $this->siswaModel;
	}

	public function insert ($data,$file) {
		$nis = htmlspecialchars($data["nis"]);
		$nama = htmlspecialchars($data["nama"]);
		$kelas = htmlspecialchars($data["kelas"]);
		$noTelp = htmlspecialchars($data["noTelp"]);



		$gambar = $this->upload($file);

		// cek nis
		$query = mysqli_query($this->conn(),"SELECT * FROM siswa WHERE nis = '$nis'"); 
		if ( mysqli_num_rows($query) ) {
			return "nis";
		}

		$cookie = uniqid();


		$query = "INSERT INTO siswa VALUES ('$nis','$nama','$kelas','$nis','$noTelp','$gambar','$cookie','U')";

		mysqli_query($this->conn(),$query);

		return mysqli_affected_rows($this->conn());

	}

	public function upload ($file) {
		$nama = $file["gambar"]["name"];
		$tmpName = $file["gambar"]["tmp_name"];
		$size = $file["gambar"]["size"];
		$error = $file["gambar"]["error"];
			// pisahkan ekstensi


		if ( $error === 4 )  {
			return false;
		} 


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

	public function update ($data) {
		$nis = htmlspecialchars($data["nis"]);
		$nama = htmlspecialchars($data["nama"]);
		$kelas = "";

		if ( isset($data["kelas"]) ) {
			$kelas = htmlspecialchars($data["kelas"]);	
		}
		$noTelp = htmlspecialchars($data["noTelp"]);
		$password = htmlspecialchars($data["password"]);
		$nisLama = htmlspecialchars($data["nisLama"]);


		$gambar = $this->upload($_FILES);
		if ( $gambar == false ) {
			$gambar = htmlspecialchars($data["gambarLama"]);
		}

		

		// cek nis

		$query = "UPDATE siswa SET nis = '$nis', nama = '$nama', kelas = '$kelas', password = '$password', noTelp = '$noTelp', gambar='$gambar' WHERE nis = '$nisLama' ";
		mysqli_query($this->conn(),$query);

		$query = "SELECT * FROM siswa WHERE nis = '$nis'";
		$q = mysqli_query($this->conn(),$query);
		$f = mysqli_fetch_assoc($q);
		$_SESSION["identitas"] = $f;
		return mysqli_affected_rows($this->conn());

	}

	public function updateAkun ($data) {

		$nis = htmlspecialchars($data["nis"]);
		$nama = htmlspecialchars($data["nama"]);
		$kelas = htmlspecialchars($data["kelas"]);	
		$noTelp = htmlspecialchars($data["noTelp"]);
		$password = htmlspecialchars($data["password"]);
		$nisLama = htmlspecialchars($data["nisLama"]);

		$gambar = htmlspecialchars($data["gambarLama"]);

		// cek nis

		$query = "UPDATE siswa SET nis = '$nis', nama = '$nama', kelas = '$kelas', password = '$password', noTelp = '$noTelp', gambar='$gambar' WHERE nis = '$nisLama' ";
		mysqli_query($this->conn(),$query);

		return mysqli_affected_rows($this->conn());

	}


	public function delete ($link) {
		mysqli_query($this->conn(),"DELETE FROM siswa WHERE nis = '$link'");


		return mysqli_affected_rows($this->conn());
	}



}

