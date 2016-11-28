<?php
include 'function.php';
$con=koneksi();
if(checkSessionBool()){
 $username=$_SESSION['username'];
	$select="select * from pengguna where username='$username'";
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
      <div class="panel panel-default">
		<div class="panel-heading">Ubah Profil</div>
		<div class="panel-body">
			<form name="editprofil" id="editprofil" action="prosesprofil.php" method="post">
					<div class="form-group">
							<label for="username">Nama Pengguna</label><br>
							<input type="text" class="form-control" name="username" value="<?php echo $row['username'];?>" readonly>
							<input type="hidden" name="userid" value="<?php echo $row['id_user']; ?>">
					</div>
					<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
					</div>
					<hr>
					<div class="form-group">
							<label for="namalkp">Nama Lengkap</label>
							<input type="text" class="form-control" name="namalkp" maxlength="35" value="<?php echo $row['nama_lengkap']; ?>">
					</div>
					<div class="form-group">
							<label for="alamat">Alamat</label>
							<input type="text" class="form-control" name="alamat" maxlength="85" value="<?php echo $row['alamat']; ?>">
					</div>
					<div class="form-group">
							<label for="nohp">Nomor Telepon/HP</label>
							<input type="tel" class="form-control" name="nohp" maxlength="15" value="<?php echo $row['no_hp']; ?>">
					</div>
					<button type="submit" class="form-control btn btn-success" form="editprofil">Ubah Profil</button>
			</form>
		</div>
      </div>
    </div>
  </div>
</div>
</div>
<?php footer(); ?>
</body>
</html>
