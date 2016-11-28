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
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="wrap-white">
					<h1><span class="glyphicon glyphicon-bookmark"></span> Tentang Nemu-In</h1>
					<img src="logo-big.png" class="img-responsive" style="width:200px;margin:0 auto"><br>
					<p class="text-justify" id="about">
					<strong>nemu-in.com</strong> adalah situs yang menyediakan layanan pelaporan penemuan dan pencarian barang yang hilang secara online. Barang temuan yang tersedia di situs ini dilaporkan oleh pengguna terdaftar. Situs ini terwujud atas sebuah pertanyaan <em>"Bisakah saya mencari barang saya yang hilang di internet?"</em>. Internet dengan segala teknologi yang ada di dalamnya dapat memudahkan masalah siapapun, termasuk masalah kehilangan barang. Kami ingin menjadikan <strong>nemu-in.com</strong> sebagai direktori pencarian barang hilang yang terpercaya.</p>
				</div>
				<div class="wrap-white">
					<h1><span class="glyphicon glyphicon-sunglasses"></span> Tentang Developer</h1>
					<p class="text-justify"></p>
				</div>
				<div class="wrap-white">
					<h1><span class="glyphicon glyphicon-earphone"></span> Kontak Kami</h1>
					
					<p class="text-justify"></p>
				</div>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>
</div>
<?php footer(); ?>
</body>
</html>
