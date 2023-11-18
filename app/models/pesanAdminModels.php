<?php 

class pesanAdminModels {
	public $pesanAdminModel = [];


	public function conn () {
		$conn = mysqli_connect("localhost","root","","perpus");
		return $conn;
	}

	public function getPesanAdminModel ($query = "SELECT * FROM pesanAdmin") {


		$q = mysqli_query($this->conn(),$query);

		while ( $rows = mysqli_fetch_assoc($q) ) {
			$this->pesanAdminModel[] = $rows;
		}

		return $this->pesanAdminModel;
	}
}