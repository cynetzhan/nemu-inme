<?php
include "function.php";
if(checkSessionBool()){
	header('Location:dashboard.php');
} else {
	headBanner('pub');
}
?>
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="panel panel-default">
					<div class="panel-heading">Form Pendaftaran</div>
					<div class="panel-body">
						
				<form name="register" action="prosesdaftar.php" method="post">
					<div class="form-group">
							<label for="username">Nama Pengguna</label>
							<input type="text" class="form-control" name="username" minlength="4" maxlength="25" required>
					</div>
					<div class="form-group">
							<label for="passwd">Password</label>
							<input type="password" class="form-control" minlegth="6" maxlength="30" name="passwd" required>
					</div>
					<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" class="form-control" name="email" maxlength="45" required>
					</div>
					<div class="form-group">
							<label for="namalkp">Nama Lengkap</label>
							<input type="text" class="form-control" name="namalkp" maxlength="35">
					</div>
					<div class="form-group">
							<label for="alamat">Alamat</label>
							<input type="text" class="form-control" name="alamat" maxlength="85">
					</div>
					<div class="form-group">
							<label for="nohp">Nomor Telepon/HP</label>
							<input type="tel" class="form-control" name="nohp" maxlength="15">
					</div>
					<button type="submit" formtarget="register">Daftar</button>
			</form>
			<p>Dengan mendaftar ke nemu-in.com, anda menyetujui <a href="terms.php">Syarat dan Kebijakan</a> yang berlaku.</p>
			</div>
				</div>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>
</div>
<?php footer(); ?>
</body>
</html>
  
  
  
    
