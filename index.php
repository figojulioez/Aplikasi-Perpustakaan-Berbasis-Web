<?php 
require_once "app/init.php";

date_default_timezone_set('Asia/Jakarta');
$waktuTenggat = date("d");
$conn = mysqli_connect("localhost","root","","perpus");
$tanggalPengembalian = date('d-m-Y');


// praPeminjaman
if ( isset($_SESSION["identitas"]["nis"]) ) {
	$nis = $_SESSION["identitas"]['nis'];
	$batas = mysqli_query($conn,"SELECT nis FROM praPeminjaman WHERE waktuTenggat = '$waktuTenggat'");

	if ( mysqli_num_rows($batas) > 0 ) {
	// pesan praPeminjaman
		$batas = mysqli_fetch_assoc($batas);
		$niss = $batas["nis"];
		$isiPesanUser = "Pra peminjaman anda sudah melewati batas waktu yang di tentukan, maka akan otomatis terhapus";
		mysqli_query($conn,"INSERT INTO pesanUser VALUES ('$niss','$isiPesanUser','$tanggalPengembalian','belum','')");
		$query = "DELETE FROM praPeminjaman WHERE waktuTenggat = '$waktuTenggat'";
		$q = mysqli_query($conn,$query);	
	}

}

// update data profil
if ( isset($_SESSION['identitas']['nis']) ) {
	$q = mysqli_query($conn,"SELECT * FROM siswa WHERE nis = '$nis'");
	$f = mysqli_fetch_assoc($q);
	$_SESSION["identitas"] = $f;
}





// denda 
if ( isset($_SESSION["identitas"]["nis"]) ) {

	$query = "SELECT * FROM riwayatPeminjaman WHERE tanggalPengembalian = '$tanggalPengembalian' and denda = 0";
	$q = mysqli_query($conn,$query);
	if ( mysqli_num_rows($q) > 0 ) {

		
		
		while ( $f = mysqli_fetch_assoc($q) ) {	
			$nisSiswa = $f["nis"];
			$isiPesanUser = "Batas waktu peminjaman anda telah habis, dikenakan denda";
			mysqli_query($conn,"INSERT INTO pesanUser VALUES ('$nisSiswa','$isiPesanUser','$tanggalPengembalian','belum','')");
		}

		$query = "UPDATE riwayatPeminjaman SET denda = '5000', status = 'T'  WHERE tanggalPengembalian = '$tanggalPengembalian' AND kodeTransaksi";
		$q = mysqli_query($conn,$query);

		$isiPesanAdmin = "Batas waktu peminjaman siswa telah habis, dikenakan denda";

		mysqli_query($conn,"INSERT INTO pesanAdmin VALUES ('$nis','$isiPesanAdmin','$tanggalPengembalian','belum','') ");
	}
	
}


// Notifikasi pesan belum terbaca user
if ( isset($_SESSION["identitas"]["nis"]) ) {

	$nis = $_SESSION["identitas"]["nis"];
	$query = "SELECT * FROM pesanUser WHERE nis = '$nis' AND keterangan = 'belum' ";
	$q = mysqli_query($conn,$query);

	if ( mysqli_num_rows($q) ) {
		$_SESSION["isiPesanUser"] = mysqli_num_rows($q);
	}
}

// Notifikasi pesan belum terbaca admin
if ( isset($_SESSION["identitas"]["nis"]) ) {

	$query = "SELECT * FROM pesanAdmin WHERE keterangan = 'belum' ";
	$q = mysqli_query($conn,$query);

	if ( mysqli_num_rows($q) ) {
		$_SESSION["isiPesanAdmin"] = mysqli_num_rows($q);
	}
}

// Notifikasi Prapeminjaman
if ( isset($_SESSION["identitas"]["nis"]) ) {

	$query = "SELECT * FROM praPeminjaman";
	$q = mysqli_query($conn,$query);

	if ( mysqli_num_rows($q) > 0 ) {
		$_SESSION["praPeminjaman"] = mysqli_num_rows($q);
	} else {
		unset($_SESSION["praPeminjaman"]);
	}
}

// riwayatPeminjaman

// class app 
$app = new app();
$controller = new controller();







