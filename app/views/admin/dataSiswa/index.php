<header class="w3-container mar">
	<h2 style="font-family: tahoma"><i class="fa-solid fa-users"></i>  Data Siswa</h2>
  	<span id="tanggal">Senin, 8 oktober 2022</span> 
</header>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px; padding: 0 3px">

  <div id="content" class="border border-2 p-3 bg-white">
      <div class="d-flex justify-content-between mb-3">

       <!--  <h4>Data Siswa</h4> -->
          <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" id="tambah">
          <i class="fa fa-plus"></i>
          Tambah Siswa
        </button> 
      </div>
      <div class="d-flex justify-content-between align-items-center">
      <form acction="" method="post">
        <p class=" d-flex" style="width: 290px;">
          <span>Tampilkan</span>
          <select id="tamp" class="form-select form-select-sm w-25 mb-3 mx-2" aria-label=".form-select-lg example" name="limit">
          <option <?php echo (isset($_SESSION["jdps"]) && $_SESSION["jdps"] ==10 )? "selected":"" ;?>>10</option>
          <option <?php echo (isset($_SESSION["jdps"]) && $_SESSION["jdps"] == 25)? "selected":"" ;?>>25</option>
          <option <?php echo (isset($_SESSION["jdps"]) && $_SESSION["jdps"] == 50)? "selected":"" ;?>>50</option>
          <option <?php echo (isset($_SESSION["jdps"]) && $_SESSION["jdps"] == 100)? "selected":"" ;?>>100</option>
        </select> entri
        </p>
        <button style="display: none" name="entri" id="btnTamp"></button>
        </form>
        <div class="input-group input-group-sm mb-3" style="width: 200px;" id="input">
          <form action="" method="post">
          <!-- <span class="input-group-text" id="inputGroup-sizing-sm">Small</span> -->
          <label style="margin-right: 4px;">Pencarian : </label>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="keyword" id="keyword"
          value="<?php echo (isset($_SESSION['keyTambah'])? $_SESSION['keyTambah'] : '') ;?>"
          >
          <button type="submit" name="search" id="search" style="display: none;"></button>
          </form>
        </div>
      </div>
      <?php flasher::flash(); ?>

      <div style="overflow-x: auto" id="table"></div>
        <table class="table table-bordered" align="center">
          <tr>
            <td>Nis</td>  
            <td>Gambar</td>
            <td>Nama</td>
            <td>Kelas<i></i></td>
            <td>No Telp</td>
            <td>Aksi</td>
          </tr>
<!-- Tampilkan Data Siswa dari database -->
<?php foreach ( $data["siswa"] as $siswa ) { ?>

          <tr class="bg-secondary">
            <td><?php echo $siswa["nis"]; ?> </td>
            <td><img src='<?php echo baseUrl() . "/assets/img/" . $siswa["gambar"]; ?>' height="50px"></td>
            <td><?php echo $siswa["nama"]; ?></td>
            <td><?php echo $siswa["kelas"]; ?> </td>
            <td><?php echo $siswa["noTelp"]; ?></td>
            <td class="d-flex justify-content-around">
              <span class="p-2 bg-info rounded" style="margin-right: 5px;">
                <a href="#" style="color:black" data-bs-toggle="modal" data-bs-target="#exampleModal" class="edit" data-nis="<?php echo $siswa['nis']; ?>"><i class="fa fa-edit m-auto"></i></a>  
              </span>
              <span class="p-2 bg-danger rounded">
                <a href="<?php echo baseUrl() . "/dataSiswa/hapus/". $siswa['nis']; ?>" style="color:black" class="hapus" data-nis="<?php echo $siswa['nis']; ?>" data-bs-toggle="modal" data-bs-target="#hapus">
                <i class="fa fa-trash m-auto"></i>
                </a>
              </span>
            </td>
          </tr>
<?php } ?> 
      </table>

      <div class="d-flex justify-content-between align-items-center mt-4">
        <div></div>
        <nav aria-label="...">
          <ul class="pagination">
<?php if ( $data["hf"] > 1 ) { ?>
            <li class="page-item">
              <a class="page-link text-black-50" href="<?php echo baseUrl().'/dataSiswa/index/page='. $data['hf']-1; ?>">Sebelumnya</a>
            </li>
<?php } ?>
<?php for ( $i = $data["na"]; $i <= $data["nr"]; $i++ ) { ?>
            <li class="page-item
            <?php echo ($i == $data['hf'])? 'active':''; ?>
            " aria-current="page">
              <a class="page-link text-black-50" href="<?php echo baseUrl().'/dataSiswa/index/page='. $i; ?>"><?php echo $i; ?></a>
            </li>
<?php } ?>
<?php if ( $data["hf"] < $data["jp"] ) { ?>
            <li class="page-item">
              <a class="page-link text-black-50" href="<?php echo baseUrl().'/dataSiswa/index/page='. $data['hf']+1; ?>">Selanjutnya</a>
            </li>
<?php } ?>
          </ul>
      </nav>
      </div>
</div>
  <!-- End page content -->
</div>

<!-- Modal -->
<form action="<?php echo baseUrl() . '/dataSiswa/tambahSiswa';?>" method="post" enctype="multipart/form-data" id="modal">
<input type="hidden" name="gambarLama" id="gambarLama">
<input type="hidden" name="password" id="password">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #18dd18;">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nis :</label>
          <input type="text" class="form-control" id="nis" placeholder="Nis" name="nis" required>
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Gambar</label>
          <input class="form-control" type="file" id="gambar" name="gambar">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nama :</label>
          <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" required maxlength="50">
        </div>  
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Kelas :</label>
          <input type="text" class="form-control" id="kelas" placeholder="Kelas" name="kelas" required>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">No Telepon :</label>
          <input type="text" class="form-control" id="noTelp" placeholder="No Telepon" name="noTelp" required>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="nisLama" id="nisLama">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary" name="btn">Tambah Data</button>
      </div>
    </div>
  </div>
</div>
</form>
</div>

<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Apakah anda yakin menghapus item ini?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-times fa-spin fa-4x" style="--fa-animation-duration: 3s; --fa-animation-iteration-count: 5;--fa-animation-timing: ease-in;"></i>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="" id="btnHapus" class="btn  btn-outline-success">Yes</a>
        <a type="button" class="btn  btn-danger waves-effect" data-bs-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>








<script type="text/javascript">
  // Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


const select = document.querySelector("select#tamp");
select.addEventListener("change", function () {
  const btnTamp = document.getElementById("btnTamp");
  btnTamp.click();
});

$(document).ready(function () {
  $("#tambah").on("click", function () {
    $("#exampleModalLabel").html("Tambah siswa");
    $(".modal-footer button[type=submit]").html("Tambah Data");
    var d = document.getElementById("modal");
    d.setAttribute("action","http://localhost/perpus/dataSiswa/tambahSiswa");


     divPassword.style.display = "none";
     divCpassword.style.display = "none";
        $('#nama').val("");
        $('#nis').val("");
        $('#kelas').val("");
        $('#password').val("");
        $('#noTelp').val("");
        $('#cpassword').val("");
        $('#gambarLama').val("");


  });



  $(".edit").on("click", function () {
    $("#exampleModalLabel").html("Ubah Data Siswa");
    $(".modal-footer button[type=submit]").html("Ubah Data");
    var d = document.getElementById("modal");
    d.setAttribute("action","http://localhost/perpus/dataSiswa/setuju");


    const nis = $(this).data("nis");
    $.ajax({
      url: 'http://localhost/perpus/dataSiswa/editSiswa',
      data: { nis : nis},
      method: 'post',
      success: function (data) {
        var data = JSON.parse(data);
        $('#nama').val(data.nama);
        $('#nis').val(data.nis);
        $('#nisLama').val(data.nis);
        $('#kelas').val(data.kelas);
        $('#password').val(data.password);
        $('#noTelp').val(data.noTelp);
        $('#cpassword').val(data.password);
        $('#gambarLama').val(data.gambar);
      }
    });
  });

  $(".hapus").on("click", function () {
    $("#exampleModalLabel").html("Ubah Data Siswa");
    $(".modal-footer button[type=submit]").html("Ubah Data");
    var d = document.getElementById("btnHapus");

    const nis = $(this).data("nis");
    const link = "http://localhost/perpus/dataSiswa/hapus/" + nis;
    d.setAttribute("href",link);
    
  });











});
 







</script>