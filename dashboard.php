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
?>
<div class="content-wrapper">
  <div class="container">
   <div class="row">
				<div class="col-sm-3">
					<?php sidebar(); ?>
				</div>
    <div class="col-sm-9">
      <div class="well">
        <h1>Profil Anda</h1>
        <div class="row">
          <div class="col-xs-4 col-md-2">
          </div>
          <div class="col-xs-8 col-md-10">
            <h2><?php echo $row['username']?></h2>
            <p><?php echo $row['email']?></p>
            <p><a href="ubahprofil.php">Ubah Data Diri</a> - <a href="ubahpass.php">Ubah Password</a> - <a href="logout.php">Logout</a></p>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
							<div class="panel-heading">5 Laporan Terakhir Anda</div>
							<div class="panel-body">
								<table class="table table-striped table-responsive" id="hasilcari">
									<thead>
									<tr>
											<th>Jenis Barang</th>
											<th>Lokasi</th>
											<th>Waktu</th>
											<th>Aksi</th>
									</tr>
									</thead>
									<tbody id="info">
										<?php getLaporanUser($row['id_user'],5); ?>
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
