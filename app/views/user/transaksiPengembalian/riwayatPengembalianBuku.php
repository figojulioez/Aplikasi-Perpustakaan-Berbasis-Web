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
          <li class="page-item"><a class="page-link text-white active" href="">Riwayat Pengembalian Buku</a></li>
        </ul>
      </div>
      <div class="col-4">
          <form action="" method="post">
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Pencarian" name="keywordPengembalian" value="<?php echo (isset($_SESSION['keyPengembalian'])? $_SESSION['keyPengembalian'] : '') ;?>">
          <button type="submit" name="searchPengembalian" id="search" style="display: none;"></button>
          </form>
      </div>
    </div>
</nav>
<hr>
  <form acction="" method="post">
        <p class=" d-flex" style="width: 290px;">
          <span>Tampilkan</span>
          <select id="tamp" class="form-select form-select-sm w-25 mb-3 mx-2" aria-label=".form-select-lg example" name="limitPengembalian">
          <option <?php echo (isset($_SESSION["jdpsPengembalian"]) && $_SESSION["jdpsPengembalian"] ==10 )? "selected":"" ;?>>10</option>
          <option <?php echo (isset($_SESSION["jdpsPengembalian"]) && $_SESSION["jdpsPengembalian"] == 25)? "selected":"" ;?>>25</option>
          <option <?php echo (isset($_SESSION["jdpsPengembalian"]) && $_SESSION["jdpsPengembalian"] == 50)? "selected":"" ;?>>50</option>
          <option <?php echo (isset($_SESSION["jdpsPengembalian"]) && $_SESSION["jdpsPengembalian"] == 100)? "selected":"" ;?>>100</option>
        </select> entri
        </p>
        <button style="display: none" name="entri" id="btnTamp"></button>
        </form>


        <div style="overflow-x: auto" id="table"></div>
        <table class="table table-bordered" align="center">
          <tr>
            <td>Kode Transaksi</td>  
            <td>Nama</td>
            <td>Kelas</td>
            <td>Judul</td>
            <td>Tgl. Pinjam</td>
            <td>Tgl. Kembali</td>
            <td>Status</td>
            <td>Kondisi</td>
            <td>Sanksi</td>
          </tr>
<!-- Tampilkan Data Siswa dari database -->
<?php foreach ($data["riwayatPengembalianBuku"] as $pengembalian) { ?>

          <tr class="bg-secondary">
            <td><?php echo $pengembalian["kodeTransaksi"]; ?></td>
            <td><?php echo $pengembalian["nama"]; ?></td>
            <td><?php echo $pengembalian["kelas"]; ?></td>
            <td><?php echo $pengembalian["judul"] ?></td>
            <td><?php echo $pengembalian["tanggalPeminjaman"]; ?></td>
            <td><?php echo $pengembalian["tanggalPengembalian"]; ?></td>
            <td><?php echo $pengembalian["status"]; ?></td>
            <td><?php echo $pengembalian["kondisiBuku"]; ?></td>
              <td><?php echo $pengembalian["sanksi"]; ?></td>
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