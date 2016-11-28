<?php
include 'function.php';
headBanner();
$con=koneksi();
$ceklog=true;
  if(!empty($_POST)){
    $username = $_POST['username'];
    $password = md5($_POST['passwd']);
    $sql = "select * from pengguna where username = '$username' and password = '$password'";
    $query = mysqli_query($con,$sql) or die (mysqli_error());
    if($query){
      $row = mysqli_num_rows($query);
      $a = mysqli_fetch_array($query);
      if($row > 0){
							session_name('loginusernemu');
							session_start();
       $_SESSION['username'] = $a['username'];
       header('Location:dashboard.php');
      } else {
							$ceklog=false;
						}
    }
  }
?>
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="wrap-white">
					<p><h1>Login Ke Nemu-In</h1>
					Dengan memiliki akun Nemu-In, anda dapat:
					 <ol>
							<li>Melaporkan barang temuan anda atau melaporkan barang anda yang hilang.</li>
							<li>Berinteraksi dengan penemu barang anda</li>
					 </ol>
					</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">Form Login</div>
					<div class="panel-body">
						<?php if(!$ceklog){ ?><div class="alert alert-danger">Nama Pengguna atau Password yang anda masukkan salah.</div><?php } ?>
						<form name="login" action="login.php" method="post">
								<div class="form-group">
										<input type="text" name="username" class="form-control" minlength="4" maxlength="25" placeholder="Nama Pengguna" required>
								</div>
								<div class="form-group">
										<input type="password" name="passwd" class="form-control" minlength="6" placeholder="Password" required>
								</div>
								<button type="submit" name="submitbutton" class="btn btn-md btn-primary">Login</button>
						</form>
						<a href="daftar.php">Belum punya akun? Buat Disini!</a>
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>
<?php footer(); ?>
</body>
</html>
  
  
  
    
