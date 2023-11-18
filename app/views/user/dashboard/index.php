  <header class="w3-container mar">
    <h2 style="font-family: tahoma"><i class="fa-solid fa-house"></i>  Dashboard</h2>
    <span id="tanggal"></span> 
  </header>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:300px;margin-top:33px;">


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
            <a href="<?php echo baseUrl() . "/transaksiPengembalian/riwayatPengembalianBuku"; ?>" class="w3-text-white"><h4>Dikembalikan</h4></a>
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
            <div class="w3-left"><i class="fa fa-message w3-xxxlarge"></i></div>
            <div class="w3-right">
              <h3><?php echo $data["jumlahPesan"]; ?></h3>
            </div>
            <div class="w3-clear"></div>
            <a href="<?php echo baseUrl() . "/pesan"; ?>" class="w3-text-white"><h4>Pesan</h4></a>
          </div>
        </div>
      </div>
    </div>


    <div class="w3-panel bg-white">
      <div class="w3-row-padding" style="margin:12px -16px">
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


    <div class="w3-panel bg-white">
      <div class="w3-row-padding" style="margin:12px -16px">
        <div class="w3-twothird">
          <h5>Cara Menggunakan Aplikasi</h5>
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  Cara Meminjam Buku
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <ol type="1" class="" >
                    <li>Buka Page Data Buku.</li>
                    <li>Pilih Buku yang anda sukai, lalu tambah ke dalam daftar buku.</li>
                    <li>Lalu buka Page transaksi peminjaman, lalu pilih pinjam.</li> 
                    <li>Lalu Tunggu Pustakawan menyetujui Pra Peminjaman.</li>
                    <li>Apabila tidak di setujui dalam jangka waktu 1 hari, maka daftar pra peminjaman akan otomatis terhapus</li>
                    <li>Jika Sudah Disetujui, Maka anda sudah melakukan Transaksi Peminjaman.</li> 
                    <li>Ingat !!! Batas Peminjaman Adalah 2 hari.</li> 
                    
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- End page content -->
</div>


