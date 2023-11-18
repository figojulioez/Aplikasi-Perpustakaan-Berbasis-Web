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

    <link rel="icon" type="image/x-icon" href="http://localhost/perpus/assets/img/logo_app.png">
    <script src="http://localhost/perpus/assets/js/jquery.js"></script>  

    <script src="http://localhost/perpus/assets/js/fontAwesome.js"></script>
  </head>
  <style type="text/css">
    * { font-family: Trebuchet MS; }
  </style>
  <body class="">
    <script src="http://localhost/perpus/assets/js/bootstrap.min.js"></script>

    <!-- header -->
    <div class="d-flex flex-rows py-1 mx-5" style="border-bottom: 1px solid black;">
      <div class="w-25 py-2 px-3">
        <img src="http://localhost/perpus/logo_app.jpeg" height="100px" class="">
      </div>
      <div class="text-center w-50">
        <h1 style="font-weight: bold">E-Perpus</h1>
        <p>
          Alamanda Regency Jln. Cendana 1 No 9 Tambun Utara Kecamatan KarangSatria
        Kabupaten Bekasi JAWA BARAT - 17510</p>
      </div>
    </div>


    <div class="row mx-5"> 
      <div class="row mt-1">
        <h6 id="tanggal">Tanggal Cetak : Senin 25 November 2022</h6>
      </div>
<script type="text/javascript">
  arrbulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
arrhari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
date = new Date();
hari = date.getDay();
tanggal = date.getDate();
bulan = date.getMonth();
tahun = date.getFullYear();
var t = "Tanggal Cetak : ";  
t += arrhari[hari]+", " +tanggal+ " " + arrbulan[bulan]+ " "+tahun;
const tangg = document.getElementById("tanggal");


tangg.innerHTML = t;


</script>