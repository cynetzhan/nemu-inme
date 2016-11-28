<?php
include 'function.php';
$con=koneksi();

$userid=$_POST['userid'];
$user=$_POST['username'];
$email=$_POST['email'];

$insert="update pengguna set email='$email',nama_lengkap='$_POST[namalkp]',alamat='$_POST[alamat]',no_hp='$_POST[nohp]' where id_user=$userid";
$query=mysqli_query($con,$insert);
headBanner($user);

if($query){
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

<?php } else { ?>
	
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
