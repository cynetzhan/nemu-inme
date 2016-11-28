<?php
include 'function.php';
$con=koneksi();

$user=$_POST['username'];
$pass=md5($_POST['password']);
$email=$_POST['email'];

$insert="insert into pengguna values('','$user','$pass','$email','','','')";
$query=mysqli_query($con,$insert);

if($query){
$iduser=getId($user);
session_name('loginusernemu');
session_start();
$_SESSION['username'] = $user;
headBanner($user);

  if(isset($_POST['namalkp'])) {
    $namalkp=$_POST['namalkp'];
    $update="update pengguna set nama_lengkap='$namalkp' where id_user='$iduser'";
    $query=mysqli_query($con,$update);
    }
  if(isset($_POST['alamat'])) {
    $alamat=$_POST['alamat'];
    $update="update pengguna set alamat='$alamat' where id_user='$iduser'";
    $query=mysqli_query($con,$update);
    }
  if(isset($_POST['nohp'])) {
    $nohp=$_POST['nohp'];
    $update="update pengguna set no_hp='$nohp' where id_user='$iduser'";
    $query=mysqli_query($con,$update);
    }
    ?>
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">Pendaftaran Berhasil</div>
						<div class="panel-body">Silahkan lanjutkan ke <a href="#">Halaman User</a> atau langsung <a href="lapor.php">laporkan barang temuan.</a></div>
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
			<div class="col-sm-4 col-sm-offset-4">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">Pendaftaran Gagal</div>
						<div class="panel-body">Terdapat masalah teknis saat melakukan pendaftaran. Silahkan <a onclick="window.back()" >kembali</a> lalu coba lagi.</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }
footer(); ?>
