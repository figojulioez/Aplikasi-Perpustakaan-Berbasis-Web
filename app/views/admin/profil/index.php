 <header class="w3-container mar">
  <h2 style="font-family: tahoma"><i class="fa-solid fa-gear"></i>  Profil</h2>
  <span id="tanggal">Senin, 8 oktober 2022</span> 
</header>



 <!-- !PAGE CONTENT! -->
 <div class="w3-main " style="margin-left:300px; padding: 0 3px">
  <div id="content " class="border border-2 p-3 bg-white">
    <!-- <div class="d-flex justify-content-between mb-3">
      <h4>Profil</h4>
    </div>
 -->
    <?php flasher::flash(); ?>



    <form action="<?php echo baseUrl() . '/profil/setuju'; ?>" method="post" enctype="multipart/form-data">
     <div class="mb-3 ">
      <label for="nis" class="form-label">NPK <span class="text-danger">* Wajib di isi</span></label>
      <input type="text" value="<?php echo $_SESSION['identitas']['nis']; ?>" class="form-control" id="nisShow" name="nis" aria-describedby="emailHelp">
      <input type="hidden" name="nisLama" id="nis" value="<?php echo $_SESSION['identitas']['nis']; ?>">
    </div>
    <div class="mb-3 ">
      <label for="" class="form-label">Nama <span class="text-danger">* Wajib di isi</span></label>
      <input type="text" class="form-control" id="namaShow" aria-describedby="emailHelp" value="<?php echo $_SESSION['identitas']['nama']; ?>" name="nama">
      <input type="hidden" id="nama" value="<?php echo $_SESSION['identitas']['nama']; ?>">
    </div>
    <div class="mb-3 ">
      <label for="exampleInputEmail1" class="form-label">Password <span class="text-danger">* Wajib di isi</span></label>
      <input type="text" class="form-control" id="passwordShow" name="password"  aria-describedby="emailHelp" required maxlength="20" value="<?php echo $_SESSION['identitas']['password']; ?>">
    </div>
    <div class="mb-3 ">
      <label for="exampleInputEmail1" class="form-label">No Telepon <span class="text-danger">* Wajib di isi</span></label>
      <input type="text" class="form-control" id="noTelp" name="noTelp"  aria-describedby="emailHelp" required maxlength="20" value="<?php echo $_SESSION['identitas']['noTelp']; ?>">
    </div>
    <div class="mb-3 ">
      <label for="formFile" class="form-label">Gambar</label>
      <input class="form-control" type="file" id="formFile" name="gambar">
      <input type="hidden" name="gambarLama" value="<?php echo $_SESSION['identitas']['gambar']; ?>">
      <br>
      <img src="<?php echo baseUrl() . '/assets/img/' . $_SESSION['identitas']['gambar']; ?>" class="img-thumbnail">
    </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-success" name="btn" data-bs-dismiss="modal">Kirim</button>
    </form>
  </div>
</div>
</div>

