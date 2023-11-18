<script>

arrbulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
arrhari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
date = new Date();
hari = date.getDay();
tanggal = date.getDate();
bulan = date.getMonth();
tahun = date.getFullYear();
var t = arrhari[hari]+", " +tanggal+ " " + arrbulan[bulan]+ " "+tahun;
const tangg = document.getElementById("tanggal");

tangg.innerHTML = t;




// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}





// keyword.addEventListener("keydown", function(event) {
// 	var nilai = keyword.value; 

// 	img.style.display = "inline-block";
// 	setTimeout(function (){
// 		img.style.display = "none";
// 		button.click();	

// 	},3000);
	
// })


</script>

</body>
</html>