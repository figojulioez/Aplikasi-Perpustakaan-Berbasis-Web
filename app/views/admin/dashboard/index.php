  <header class="w3-container mar">
  <h2 style="font-family: tahoma"><i class="fa-solid fa-house"></i>  Dashboard</h2>
    <span id="tanggal"></span> 
  </header>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<div id="dashboard" >
  <!-- Header -->
  <div class="w3-row-padding w3-margin-bottom" id="dashboard">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-book w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $data["jumlahBuku"]; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <a href="<?php echo baseUrl() . "/dataBuku"; ?>" class="w3-text-white"><h4>Buku</h4></a>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-sign-in w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $data["jumlahPengembalian"]; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <a href="<?php echo baseUrl() . "/transaksiPengembalian/formulirPengembalianBuku"; ?>" class="w3-text-white"><h4>Dikembalikan</h4></a>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-sign-out w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $data["jumlahPeminjaman"]; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <a href="<?php echo baseUrl() . "/transaksiPeminjaman/formulirPeminjamanBuku"; ?>" class="w3-text-white"><h4>Pinjam</h4></a>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $data["jumlahSiswa"]; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <a href="<?php echo baseUrl() . "/dataSiswa"; ?>" class="w3-text-white"><h4>Siswa</h4></a>
      </div>
    </div>
  </div>
</div>

  <div class="w3-panel bg-white">
    <div class="w3-row-padding " style="margin:12px -16px">
     <!--  <div class="w3-third">
        <h5>Regions</h5>
        <img src="/w3images/region.jpg" style="width:100%" alt="Google Regional Map">
      </div> -->
      <div class="w3-twothird">
        <h5>5 Pesan Teratas</h5>
        <table class="w3-table w3-striped w3-white">
          <?php foreach ($data["pesan"] as $key ) { ?>
          <tr>
            <td><i class="fa-solid fa-message"></i></td>
            <td><?php echo $key["isiPesan"];?></td>
            <td><?php echo $key["tanggalPengirim"]; ?></td>
          </tr>
        <?php } ?>
        </table>
      </div>
    </div>
  </div>
  </div> <!-- End page content -->
</div>
