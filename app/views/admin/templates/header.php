<!DOCTYPE html>
<html>
<head>
  <title>Index</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://localhost/perpus/assets/css/w3school1.css">
  <link rel="stylesheet" href="http://localhost/perpus/assets/css/w3school2.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/perpus/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://localhost/perpus/assets/css/cssGabungan.css">
<script src="http://localhost/perpus/assets/js/fontAwesome.js"></script>    
  <script src="http://localhost/perpus/assets/js/jquery.js"></script>  
<link rel="icon" type="image/x-icon" href="http://localhost/perpus/assets/img/logo_app.png">
  <script src="http://localhost/perpus/assets/js/fontAwesome.js"></script>
  </head>
<body class="w3-light-grey">
  <script src="http://localhost/perpus/assets/js/bootstrap.min.js"></script><!-- Top container -->



<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <a href="<?php echo baseUrl() . '/keluar/index'; ?>"><span class="w3-bar-item w3-left"><img src="<?php echo baseUrl() . '/assets/img/logo.png';  ?>" class="" width="30px" height="30px">   E-perpus</span></a>
  <a href="<?php echo baseUrl() . '/keluar/index'; ?>"><span class="w3-bar-item w3-right" style="color:white;">Keluar</span></a>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-animate-left" style="z-index:3;width:300px;background-color: #18dd18;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="<?php echo baseUrl(). '/assets/img/' .$_SESSION['identitas']['gambar']; ?>" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Selamat Datang, <strong><?php echo $_SESSION["identitas"]["nama"]; ?></strong></span><br>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Menu Tampilan</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="<?php echo baseUrl() . "/dashboard"; ?>" class="w3-bar-item w3-button w3-padding <?php echo pilihan($data['pilihan'],'dashboard'); ?>"><i class="fa fa-home fa-fw"></i> Dashboard</a>
    <a href="<?php echo baseUrl() . "/dataBuku"; ?>" class="w3-bar-item w3-button w3-padding <?php echo pilihan($data['pilihan'],'dataBuku'); ?>"><i class="fa fa-book fa-fw"></i> Data Buku</a>
    <a href="<?php echo baseUrl() . "/dataSiswa"; ?>" class="w3-bar-item w3-button w3-padding <?php echo pilihan($data['pilihan'],'dataSiswa'); ?>"><i class="fa fa-users fa-fw"></i>  Data Siswa</a>
    <a href="<?php echo baseUrl() . "/dataAkun"; ?>" class="w3-bar-item w3-button w3-padding <?php echo pilihan($data['pilihan'],'dataAkun'); ?>"><i class="fa fa-user fa-fw"></i>  Data Akun</a>
    <a href="<?php echo baseUrl() . "/transaksiPeminjaman/formulirPeminjamanBuku"; ?>" class="w3-bar-item w3-button w3-padding <?php echo pilihan($data['pilihan'],'transaksiPeminjaman'); ?>"><i class="fa fa-sign-out fa-fw"></i> Transaksi Peminjaman

      <?php if ( isset($_SESSION["praPeminjaman"]) ) { ?>

        <span class="badge text-bg-danger"><?php echo $_SESSION["praPeminjaman"]; ?></span> 

      <?php } ?>


    </a>

    <a href="<?php echo baseUrl() . "/transaksiPengembalian/formulirPengembalianBuku"; ?>" class="w3-bar-item w3-button w3-padding <?php echo pilihan($data['pilihan'],'transaksiPengembalian'); ?>"><i class="fa fa-sign-in fa-fw"></i> Transaksi Pengembalian</a>


    <a href="<?php echo baseUrl() . "/pesan"; ?>" class="w3-bar-item w3-button w3-padding <?php echo pilihan($data['pilihan'],'pesan'); ?>"><i class="fa-solid fa-message"></i> Pesan 

      <?php if ( isset($_SESSION["isiPesanAdmin"]) ) { ?>

        <span class="badge text-bg-danger"><?php echo $_SESSION["isiPesanAdmin"]; ?></span> 

      <?php } ?>
      </a>
         <a href="<?php echo baseUrl() . "/profil"; ?>" class="w3-bar-item w3-button w3-padding <?php echo pilihan($data['pilihan'],'profil'); ?>"><i class="fa fa-gear fa-fw"></i> Profil  
      </a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

