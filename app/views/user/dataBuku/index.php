<header class="w3-container mar">
  <h2 style="font-family: tahoma"><i class="fa-solid fa-book"></i>  Data Buku</h2>
  <span id="tanggal">Senin, 8 oktober 2022</span> 
</header>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px; padding: 0 3px">
  <div id="content" class="border border-2 p-3 bg-white">
   <nav aria-label="Page navigation example">
    <div class="row">
      <div class="col-8">
        <h4></h4>
      </div>
      <div class="col-4">
        <form action="" method="post">
          <!-- <span class="input-group-text" id="inputGroup-sizing-sm">Small</span> -->
          <input type="text" placeholder="Pencarian" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="keywordBuku" id="keyword" value="<?php echo (isset($_SESSION['keyBuku'])? $_SESSION['keyBuku'] : '') ;?>">
          <button type="submit" name="searchBuku" id="search" style="display: none;"></button>
        </form>
      </div>
    </div>
  </nav>

  <hr>
  <form acction="" method="post">  
    <p class=" d-flex" style="width: 290px;">

      <select id="tamp" class="form-select form-select-sm w-30 mb-3 mx-2" aria-label=".form-select-lg example" name="jenisBuku">
        <option <?php echo (isset($_SESSION["jenisBuku"]) && $_SESSION["jenisBuku"] == "" )? "selected":"" ;?>>All</option>
        <option <?php echo (isset($_SESSION["jenisBuku"]) && $_SESSION["jenisBuku"] == "Novel" )? "selected":"" ;?>>Novel</option>
        <option <?php echo (isset($_SESSION["jenisBuku"]) && $_SESSION["jenisBuku"] == "Pendidikan")? "selected":"" ;?>>Pendidikan</option>
        <option <?php echo (isset($_SESSION["jenisBuku"]) && $_SESSION["jenisBuku"] == "Cerita")? "selected":"" ;?>>Cerita</option>
      </select> 
    </p>
    <button style="display: none" name="btnJenisBuku" id="btnTamp"></button>
  </form>

  <?php flasher::flash(); ?>


  <div class="d-flex justify-content-between mb-3">
    <main style="width: 100%"> 
      <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
       <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">

        <?php foreach ($data["buku"] as $buku) { ?>

          <div class="col"> 
            <div class="card" style="width: 200px; margin: 2px">
              <img src="<?php echo baseUrl() . "/assets/img/" . $buku["gambarBuku"]; ?>" class="card-img-top" alt="...">
              <div class="card-body" align="center">
                <h5 class="card-title btn btn-primary lihat" data-bs-toggle="modal" data-bs-target="#exampleModal" data-no="<?php echo $buku["no"] ?>" confirm="coba"><?php echo $buku["judul"]; ?></h5>
              </div>
            </div>
          </div> 

        <?php } ?>

      </div>
    </main>
  </div>



  <div class="d-flex justify-content-between align-items-center mt-4">
    <p class="text-sm-start text-black-50"></p>
    <nav aria-label="...">
      <ul class="pagination">

        <?php if ( $data["hf"] > 1 ) { ?>
          <li class="page-item">
            <a class="page-link text-black-50" href="<?php echo baseUrl().'/dataBuku/index/page='. $data['hf']-1; ?>">Sebelumnya</a>
          </li>
        <?php } ?>
        <?php for ( $i = $data["na"]; $i <= $data["nr"]; $i++ ) { ?>
          <li class="page-item
          <?php echo ($i == $data['hf'])? 'active':''; ?>
          " aria-current="page">
          <a class="page-link text-black-50" href="<?php echo baseUrl().'/dataBuku/index/page='. $i; ?>"><?php echo $i; ?></a>
        </li>
      <?php } ?>
      <?php if ( $data["hf"] < $data["jp"] ) { ?>
        <li class="page-item">
          <a class="page-link text-black-50" href="<?php echo baseUrl().'/dataBuku/index/page='. $data['hf']+1; ?>">Selanjutnya</a>
        </li>
      <?php } ?>

    </ul>
  </nav>
</div>
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
          <button type="submit" class="btn btn-primary" name="btn" >Tambah Daftar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  const select = document.querySelector("select#tamp");
  select.addEventListener("change", function () {
    const btnTamp = document.getElementById("btnTamp");
    btnTamp.click();
  });





  $(document).ready(function () {

    $(".lihat").on("click", function () {
      const no = $(this).data("no");
      console.log(no);
      $.ajax({
        url: 'http://localhost/perpus/dataBuku/editBuku',
        data: { no : no},
        method: 'post',
        success: function (data) {
          var data = JSON.parse(data);
          console.log(data);

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
  });




</script>