<header class="w3-container mar">
	<h2 style="font-family: tahoma"><i class="fa fa-sign-out fa-fw"></i>  Transaksi Peminjaman</h2>
 <span id="tanggal" ></span> 
</header>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px; padding: 0 3px">

  <div id="content" class="border border-2 p-3 bg-white">
    <nav aria-label="Page navigation example">
      <div class="row">
        <div class="col-8">
          <ul class="pagination">
            <li class="page-item"><a class="page-link text-white active" href="<?php echo baseUrl() . "/transaksiPeminjaman/formulirPeminjamanBuku"; ?>">Formulir Peminjaman Buku</a></li>
            <li class="page-item"><a class="page-link text-black" href="<?php echo baseUrl() . "/transaksiPeminjaman/riwayatPeminjamanBuku"; ?>">Riwayat Peminjaman Buku</a></li>
          </ul>
        </div>
        <div class="col-4">
          <form action="" method="post">
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Pencarian" name="keyFormulir" value="<?php echo (isset($_SESSION["keyFormulir"]))? $_SESSION['keyFormulir'] : ""?>">
            <button type="submit" name="search" id="search" style="display: none;"></button>
          </div>
        </div>
      </nav>
      <hr>
      <?php flasher::flash(); ?>
      <?php foreach ($data["praPeminjaman"] as $data) { ?>
        <div class="card">
          <div class="card-header">
            Kode Transaksi : <?php echo $data["kodePraPeminjaman"]; ?>
          </div>
          <div class="card-body">
            <h5 class="card-title">Nama : <?php echo $data["nama"]; ?></h5>
            <p class="card-text">Kelas : <?php echo $data["kelas"]; ?></p>
            <p class="card-text">Buku Yang Dipinjam : <?php echo judul($data['noBuku']);?></p>
            <a href="" class="btn btn-secondary lihat2" data-bs-toggle="modal" data-bs-target="#exampleModal" data-no="<?php echo $data['noBuku']; ?>">Lihat</a>


            <a href="<?php echo baseUrl() . "/transaksiPeminjaman/setuju/" . $data['noBuku']; ?>" class="btn btn-success"> Setuju </a>

            <a href="" data-nis="<?php echo $data['noBuku'] . '/' . $data['nis'] ; ?>" data-link="transaksiPeminjaman/hapusPraPeminjaman/" class="btn hapus btn-danger" data-bs-toggle="modal" data-bs-target="#hapus"> Hapus </a>

          </div>
        </div>
        <br>

      <?php } ?>


      <div class="d-flex justify-content-between align-items-center mt-4">
        <p class="text-sm-start text-black-50"></p>
        <nav aria-label="...">
          <ul class="pagination">
            <?php if ( $_SESSION["hf"] > 1 ) { ?>
              <li class="page-item">
                <a class="page-link text-black-50" href="<?php echo baseUrl().'/transaksiPeminjaman/formulirPeminjamanBuku/page='. $_SESSION['hf']-1; ?>">Sebelumnya</a>
              <?php } ?>
              <?php for ( $i = $_SESSION["na"]; $i <= $_SESSION["nr"]; $i++ ) { ?>
                <li class="page-item
                <?php echo ($i == $_SESSION['hf'])? 'active':''; ?>
                " aria-current="page">
                <a class="page-link text-black-50" href="<?php echo baseUrl().'/transaksiPeminjaman/formulirPeminjamanBuku/page='. $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php } ?>
            <?php if ( $_SESSION["hf"] < $_SESSION["jp"] ) { ?>
              <li class="page-item">
                <a class="page-link text-black-50" href="<?php echo baseUrl().'/transaksiPeminjaman/formulirPeminjamanBuku/page='. $_SESSION['hf']+1; ?>">Selanjutnya</a>
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
          <a href="" class="btn btn-outline-success" id="btnHapus">Yes</a>
          <a type="button" class="btn  btn-danger waves-effect" data-bs-dismiss="modal">No</a>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>






  <script type="text/javascript">

    $(document).ready(function () {
      $(".lihat2").on("click", function () {
        const no = $(this).data("no");

        $.ajax({
          url: 'http://localhost/perpus/transaksiPeminjaman/informasi',
          data: { no : no},
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

      $(".hapus").on("click", function () {
        var d = document.getElementById("btnHapus");
        const lik = $(this).data("link");
        const nis = $(this).data("nis");
        const link = "http://localhost/perpus/" + lik + nis;
        d.setAttribute("href",link);

      });


    });
  </script>