<?php
include 'function.php';
$con=koneksi();
if(checkSessionBool()){
 $username=$_SESSION['username'];
	$select="select id_user,username,email from pengguna where username='$username'";
	$query=mysqli_query($con,$select);
	$row=mysqli_fetch_array($query);
 headBanner($username);
} else {
	header('Location:login.php');
}
$iduser=getId($username);
$select="select * from laporan where id_user='$iduser'";
$query=mysqli_query($con,$select);
?>
<div class="content-wrapper">
  <div class="container">
   <div class="row">
				<div class="col-sm-3">
					<?php sidebar(); ?>
				</div>
    <div class="col-sm-9">
					<div class="panel panel-default">
						<div class="panel-heading">Laporan Penemuan Anda</div>
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
								<tr>
										<th>Jenis Barang</th>
										<th>Lokasi</th>
										<th>Waktu</th>
										<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
									<?php
										if(mysqli_num_rows($query)>0) {
											while($row=mysqli_fetch_array($query)){
											?>
												<tr>
														<td><?php echo $row['jenis_barang']; ?></td>
														<td><?php echo "<strong>".lokasiCek($row['lokasi'])."</strong><br>".alamatCek($row['alamat']); ?></td>
														<td><?php echo $row['waktu']; ?></td>
														<td><a href="laporan.php?id=<?php echo $row['id_laporan']; ?>">Lihat</a></td>
												</tr>
										<?php }
										} else {
										?>
												<tr>
														<td colspan="5" id="infosc">Belum ada laporan.</td>
												</tr>
										<?php } ?>
								</tbody>
						</table>
						</div>
					</div>
    </div>
    </div>
    </div>
    </div>
<?php footer(); ?>
</body>
</html>

