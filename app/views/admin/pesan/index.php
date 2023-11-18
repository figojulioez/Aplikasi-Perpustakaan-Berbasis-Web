<header class="w3-container mar">
  <h2 style="font-family: tahoma"><i class="fa-solid fa-message"></i>  Pesan</h2>
  <span id="tanggal">Senin, 8 oktober 2022</span> 
</header>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px; padding: 0 3px">



  <div id="content" class="border border-2 p-3 bg-white">
    <!-- <div class="d-flex justify-content-between mb-3">
      <h4>Pesan</h4>
      </button> 
    </div> -->
    <div class="d-flex justify-content-between align-items-center">
      <form acction="" method="post">  
        <p class=" d-flex" style="width: 290px;">
          <span>Tampilkan</span>
          <select id="tamp" class="form-select form-select-sm w-25 mb-3 mx-2" aria-label=".form-select-lg example" name="limitPesan">
            <option <?php echo (isset($_SESSION["jdpPesan"]) && $_SESSION["jdpPesan"] == 10 )? "selected":"" ;?>>10</option>
            <option <?php echo (isset($_SESSION["jdpPesan"]) && $_SESSION["jdpPesan"] == 25)? "selected":"" ;?>>25</option>
            <option <?php echo (isset($_SESSION["jdpPesan"]) && $_SESSION["jdpPesan"] == 50)? "selected":"" ;?>>50</option>
            <option <?php echo (isset($_SESSION["jdpPesan"]) && $_SESSION["jdpPesan"] == 100)? "selected":"" ;?>>100</option>
          </select> entri
        </p>
        <button style="display: none" name="entriBuku" id="btnTamp"></button>
      </form>
      <div class="input-group input-group-sm mb-3" style="width: 200px;">
        <form action="" method="post">
          <!-- <span class="input-group-text" id="inputGroup-sizing-sm">Small</span> -->
          <label style="margin-right: 4px;">Pencarian : </label>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="keywordPesan" id="keyword"
          value="<?php echo (isset($_SESSION['keyPesan'])? $_SESSION['keyPesan'] : '') ;?>"
          >
          <button type="submit" name="searchPesan" id="search" style="display: none;"></button>
        </form>
      </div>
    </div>
    <?php flasher::flash(); ?>


    <div style="overflow-x: auto">  
      <table class="table table-bordered" align="center">
        <tr>
          <td>Nama Penerima</td>
          <td>Kelas</td>
          <td>Isi Pesan</td>
          <td>Tanggal Pengiriman</td>
        </tr>
        <?php foreach( $data["pesan"] as $pesan ) { ?>
          <tr>
            <td><?php echo $pesan["nama"]; ?></td>
            <td><?php echo $pesan["kelas"]; ?></td>
            <td><?php echo $pesan["isiPesan"]; ?></td>
            <td><?php echo $pesan["tanggalPengirim"]; ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

          <div class="d-flex justify-content-between align-items-center mt-4">
        <p class="text-sm-start text-black-50"></p>
        <nav aria-label="...">
          <ul class="pagination">
<?php if ( $data["hf"] > 1 ) { ?>
            <li class="page-item">
              <a class="page-link text-black-50" href="<?php echo baseUrl().'/pesan/index/page='. $data['hf']-1; ?>">Sebelumnya</a>
            </li>
<?php } ?>
<?php for ( $i = $data["na"]; $i <= $data["nr"]; $i++ ) { ?>
            <li class="page-item
            <?php echo ($i == $data['hf'])? 'active':''; ?>
            " aria-current="page">
              <a class="page-link text-black-50" href="<?php echo baseUrl().'/pesan/index/page='. $i; ?>"><?php echo $i; ?></a>
            </li>
<?php } ?>
<?php if ( $data["hf"] < $data["jp"] ) { ?>
            <li class="page-item">
              <a class="page-link text-black-50" href="<?php echo baseUrl().'/pesan/index/page='. $data['hf']+1; ?>">Selanjutnya</a>
            </li>
<?php } ?>
          </ul>
      </nav>
    <!-- End page content -->
  </div>


  
  <!-- End page content -->
</div>

<script type="text/javascript">
  // Get the modal
  var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


const select = document.querySelector("select#tamp");
select.addEventListener("change", function () {
  const btnTamp = document.getElementById("btnTamp");
  btnTamp.click();
});

</script>