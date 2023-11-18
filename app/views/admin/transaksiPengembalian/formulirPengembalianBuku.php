<header class="w3-container mar">
	<h2 style="font-family: tahoma"><i class="fa fa-sign-in fa-fw"></i>  Transaksi Pengembalian</h2>
 <span id="tanggal" ></span> 
</header>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px; padding: 0 3px">

  <div id="content" class="border border-2 p-3 bg-white">
    <nav aria-label="Page navigation example">
      <div class="row">
        <div class="col-8">
          <ul class="pagination">
            <li class="page-item"><a class="page-link text-white active" href="<?php echo baseUrl() . "/transaksiPengembalian/formulirPengembalianBuku"; ?>">Formulir Pengembalian Buku</a></li>
            <li class="page-item"><a class="page-link text-black" href="<?php echo baseUrl() . "/transaksiPengembalian/riwayatPengembalianBuku"; ?>">Riwayat Pengembalian Buku</a></li>
          </ul>
        </div>
        <div class="col-4">
          <form action="" method="post">
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Pencarian" name="keyFormulirp" value="<?php echo (isset($_SESSION["keyFormulirp"]))? $_SESSION['keyFormulirp'] : ""?>">
            <button type="submit" name="search" id="search" style="display: none;"></button>
          </div>
        </div>
      </nav>
      <hr>
      <?php flasher::flash(); ?>
      <form acction="" method="post">
        <p class=" d-flex" style="width: 470px;">
          <span>Kondisi</span>
          <select id="tamp" class="form-select form-select-sm w-25 mb-3 mx-2" aria-label=".form-select-lg example" name="kondisiPengembalian">
            <option <?php echo (isset($_SESSION["kondisiPengembalian"]) && $_SESSION["kondisiPengembalian"] == "Tidak Telat")? "selected":"" ;?>>Tidak Telat</option>
            <option <?php echo (isset($_SESSION["kondisiPengembalian"]) && $_SESSION["kondisiPengembalian"] == "Telat")? "selected":"" ;?>>Telat</option>
          </select> 
        </p>
        <button style="display: none" name="entri" id="btnTamp"></button>
      </form>

      <?php foreach ($data["peminjaman"] as $data) { ?>
        <div class="card">
          <div class="card-header">
            Kode Transaksi : <?php echo $data["kodeTransaksi"]; ?>
          </div>
          <div class="card-body">
            <h5 class="card-title">Nama : <?php echo $data["nama"]; ?></h5>
            <p class="card-text">Kelas : <?php echo $data["kelas"]; ?></p>
            <p class="card-text">Buku Yang Dipinjam : <?php echo judul($data['noBuku']);?></p>
            <a href="" class="btn btn-secondary lihat2" data-bs-toggle="modal" data-bs-target="#exampleModal" data-no="<?php echo $data['noBuku']; ?>">Lihat</a>
            <a href="" data-no="<?php echo $data["noBuku"]; ?>"data-nis="<?php echo $data['kodeTransaksi']; ?>"  class="btn btn-success edit" data-bs-toggle="modal" data-bs-target="#Modal" > Setuju </a>
          </div>
        </div>
        <br>

      <?php } ?>


      <div class="d-flex justify-content-between align-items-center mt-4">
        <p class="text-sm-start text-black-50"></p>
        <nav aria-label="...">
          <ul class="pagination">
            <?php if ( $_SESSION["hfp"] > 1 ) { ?>
              <li class="page-item">
                <a class="page-link text-black-50" href="<?php echo baseUrl().'/transaksiPengembalian/formulirPengembalianBuku/page='. $_SESSION['hfp']-1; ?>">Sebelumnya</a>
              <?php } ?>
              <?php for ( $i = $_SESSION["nap"]; $i <= $_SESSION["nrp"]; $i++ ) { ?>
                <li class="page-item
                <?php echo ($i == $_SESSION['hfp'])? 'active':''; ?>
                " aria-current="page">
                <a class="page-link text-black-50" href="<?php echo baseUrl().'/transaksiPengembalian/formulirPengembalianBuku/page='. $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php } ?>
            <?php if ( $_SESSION["hfp"] < $_SESSION["jpp"] ) { ?>
              <li class="page-item">
                <a class="page-link text-black-50" href="<?php echo baseUrl().'/transaksiPengembalian/formulirPengembalianBuku/page='. $_SESSION['hfp']+1; ?>">Selanjutnya</a>
              </li>
            <?php } ?>
          </ul>
        </nav>
      </div>


    </div>
    <!-- End page content -->
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card mb-3">
            <img src="<?php echo baseUrl() . "/assets/img/" . "buku2.jpeg"; ?>" class="card-img-top" alt="..." id="gambar">
            <div class="card-body">
              <h4 class="card-title" id="judul">Card title</h4><hr>
              <p class="card-text" id="pengarang">Pengarang : Figo</p>
              <p class="card-text" id="jumlahBuku">Jumlah Buku : 20</p>
              <p class="card-text" id="bukuDipinjam">Buku dipinjam : 20</p>
              <h5 class="card-title">Sinopsis :</h5>
              <p class="card-text" id="sinopsis">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <form action="<?php echo baseUrl() . "/dataBuku/daftarBuku" ?>" method="post">
            <input type="hidden" name="judulBuku" id="inputJudulBuku">
            <input type="hidden" name="noBuku" id="noBuku">
            <input type="hidden" name="inputGambarBuku" id="inputGambarBuku">
            <input type="hidden" name="nis" value="<?php echo $_SESSION['identitas']['nis']; ?>">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <form action="<?php echo baseUrl() . '/transaksiPengembalian/setuju';?>" method="post" enctype="multipart/form-data" id="modal">
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #18dd18;">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Pengembalian Buku</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Kode Transaksi :</label>
              <input type="text" class="form-control" id="kodeTransaksi" placeholder="Kode Transaksi" name="kodeTransaksi" required>
            </div>
            <div class="mb-3">
              <label for=".form-select" class="form-label">Kondisi Buku :</label>
              <select class="form-select" aria-label="Default select example" name="kondisiBuku" id="kondisiBuku">
                <option data-denda="0">Baik</option>
                <option data-denda="10000" >Rusak</option>
                <option data-denda="20000">Hilang</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Tanggal Pengembalian :</label>
              <input type="text" class="form-control" id="tanggalPengembalian" required value="0" disabled>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="noBuku" id="no">
            <input type="hidden" name="dendaz" id="s">
            <input type="hidden" name="tanggalPengembalian " id="tanggals">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary" name="btn" >Tambah Data</button>
          </div>
        </div>
      </div>
    </div>
  </form>


  <script type="text/javascript">
    const select = document.querySelector("select#tamp");
    select.addEventListener("change", function () {
      const btnTamp = document.getElementById("btnTamp");
      btnTamp.click();
    });




    $(document).ready(function () {
      $(".lihat2").on("click", function () {
        const no = $(this).data("no");

        $.ajax({
          url: 'http://localhost/perpus/transaksiPeminjaman/informasi',
          data: { no : no,},
          method: 'post',
          success: function (data) {
            var data = JSON.parse(data);

            const judul = document.getElementById("judul");
            judul.innerHTML = data.judul;


            const pengarang = document.getElementById("pengarang");
            pengarang.innerHTML = "Pengarang : " + data.pengarang;


            const bukuDipinjam = document.getElementById("bukuDipinjam");
            bukuDipinjam.innerHTML = "Buku Dipinjam : " + data.bukuDipinjam;


            const jumlahBuku = document.getElementById("jumlahBuku");
            jumlahBuku.innerHTML = "Jumlah Buku : " + data.jumlahBuku;

            const sinopsis = document.getElementById("sinopsis");
            sinopsis.innerHTML = data.sinopsis;

            const gambar = document.getElementById("gambar");
            var gmbr = "http://localhost/perpus/assets/img/" + data.gambarBuku;
            gambar.setAttribute("src",gmbr);

            const inputJudulBuku = document.getElementById("inputJudulBuku");
            inputJudulBuku.value = data.judul;

            const inputGambarBuku = document.getElementById("inputGambarBuku");
            inputGambarBuku.value = data.gambarBuku;

            const noBuku = document.getElementById("noBuku");
            noBuku.value = data.no;
          }
        });
      });

      $(".edit").on("click", function () {
        var d = document.getElementById("modal");
        d.setAttribute("action","http://localhost/perpus/transaksiPengembalian/setuju");
        var bulans = new Date().getMonth() + 1;
        var tanggals = new Date().getDate();
        var tahuns = new Date().getFullYear();
        
        var all = tanggals + "-" + bulans + "-" + tahuns;
        $("#tanggalPengembalian").val(all);
        const no = $(this).data("no");
        const nis = $(this).data("nis");
        $.ajax({
          url: 'http://localhost/perpus/transaksiPengembalian/informasi',
          data: { no : no, nis : nis},
          method: 'post',
          success: function (data) {
            var data = JSON.parse(data);
            console.log(data);
            $('#kodeTransaksi').val(data.kodeTransaksi);
            var d = 0;

            d = data.denda;   
            $("#kondisiBuku").on("change", function ( e ) {
              const denda = $('#kondisiBuku option:selected').data('denda');
              d = data.denda;
              var e = parseInt(d) + parseInt(denda);
              d = e;
              alert(d);
              const s = document.getElementById("s");
              s.value = d;
            //  d itu adalah input denda
            // 
          });
            s.value = d.value;

            $("#tanggalPengembalian").val(all);
            $("#tanggals").val(all);
            

            $("#tanggalPengembalian").val(all);
            $("#tanggals").val(all);


            const noBuku = document.getElementById("no");  
            noBuku.value = data.noBuku;
          }
        });
      });
    });
















  </script>