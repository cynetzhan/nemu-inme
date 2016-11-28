<?php
include 'function.php';
$con=koneksi();
$ceklog=false;
$idlaporan=$_GET['id'];
$select="select * from laporan where id_laporan=".$idlaporan;
$query=mysqli_query($con,$select);
$row=mysqli_fetch_array($query);
$iduser=$row['id_user'];
$ownLapor=false;
if(checkSessionBool()){
headBanner($_SESSION['username']);
$ceklog=true;
if(getId($_SESSION['username'])==$iduser) {
	$ownLapor=true;
 }
} else {
	headBanner();
}
?>
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-7">
				<div class="panel panel-default">
					<div class="panel-heading">Laporan Barang Temuan <strong>#<?php echo $row['id_laporan']; ?></strong></div>
					<div class="panel-body">
						<table class="table table-striped">
							<tr>
									<td>Jenis Barang</td>
									<td><?php echo $row['jenis_barang'];?></td>
							</tr>
							<tr>
									<td>Lokasi</td>
									<td><?php echo lokasiCek($row['lokasi']).", ".alamatCek($row['alamat'])."<br><em class='grey'>(".$row['latitude'].",".$row['longitude'].")</em>";?></td>
							</tr>
							<tr>
									<td>Ditemukan oleh</td>
									<td><?php echo getUser($row['id_user']);?></td>
							</tr>
							<tr>
									<td>Waktu Pelaporan</td>
									<td><?php echo $row['waktu'];?></td>
							</tr>
							<tr>
									<td>Deskripsi Singkat</td>
									<td><?php echo $row['deskripsi'];?></td>
							</tr>
							<tr>
								<?php if($ceklog){ ?>
									<td>Aksi</td>
									<td>
										<?php if($ownLapor){ ?>
											<a class="btn btn-info btn-sm" href="tandaiselesai.php?id=<?php echo $row['id_laporan']; ?>"><span class="glyphicon glyphicon-check"></span> Tandai Telah Dikembalikan</a>
											<a class="btn btn-info btn-sm" href="editlaporan.php?id=<?php echo $row['id_laporan']; ?>"><span class="glyphicon glyphicon-edit"></span> Sunting</a>
											<?php } else {
												if($ceklog && cekTelahKlaim($idlaporan,getId($_SESSION['username']))) { 
												?>
												<a class="btn btn-info btn-sm" href="klaim.php?id=<?php echo getKlaimId($idlaporan,getId($_SESSION['username'])); ?>">Lihat Rincian Klaim</a>
												<?php } else { ?>
												<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#klaim">Ini Milik Saya!</button></td>
										<?php }
												} } else { ?>
													<td colspan="2"><em>Silahkan <a href="login.php">Login</a> terlebih dahulu atau <a href="daftar.php">Daftar</a> untuk mengklaim</em></td>
										<?php } ?>
							</tr>
						</table>
					</div>
				</div>
				<?php
				if($ownLapor){ klaimList($idlaporan); } ?>
			</div>
			<div class="col-sm-5">
				<div class="panel panel-default">
					<div class="panel-heading">Peta Lokasi</div>
					<div class="panel-body">
						<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $row['latitude'].",".	$row['longitude']; ?>&zoom=17&scale=false&size=500x300&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0x3fd84c%7Clabel:1%7C<?php echo $row['latitude'].",".$row['longitude']; ?>" alt="Google Map Static" class="img-responsive">
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Bagikan Laporan Ini</div>
					<div class="panel-body">
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_pinterest_large' displayText='Pinterest'></span>
						<span class='st_whatsapp_large' displayText='WhatsApp'></span>
						<span class='st_email_large' displayText='Email'></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
  <div id="klaim" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Klaim Laporan</h4>
        </div>
        <div class="modal-body">
          <p>Tuliskan detail yang lebih spesifik pada barang anda, agar pelapor yakin bahwa barang yang ditemukannya adalah milik anda.</p>
          <input type="hidden" name="idlapor" value="<?php echo $row['id_laporan']; ?>">
          <!--input type="hidden" name="iduserklaim" value=""-->
          <textarea name="detaillap" class="form-control" placeholder="Tuliskan detail disini"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="klaim()">Klaim</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
<?php footer(); ?>
<script>
  function klaim(){
    var $idlaporan=$("input[name=idlapor]").val(); var $isiklaim=$("textarea[name=detaillap]").val(); //iduserklaim ambil dari session
    $.post("prosesklaim.php",{klaim:$isiklaim,idlapor:$idlaporan}, function(result){
      $("#klaim > div > div").html(result);
    });
  }
</script>
</body>
</html>
