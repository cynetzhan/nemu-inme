<?php
include "function.php";
$con=koneksi();
if(checkSessionBool()){
 $username=$_SESSION['username'];
 headBanner($username);
 $iduser=getId($username);
} else {
	header('Location:login.php');
}
?>
<div class="content-wrapper">
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<?php sidebar(); ?>
		</div>
		<div class="col-sm-5">
			<div class="panel panel-default">
				<div class="panel-heading">Form Pelaporan Barang Temuan</div>
				<div class="panel-body">
			<form enctype="multipart/form-data" method="post" action="proseslapor.php" role="form">
				<input type="hidden" name="userid" value="<?php echo $iduser; ?>">
				<div class="form-group">
						<label for="nama">Jenis Barang</label>
						<select name="jenisbarang" class="form-control">
					<option value="Alat Komunikasi">Alat Komunikasi</option>
								<option value="ATK">Alat Tulis Kantor</option>
								<option value="Mainan">Mainan</option>
								<option value="Pakaian">Pakaian</option>
								<option value="Alat Elektronik">Alat Elektronik</option>
								<option value="Kendaraan">Kendaraan</option>
								<option value="Aksesoris">Aksesoris (perhiasan, dompet, jam dan lainnya)</option>
								<option value="Buku">Buku</option>
								<option value="Orang">Orang</option>
								<option value="Dokumen">Dokumen Penting</option>
				</select>
				</div>
				<div class="form-group">
						<label for="deskripsi">Deskripsi Pendek</label>
						<textarea name="deskripsi" class="form-control" placeholder="Deskripsikan sedikit tentang benda yang anda temukan" maxlength="140"></textarea>
				</div>
				<div class="form-group">
							<label for="lokasi">Lokasi Temu</label>
							<div class="dropdown">
								<a href="#" data-toggle="dropdown">Pilihan Lokasi
								<span class="caret"></span></a>	
								<ul class="dropdown-menu">
									<li><a href="#" onclick="lokasiCari()">Cari Tempat</a></li>
									<li><a href="#" onclick="lokasiSkrg()">Pakai Posisi Sekarang</a></li>
								</ul>
							</div>
							<input type="hidden" name="latpost" value="0">
							<input type="hidden" name="lngpost" value="0">
							<input type="hidden" name="addresspost" value="null">
							<input type="hidden" name="lokasipost" value="null">
							<div id="lokasiSkrgForm">
									<span class="lokasi">Sedang mendeteksi lokasi... Mohon tunggu sebentar.</span>
							</div>
							<div id="lokasiCariForm">
									<input type="text" name="lokasi" placeholder="Masukkan nama tempat" id="lokasi" class="form-control">
									<button type="button" name="search" onclick="cari()">Cari Tempat</button>
									<ul class="hasil"></ul>
							</div>
					</div>
				<div class="form-group">
						<button type="submit" name="submit" class="btn btn-md btn-success">Laporkan</button>
			</div>
				</form>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">Tips Melaporkan Barang Temuan</div>
				<div class="panel-body"></div>
			</div>
		</div>
	</div>
</div>
</div>
<?php footer(); ?>
  <script>
  var currentItem;
  var geolocSuccess;
  $("#lokasiSkrgForm").hide();
  $(".hasil").css("display","none");
  
  function cari(){
    var $queryin=$('#lokasi').val(), $resultan=$(".hasil");
    $(".hasil").css("display","none");
    $.get("phpjs.php",{query:$queryin}, function(result){
      $resultan.html(result);
      $(".hasil").css("display","block");
    });
  }
  function latlngEnabled(i){
    if(currentItem!=null){
      $("#item"+currentItem+" input").prop("disabled",true);
    }
    $("input[name=latpost]").val($("#item"+i+" input[name=lat]").val());
    $("input[name=lngpost]").val($("#item"+i+" input[name=lng]").val());
    $("input[name=addresspost]").val($("#item"+i+" input[name=address]").val());
    $("input[name=lokasi]").val($("#item"+i+" input[name=place]").val());
    $("input[name=lokasipost]").val($("#item"+i+" input[name=place]").val());
    $(".hasil").css("display","none");
    currentItem=i;
  }
  function lokasiSkrg(){
    $("#lokasiSkrgForm").show();
    $("#lokasiCariForm").hide();
    getLocation();
  }
  function lokasiCari(){
    $("#lokasiCariForm").show();
    $("#lokasiSkrgForm").hide();
  }
  function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        $("span.lokasi").html("Geolocation is not supported by this browser.");
    }
  }
  function showPosition(position) {
    var latlon = position.coords.latitude + "," + position.coords.longitude;
    $("span.lokasi").html(latlon);
    $("input[name=latpost]").val(position.coords.latitude);
    $("input[name=lngpost]").val(position.coords.longitude);
    geolocSuccess = true;
    //ambil alamat dari server - ajax ke local->google api
  }
  function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
  }
  </script>
</body>
</html>
