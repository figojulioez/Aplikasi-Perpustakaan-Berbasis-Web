<?php 

class pesanUserModels {
	public $pesanUserModel = [];


	public function conn () {
		$conn = mysqli_connect("localhost","root","","perpus");
		return $conn;
	}

	public function getPesanUserModel ($query = "SELECT * FROM pesanUser") {


		$q = mysqli_query($this->conn(),$query);

		while ( $rows = mysqli_fetch_assoc($q) ) {
			$this->pesanUserModel[] = $rows;
		}

		return $this->pesanUserModel;
	}
}