	
<body style="background-image: url('http://localhost/perpus/assets/img/bg1.jpeg');
background-repeat: no-repeat;
background-size: cover;
height: 100vh">
<div style="background-color: rgba(0,0,0,0.5);
position: absolute;top: 0;left: 0; bottom: 0;right: 0;">

<div class="container">
  <form action="http://localhost/perpus/masuk/login" style="max-width:500px;margin:120px auto" method="post">
    <h1 align="center" style="color: white; font-family: courier;"><b>E-perpus</b></h1>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btnModal" style="display:none">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          </div>
          <div class="modal-body" align="center">
            <h1 style="font-size:  100px"><i class="fa-solid fa-face-frown-open"></i></h1>
            <h4 id="keterangan" style="font-family: verdana">Keterangan </h4>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
</div>
      <div class="input-container" style="">
       <i class="fa fa-user icon" style="color:black"></i>
       <input class="input-field" type="text" placeholder="Nama Pengguna" name="usrnm">
     </div>

     <div class="input-container">
       <i class="fa fa-key icon" style="color:black"></i>
       <input class="input-field" type="password" placeholder="Kata Sandi" name="psw">
     </div>

     <button type="submit" class="btn btn-secondary" name="btn"><b style="color:black">Masuk</b></button>

   </div>

   <!-- Button trigger modal -->



    <?php 
    if ( isset($_SESSION["akunTidakAda"]) ) {
      echo '<script>
          const btn = document.getElementById("btnModal");
          btn.click();
          const keterangan = document.getElementById("keterangan");
          keterangan.innerHTML = "Mohon Maaf Akun ini tidak ada";
      </script>';
      unset($_SESSION["akunTidakAda"]);
      ?>

        <?php } ?>



      <?php   if ( isset($_SESSION["passwordTidakAda"]) ) {
        echo '<script>
        
          const btn = document.getElementById("btnModal");
          btn.click();
          const keterangan = document.getElementById("keterangan");
          keterangan.innerHTML = "Password Anda Salah";
        </script>';
        unset($_SESSION["passwordTidakAda"]);
      } 


      ?>




   <script src="http://localhost/perpus/assets/js/bootstrap.min.js"></script>
   <script>

   </script>