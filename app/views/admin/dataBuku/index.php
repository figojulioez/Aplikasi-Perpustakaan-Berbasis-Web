<header class="w3-container mar">
  <h2 style="font-family: tahoma"><i class="fa-solid fa-book"></i>  Data Buku</h2>
  <span id="tanggal">Senin, 8 oktober 2022</span> 
</header>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px; padding: 0 3px">

  <div id="content" class="border border-2 p-3 bg-white">
    <div class="d-flex justify-content-between mb-3">
      <!-- <h4>Data Buku</h4> -->
      <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" id="tambah">
        <i class="fa fa-plus"></i>
        Tambah Buku
      </button> 
    </div>
    <div class="d-flex justify-content-between align-items-center">
      <form acction="" method="post">  
        <p class=" d-flex" style="width: 290px;">
          <span>Tampilkan</span>
          <select id="tamp" class="form-select form-select-sm w-25 mb-3 mx-2" aria-label=".form-select-lg example" name="limitBuku">
            <option <?php echo (isset($_SESSION["jdpsBuku"]) && $_SESSION["jdpsBuku"] == 10 )? "selected":"" ;?>>10</option>
            <option <?php echo (isset($_SESSION["jdpsBuku"]) && $_SESSION["jdpsBuku"] == 25)? "selected":"" ;?>>25</option>
            <option <?php echo (isset($_SESSION["jdpsBuku"]) && $_SESSION["jdpsBuku"] == 50)? "selected":"" ;?>>50</option>
            <option <?php echo (isset($_SESSION["jdpsBuku"]) && $_SESSION["jdpsBuku"] == 100)? "selected":"" ;?>>100</option>
          </select> entri
        </p>
        <button style="display: none" name="entriBuku" id="btnTamp"></button>
      </form>
      <div class="input-group input-group-sm mb-3" style="width: 200px;">
        <form action="" method="post">
          <!-- <span class="input-group-text" id="inputGroup-sizing-sm">Small</span> -->
          <label style="margin-right: 4px;">Pencarian : </label>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="keywordBuku" id="keyword"
          value="<?php echo (isset($_SESSION['keyBuku'])? $_SESSION['keyBuku'] : '') ;?>"
          >
          <button type="submit" name="searchBuku" id="search" style="display: none;"></button>
        </form>
      </div>
    </div>
    <?php flasher::flash(); ?>


    <div style="overflow-x: auto">  
      <table class="table table-bordered" align="center">
        <tr>
          <td>No</td>
          <td>Judul</td>
          <td>Pengarang <i></i></td>
          <td>Gambar Buku</td>
          <td>Buku dipinjam</td>
          <td>Jumlah Buku</td>
          <td>Sinopsis</td>
          <td>Jenis Buku</td>
          <td>Aksi</td>
        </tr>

        <?php $a = 1; foreach ( $data["buku"] as $buku ) { ?>
          <tr class="bg-secondary">
            <td><?php echo $a++ ?></td>
            <td><?php echo $buku["judul"]; ?></td>
            <td><?php echo $buku["pengarang"]; ?></td>
            <td><img src='<?php echo baseUrl() . "/assets/img/" . $buku["gambarBuku"]; ?>' height="50px"></td>
            <td><?php echo $buku["bukuDipinjam"]; ?></td>
            <td><?php echo $buku["jumlahBuku"]; ?></td>
            <td><?php echo $buku["sinopsis"]; ?></td>
            <td><?php echo $buku["jenisBuku"]; ?></td>
            <td class="d-flex justify-content-around">
              <span class="p-2 bg-info rounded" style="margin-right: 5px;">
                <a href="#" style="color:black" data-bs-toggle="modal" data-bs-target="#exampleModal" class="edit" data-no="<?php echo $buku['no']; ?>"><i class="fa fa-edit m-auto"></i></a>  
              </span>
              <span class="p-2 bg-danger rounded">
                <a href="" data-bs-toggle="modal" class="hapus" data-no="<?php echo $buku['no']; ?>" data-bs-target="#hapus" style="color:black" class="edit">
                  <i class="fa fa-trash m-auto"></i>
                </a>
              </span>
            </td>
          </tr>
        <?php } ?>

      </table>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-4">
      <p class="text-sm-start text-black-50"></p>
      <nav aria-label="...">
        <ul class="pagination">

          <?php if ( $data["hf"] > 1 ) { ?>
            <li class="page-item">
              <a class="page-link text-black-50" href="<?php echo baseUrl().'/dataBuku/index/page='. $data['hf']-1; ?>">Sebelumnya</a>
            </li>
          <?php } ?>
          <?php for ( $i = $data["na"]; $i <= $data["nr"]; $i++ ) { ?>
            <li class="page-item
            <?php echo ($i == $data['hf'])? 'active':''; ?>
            " aria-current="page">
            <a class="page-link text-black-50" href="<?php echo baseUrl().'/dataBuku/index/page='. $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php } ?>
        <?php if ( $data["hf"] < $data["jp"] ) { ?>
          <li class="page-item">
            <a class="page-link text-black-50" href="<?php echo baseUrl().'/dataBuku/index/page='. $data['hf']+1; ?>">Selanjutnya</a>
          </li>
        <?php } ?>

      </ul>
    </nav>
  </div>
</div>

</div>
<!-- End page content -->
</div>



<!-- End page content -->
</div>

<!-- Modal -->
<form action="<?php echo baseUrl() . '/dataBuku/tambahBuku';?>" method="post" enctype="multipart/form-data" id="modal">
  <input type="hidden" name="gambarLama" id="gambarLama">
  <input type="hidden" name="no" id="no">

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #18dd18;">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="formFile" class="form-label">Gambar</label>
            <input class="form-control" type="file" id="gambar" name="gambar">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Judul :</label>
            <input type="text" class="form-control" autocomplete="off" id="judul" placeholder="Nama" name="judul" required>
          </div>
          <div class="mb-3">
            <label for=".form-select" class="form-label">Jenis Buku :</label>
            <select class="form-select" aria-label="Default select example" name="jenisBuku" id="jenisBuku">
              <option>Pendidikan</option>
              <option>Novel</option>
              <option>Buku Cerita</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Pengarang :</label>
            <input type="text" class="form-control" id="pengarang" placeholder="Pengarang" name="pengarang" required>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Buku dipinjam :</label>
            <input type="number" class="form-control" id="bukuDipinjam" placeholder="Buku dipinjam" name="bukuDipinjam" required value="0" min="0">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Buku :</label>
            <input type="number" class="form-control" id="jumlahBuku" placeholder="jumlahBuku" name="jumlahBuku" required value="0">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Sinopsis :</label>
            <textarea class="form-control" aria-label="With textarea" id="sinopsis" name="sinopsis"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary" name="btn" >Tambah Data</button>
        </div>
      </div>
    </div>
  </div>
</form>






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
        <a href="<?php echo baseUrl() . "/dataBuku/hapus/". $buku['no']; ?>" class="btn  btn-outline-success" id="btnHapus">Yes</a>
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
    $("#exampleModalLabel").html("Tambah Buku");
    $(".modal-footer button[type=submit]").html("Tambah Data");
    var d = document.getElementById("modal");
    d.setAttribute("action","http://localhost/perpus/dataBuku/tambahBuku");
    $('#judul').val("");
    $('#pengarang').val("");
    $('#bukuDipinjam').val(0);
    $('#jumlahBuku').val(0);
    $('#sinopsis').val("");
    $('#jenisBuku').val("");
    $('#gambarLama').val("");


  });



  $(".edit").on("click", function () {
    $("#exampleModalLabel").html("Ubah Data Buku");
    $(".modal-footer button[type=submit]").html("Ubah Data");
    var d = document.getElementById("modal");
    d.setAttribute("action","http://localhost/perpus/dataBuku/ubahBuku");

    const no = $(this).data("no");
    $.ajax({
      url: 'http://localhost/perpus/dataBuku/editBuku',
      data: { no : no},
      method: 'post',
      success: function (data) {
        var data = JSON.parse(data);
        console.log(data);
        $('#judul').val(data.judul);
        $('#pengarang').val(data.pengarang);
        $('#bukuDipinjam').val(data.bukuDipinjam);
        $('#jumlahBuku').val(data.jumlahBuku);
        $('#sinopsis').val(data.sinopsis);
        $('#jenisBuku').val(data.jenisBuku);
        $('#gambarLama').val(data.gambarBuku);
        $('#no').val(data.no);

      }
    });
  });




  $(".hapus").on("click", function () {
    var d = document.getElementById("btnHapus");

    const nis = $(this).data("no");
    const link = "http://localhost/perpus/dataBuku/hapus/" + nis;
    d.setAttribute("href",link);
    
  });


});

</script>