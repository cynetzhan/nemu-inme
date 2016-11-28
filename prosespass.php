<?php
include 'function.php';
$con=koneksi();

$userid=$_POST['userid'];
$user=$_SESSION['username'];
headBanner($user);
$query=mysqli_fetch_array(mysqli_query($con,"select password from pengguna where id_user='$userid'"));
  
if(md5($_POST['oldpass'])==$query['password']){
	if($_POST['newpass']==$_POST['newpassc']){
		$update=mysqli_query($con,"update pengguna set password=md5('$_POST[newpass]') where id_user='$userid'");
		if($update) {goto success;}
		} else {goto fail;}
	} else {
		goto fail;
	}
	success: {
    ?>
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">Perubahan Profil Berhasil</div>
						<div class="panel-body">Kembali ke <a href="dashboard.php">Halaman User</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php }
fail: { ?>
	
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">Perubahan Profil Gagal</div>
						<div class="panel-body">Terdapat masalah teknis saat melakukan pendaftaran. Silahkan <a onclick="window.back()" >kembali</a> lalu coba lagi. 
						<pre><?php echo mysqli_error($con); ?></pre>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }
footer(); ?>
