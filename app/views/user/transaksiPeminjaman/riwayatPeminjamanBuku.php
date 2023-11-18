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
          <li class="page-item"><a class="page-link text-black" href="<?php echo baseUrl() . "/transaksiPeminjaman/formulirPeminjamanBuku"; ?>">Formulir Peminjaman Buku</a></li>
          <li class="page-item"><a class="page-link text-white active" href="<?php echo baseUrl() . "/transaksiPeminjaman/riwayatPeminjamanBuku"; ?>">Riwayat Peminjaman Buku</a></li>
        </ul>
      </div>
      <div class="col-4">
          <form action="" method="post">
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Pencarian" name="pencarianRiwayat" value="<?php echo (isset($_SESSION['keyR'])? $_SESSION['keyR'] : '') ;?>">
          <button type="submit" name="searchR" id="search" style="display: none;"></button>
          </form>
      </div>
    </div>
</nav>
<hr>
  <form acction="" method="post">
        <p class=" d-flex" style="width: 290px;">
          <span>Tampilkan</span>
          <select id="tamp" class="form-select form-select-sm w-25 mb-3 mx-2" aria-label=".form-select-lg example" name="limit">
          <option <?php echo (isset($_SESSION["jdpsR"]) && $_SESSION["jdpsR"] ==10 )? "selected":"" ;?>>10</option>
          <option <?php echo (isset($_SESSION["jdpsR"]) && $_SESSION["jdpsR"] == 25)? "selected":"" ;?>>25</option>
          <option <?php echo (isset($_SESSION["jdpsR"]) && $_SESSION["jdpsR"] == 50)? "selected":"" ;?>>50</option>
          <option <?php echo (isset($_SESSION["jdpsR"]) && $_SESSION["jdpsR"] == 100)? "selected":"" ;?>>100</option>
        </select> entri
        </p>
        <button style="display: none" name="entri" id="btnTamp"></button>
        </form>


        <div style="overflow-x: auto" id="table"></div>
        <table class="table table-bordered" align="center">
          <tr>
            <td>Kode Transaksi</td>  
            <td>Nama</td>
            <td>Judul Buku</td>
            <td>Tanggal Peminjaman<i></i></td>
            <td>Dikembalikan sebelum tanggal</td>
          </tr>
<!-- Tampilkan Data Siswa dari database -->
<?php foreach ($data["riwayatPeminjaman"] as $peminjaman) { ?>

          <tr class="bg-secondary">
            <td><?php echo $peminjaman["kodeTransaksi"]; ?></td>
            <td><?php echo $peminjaman["nama"]; ?></td>
            <td><?php echo $peminjaman["judulBuku"] ?></td>
            <td><?php echo $peminjaman["tanggalPeminjaman"]; ?></td>
            <td><?php echo $peminjaman["tanggalPengembalian"]; ?></td>
          </tr>
<?php } ?>
      </table>

      <div class="d-flex justify-content-between align-items-center mt-4">
        <p class="text-sm-start text-black-50"></p>
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

<script type="text/javascript">
  
const select = document.querySelector("select#tamp");
select.addEventListener("change", function () {
  const btnTamp = document.getElementById("btnTamp");
  btnTamp.click();
});







</script>