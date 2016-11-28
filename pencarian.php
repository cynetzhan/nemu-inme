<?php
include "function.php";
$con=koneksi();
$cekpost=false;
if(checkSessionBool()){
 $username=$_SESSION['username'];
 headBanner($username);
} else {
	headBanner();
}
if(isset($_POST['jenisbarang'])) { $cekpost=true; }
?>
<div class="content-wrapper">
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<div class="panel panel-default" id="pencarian">
				<div class="panel-heading">Pencarian</div>
				<div class="panel-body">
					<div class="form-group">
							<label for="jenisbarang">Jenis Barang</label>
							<?php if($cekpost) { optionJenisBarang($_POST['jenisbarang']);} else { optionJenisBarang(); } ?>
					</div>
					<div class="form-group">
							<label for="lokasi">Lokasi Hilang</label>
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
									<ul class="hasil list-group"></ul>
							</div>
					</div>
					<div class="form-group">
							<button type="button" name="carilaporan" class="btn btn-md btn-success form-control" onclick="cariLapor()">Cari</button>
					</div>			
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">Hasil Pencarian</div>
				<div class="panel-body">
					<span>Hasil temuan barang dalam radius 500 meter dari tempat yang dimasukkan</span>
					<table class="table table-striped table-responsive" id="hasilcari">
					<thead>
					<tr>
							<th>Jenis Barang</th>
							<th>Lokasi</th>
							<th>Penemu</th>
							<th>Waktu</th>
							<th>Aksi</th>
					</tr>
					</thead>
					<tbody id="info">
<?php if($cekpost) {
	$select="select * from laporan where jenis_barang='".$_POST['jenisbarang']."'";
	$query=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($query)){
?>
						<tr>
								<td><?php echo $row['jenis_barang']; ?></td>
								<td><?php echo "<strong>".$row['lokasi']."</strong><br>".$row['alamat']; ?></td>
								<td><?php echo getUser($row['id_user']); ?></td>
								<td><?php echo $row['waktu']; ?></td>
								<td><a href="laporan.php?id=<?php echo $row['id_laporan']; ?>">Lihat</a></td>
						</tr>
<?php }
 } else {
?>
					<tr>
						<td colspan="5" id="infosc">Masukkan jenis barang dan lokasi kehilangan pada kolom yang tersedia</td>
<?php } ?>
					</tr>
					</tbody>
			</table>
				</div>
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
  
  function cariLapor(){
    var $latme=$("input[name=latpost]").val();
    var $lngme=$("input[name=lngpost]").val();
    var $jnsme=$("select[name=jenisbarang]").val();
    $("#info").html("<tr><td colspan='5' id='infosc'><span class='glyphicon glyphicon-search' id='scblink'></span> <br>Sedang Mencari...</td></tr>");
    var jsonget=setTimeout(function(){
					$.get("ajax_carilapor.php",{jenis:$jnsme,lat:$latme,lng:$lngme}, function(result){
							$("#hasilcari tbody").html(result);
					});
				},500);
  }
  
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
    $("input[name=latpost]").val("");
    $("input[name=lngpost]").val("");
    $("input[name=addresspost]").val("");
    $("input[name=lokasi]").val("");
    $("input[name=lokasipost]").val("");
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
        $("span.lokasi").html("Fitur ini tidak didukung oleh browser atau perangkat anda.");
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
            $("span.lokasi").html("Pengambilan lokasi tidak diizinkan pengguna.");
            break;
        case error.POSITION_UNAVAILABLE:
            $("span.lokasi").html("Informasi lokasi tidak tersedia.");
            break;
        case error.TIMEOUT:
            $("span.lokasi").html("Permintaan lokasi melebihi batas waktu");
            break;
        case error.UNKNOWN_ERROR:
            $("span.lokasi").html("Terjadi kesalahan.");
            break;
    }
  }
  </script>
</body>
</html>
