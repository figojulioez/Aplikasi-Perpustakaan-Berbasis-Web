	<?php 

function pilihan ($data,$pil) {
	if ( $data == $pil ) {
		return "w3-blue";
	}
}

function baseUrl () {
	return "http://localhost/perpus";
}


 function judul($nis) {
		$conn = mysqli_connect("localhost","root","","perpus");

		$query2 = "SELECT * FROM buku WHERE no = '$nis'";

		$query2 = mysqli_query($conn,$query2);
		$judul = "";
		$data["buku"] = mysqli_fetch_assoc($query2);
		$judul = $data["buku"]["judul"];

		return $judul;


		
	}