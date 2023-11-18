<?php 

class flasher {

	// buat method untuk menyetel flashnya
	public static function setFlash ($pesan, $aksi, $tipe) {
		// $pesan == berhasil / gagal
		// $aksi == ditambahkan, diubah, dihapus
		// $tipe == merah untuk gagal, hijau untuk berhasil
		$_SESSION["flash"] = 
		[
			"pesan" => $pesan,
			"aksi" => $aksi,
			"tipe" => $tipe
		];

	}
	// buat method untuk menampilkan flashnya
	public static function flash () {
		if ( isset($_SESSION["flash"]) ) {
			echo '
			<div class="alert alert-' . $_SESSION["flash"]["tipe"] . ' alert-dismissible fade show" role="alert">
 				<strong>' . $_SESSION["flash"]["pesan"] . ' </strong>' . $_SESSION["flash"]["aksi"] . '
  				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
			unset($_SESSION["flash"]);
		}
	}




}


