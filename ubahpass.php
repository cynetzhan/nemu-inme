<?php
include 'function.php';
$con=koneksi();
if(checkSessionBool()){
 $username=$_SESSION['username'];
	$select="select user_id from pengguna where username='$username'";
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
		<div class="panel-heading">Ubah Password</div>
		<div class="panel-body">
			<form name="editpass" id="editpass" action="prosespass.php" method="post">
					<div class="form-group">
							<label for="username">Password Lama</label><br>
							<input type="password" class="form-control" name="oldpass" maxlength="15">
							<input type="hidden" name="userid" value="<?php echo $row['id_user']; ?>">
					</div>
					<hr>
					<div class="form-group">
							<label for="username">Password Baru</label><br>
							<input type="password" class="form-control" name="newpass" maxlength="15">
					</div>
					<div class="form-group">
							<label for="username">Konfirmasi Password Baru</label><br>
							<input type="password" class="form-control" name="newpassc" maxlength="15">
					</div>
					<button type="submit" class="form-control btn btn-success" form="editpass">Ubah Password</button>
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
