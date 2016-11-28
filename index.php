<?php
include "function.php";
$con=koneksi();
if($cek=checkSessionBool()){
 $username=$_SESSION['username'];
 headBanner($username);
} else {
	headBanner();
}
?>
	<div class="jumbotron judul-page"><a name="top"></a>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="covercontent">
						<h2>Temukan barang anda yang hilang disini!</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid focus-section">
		<div class="row">
			<div class="col-xs-12">
				<h1>Barang kamu hilang? Coba cari disini. Siapa tahu ketemu</h1>
				<div class="sidecon">
					<form name="carijenis" method="post" action="pencarian.php">
					<?php optionJenisBarang(); ?>
					<button type="submit" class="btn btn-default btn-md form-control">Cari</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container content-section">
		<div class="row">
			<div class="col-xs-12">
				<h2>Barang yang baru-baru ini ditemukan</h2>
				<div class="wrap-white">
				<div class="row">
<?php
$select="select jenis_barang,lokasi,id_laporan from laporan	order by waktu desc limit 4";
$query=mysqli_query($con,$select);
while($row=mysqli_fetch_assoc($query)){
?>
					<div class="col-sm-2">
						<a href="laporan.php?id=<?php echo $row['id_laporan']; ?>" class="thumbnail">
							<img src="ico/book.png" alt="bookico">
							<p><strong><?php echo $row['jenis_barang']; ?></strong><br>di <?php echo $row['lokasi']; ?></p>
						</a></div>
<?php } ?>
					<div class="col-sm-4">
						<a href="pencarian.php" class="thumbnail">
							<h2>Cari lebih banyak di<br><strong>Pencarian</strong></h2>
						</a>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	<?php if(!$cek) { ?>
	<div class="container-fluid focus-section"><a name="daftar"></a>
		<div class="row">
			<div class="col-xs-12">
				<h1>Atau kamu menemukan barang yang bukan milikmu? Laporkan kesini!</h1>
			</div>
		</div>
	</div>
	<div class="container content-section">
		<div class="row">
			<div class="col-sm-6">
				<img class="img-responsive" src="illust.png" alt="illustrasi" style="height:500px;margin:0 auto;"/>
			</div>
			<div class="col-sm-6">
				<div class="wrap-white" id="registerfront" >
				<legend><h3>Yuk! Gabung bersama-sama untuk membantu orang-orang menemukan barang mereka yang hilang.<br><small>Cukup masukkan email, nama pengguna dan password untuk bergabung.</small></h3></legend>
				<form role="register" class="register-form" action="prosesdaftar.php" method="post" name="register">
					<div class="form-group">
							<input type="email" class="form-control" name="email" placeholder="Email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="username" minlength="4" maxlength="30" placeholder="Nama Pengguna" required>
					</div>
					<div class="form-group">
									<input type="password" class="form-control" minlength="6" maxlength="30" name="password" placeholder="Password" required>
					</div>
					<button type="submit" class="btn btn-default btn-md form-control"><strong>Daftar</strong></button>
				</form>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
	<div class="container-fluid focus-section"><a name="tentang"></a>
		<div class="row">
			<div class="col-xs-12">
				<h1>Tentang <strong>nemu-in</strong></h1>
			</div>
		</div>
	</div>
	<div class="container content-section">
		<div class="row">
			<div class="col-sm-6">
				<img src="illust2.png" alt="illustrasi" class="img-responsive" >
			</div>
			<div class="col-sm-6">
				<div class="wrap-white">
				<p class="text-justify" id="about">
					<img src="logo-big.png" class="img-responsive"><br>
					<strong>nemu-in.com</strong> adalah situs yang menyediakan layanan pelaporan penemuan dan pencarian barang yang hilang secara online. Barang temuan yang tersedia di situs ini dilaporkan oleh pengguna terdaftar. Situs ini terwujud atas sebuah pertanyaan <em>"Bisakah saya mencari barang saya yang hilang di internet?"</em>. Internet dengan segala teknologi yang ada di dalamnya dapat memudahkan masalah siapapun, termasuk masalah kehilangan barang. Kami ingin menjadikan <strong>nemu-in.com</strong> sebagai direktori pencarian barang hilang yang terpercaya.</p>
			</div>
		</div>
		</div>
	</div>
<?php footer() ?>
</body>
</html>
