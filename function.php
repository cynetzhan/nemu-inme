<?php
function koneksi(){
	$koneksi = mysqli_connect("103.28.22.75","nemuinme_user","g8XaZKzg0ta@");
	//$koneksi = mysqli_connect("localhost","root","");
	mysqli_select_db($koneksi,"nemuinme_db");
	//mysqli_select_db($koneksi,"nemudb");
	if(!$koneksi){
	die("could not connect ".mysqli_error($koneksi));
	}
	return $koneksi;
}

function getId($usernm){
	$con=koneksi();
	$select="select id_user,username from pengguna where username='$usernm' limit 1";
	$query=mysqli_query($con,$select);
	$iduser="";
	if($query){
	$row=mysqli_fetch_array($query);
	$iduser=$row['id_user'];
	}
	return $iduser;
}

function getUser($id){
	$con=koneksi();
	$select="select id_user,username from pengguna where id_user='$id' limit 1";
	$query=mysqli_query($con,$select);
	if($query){
	$row=mysqli_fetch_array($query);
	$username=$row['username'];
	}
	return $username;
}

function checkSession(){
	session_name('loginusernemu');
	session_start();

	if (!isset($_SESSION['username'])) {
		header('Location:login.php');
	}
}

function checkSessionBool(){
	session_name('loginusernemu');
	session_start();
	$cek = false;
	if(isset($_SESSION['username'])) {
		$cek = true; }
		return $cek;
}

function getLaporan($id){
	$con=koneksi();
	$select="select id_laporan,jenis_barang, lokasi, id_user from laporan where id_laporan='$id'";
	$query=mysqli_query($con,$select);
	return mysqli_fetch_array($query);
}

function getKomentar($idklaim){
	$con=koneksi();
	$select="select * from klaim_komentar where id_klaim='$idklaim' order by waktu_komentar desc";
	$query=mysqli_query($con,$select);
	return mysqli_fetch_array($query);
}

function getLaporanUser($id,$limit){
	$con=koneksi();
	$select="select * from laporan where id_user='$id' limit $limit";
	$query=mysqli_query($con,$select);
	if(mysqli_num_rows($query)>0) {
	while($row=mysqli_fetch_array($query)){
	?>
  <tr>
    <td><?php echo $row['jenis_barang']; ?></td>
    <td><?php echo "<strong>".lokasiCek($row['lokasi'])."</strong><br>".alamatCek($row['alamat']); ?></td>
    <td><?php echo $row['waktu']; ?></td>
    <td><a href="laporan.php?id=<?php echo $row['id_laporan']; ?>">Lihat</a></td>
  </tr>
<?php }
} else {
?>
  <tr>
    <td colspan="5" id="infosc">Belum ada laporan.</td>
  </tr>
<?php }
}

function lokasiCek($lok){
	if($lok=="null"){
		return "<em class='grey'>Nama lokasi tidak tersedia</em>";
	} else {
	return $lok;
	}
}

function alamatCek($lok){
	if($lok=="null"){
		return "<em class='grey'>Alamat tidak tersedia</em>";
	} else {
	return $lok;
	}
}

function getLastLaporan($limit){
	$con=koneksi();
	$select="select jenis_barang,lokasi,id_laporan from laporan	order by waktu desc limit $limit";
	$query=mysqli_query($con,$select);
	return mysqli_fetch_array($query);
}

function cekTelahKlaim($idlaporan,$iduser){
	$con=koneksi();
	$select="select id_klaim,id_laporan,id_user from klaim where id_laporan='$idlaporan' and id_user='$iduser'";
	$query=mysqli_query($con,$select);
	$num=mysqli_num_rows($query);
	if($num>0) {
		return true;
	} else {
		return false;
	}
}

function getKlaimId($idlaporan,$iduser){
	$con=koneksi();
	$select="select id_klaim,id_laporan,id_user from klaim where id_laporan='$idlaporan' and id_user='$iduser'";
	$query=mysqli_query($con,$select);
	$row=mysqli_fetch_array($query);
	return $row['id_klaim'];
}
function optionJenisBarang($jns=null) {
	?>
	<select name="jenisbarang" class="form-control" placeholder="Apa yang hilang?">
		<option disabled <?php if($jns==null) echo "selected"; ?> >Jenis Barang Apa Yang Hilang?</option>
		<optgroup label="Pilih Jenis Barang:">
		<option value="Alat Komunikasi" <?php if($jns=="Alat Komunikasi") echo "selected" ?> >Alat Komunikasi</option>
		<option value="ATK" <?php if($jns=="ATK") echo "selected" ?> >Alat Tulis Kantor</option>
		<option value="Mainan" <?php if($jns=="Mainan") echo "selected" ?> >Mainan</option>
		<option value="Pakaian" <?php if($jns=="Pakaian") echo "selected" ?> >Pakaian</option>
		<option value="Alat Elektronik" <?php if($jns=="Alat Elektronik") echo "selected" ?> >Alat Elektronik</option>
		<option value="Kendaraan" <?php if($jns=="Kendaraan") echo "selected" ?> >Kendaraan</option>
		<option value="Aksesoris" <?php if($jns=="Aksesoris") echo "selected" ?> >Aksesoris (perhiasan, dompet, jam dan lainnya)</option>
		<option value="Buku" <?php if($jns=="Buku") echo "selected" ?> >Buku</option>
		<option value="Orang" <?php if($jns=="Orang") echo "selected" ?> >Orang</option>
		<option value="Dokumen" <?php if($jns=="Dokumen") echo "selected" ?> >Dokumen Penting</option>
		</optgroup>
	</select>
	<?php
}
function postKomentar($id,$uid,$isi){
 $con=koneksi();
 $tgl=date('Y-m-d H:i:s');
 $insert="insert into klaim_komentar values('','$id','$uid','$tgl','$isi')";
 $query=mysqli_query($con,$insert);
 if($query){
		return true;
	} else {
		echo mysqli_error($con);
		return false;
	}
}

function headBanner($user='pub'){
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/custom-green.css">
 <!--link rel="stylesheet" href="css/base.css"-->
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "e77cb886-4df5-403d-a00a-c74b2f90ca53", doNotHash: true, doNotCopy: false, hashAddressBar: false});</script>
 <title>Nemu-In - Layanan Lapor Temu Barang</title>
</head>
<body>
 <nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
	 <div class="navbar-header">
		<a class="navbar-brand" href="index.php"><img src="logo-gr.png" class="img-responsive logo"></a>
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
	 </div>
	 <div id="navbar" class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
		  <li><a href="pencarian.php"><strong>Pencarian</strong></a></li>
		  <li><a href="about.php"><strong>Tentang Kami</strong></a></li>
		</ul>
<?php if($user=='pub'){ ?>
				<ul class="nav navbar-nav navbar-right nav-login">
				<li><a href="lapor.php"><span class="glyphicon glyphicon-plus"></span><strong> Laporkan</strong></a></li>
		  <li class="dropdown drop-login">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><span class="glyphicon glyphicon-user"></span><strong> Login</strong></a>
					<ul class="dropdown-menu" id="login">
						<li>
							<form name="login" action="login.php" method="post">
								<div class="form-group">
									<label for="username">Nama Pengguna</label>
									<input type="text" class="form-control" name="username" maxlength="25" required>
								</div>
								<div class="form-group">
									<label for="passwd">Password</label>
									<input type="password" class="form-control" name="passwd" required>
								</div>
								<button type="submit" name="submitbutton" class="btn btn-md btn-primary form-control">Login</button>
							</form>
							<a href="daftar.php">Belum punya akun? Buat Disini!</a>
						</li>
					</ul>
		  </li>		  
		</ul>
		</nav>
	<?php } else { ?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="lapor.php"><span class="glyphicon glyphicon-plus"></span><strong> Laporkan</strong></a></li>
		  <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><strong> <?php echo $user; ?></strong>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="ubahprofil.php">Ubah Data Diri</a></li>
            <li><a href="logout.php">Logout</a></li> 
          </ul>
        </li>
		</ul>
	 </div>
	</div>
 </nav>
	<?php
 }
}

function footer(){
?>
	<footer class="text-center">
		<a class="up-arrow" href="#top" data-toggle="tooltip" title="Kembali Ke Atas">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <ul class="list-inline">
			<li><a href="index.php">Beranda</a></li>-
			<li><a href="pencarian.php">Pencarian</a></li>-
			<li><a href="about.php">Tentang Kami</a></li>-
			<li><a href="terms.php">Aturan dan Kebijakan</a></li>
		</ul>
		<p>&copy; Copyright 2016 oleh <span class="label label-default">Kelompok Lima</span></p>
	</footer>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
}

function frontModule1(){
?>
<script>
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top-50
        }, 1000);
        return false;
      }
    }
  });
});
</script>
<?php
}

function sidebar(){
?>
<div class="panel-group">
	<div class="panel panel-default">
		<div class="panel-heading">Laporan Saya</div>
		<div class="panel-body">
			<div class="list-group">
				<a class="list-group-item" href="lapor.php">Lapor Penemuan Barang</a>
				<a class="list-group-item" href="laporanuser.php">Lihat Laporan Penemuan</a>
				<!--a class="list-group-item" href="laporanhilanguser.php">Lihat Laporan Kehilangan</a-->
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">User</div>
		<div class="panel-body">
			<ul class="list-group">
				<a class="list-group-item" href="dashboard.php">Dashboard</a>
				<a class="list-group-item" href="ubahprofil.php">Ubah Data Diri</a>
				<a class="list-group-item" href="ubahpass.php">Ubah Password</a>
				<a class="list-group-item" href="logout.php">Logout</a>
			</ul>
		</div>
	</div>
</div>
<?php
}

function klaimList($idlaporan){
$con=koneksi();
$select="select klaim.id_klaim, pengguna.username, klaim.id_laporan, klaim.tgl_klaim from klaim join pengguna on klaim.id_user = pengguna.id_user where klaim.id_laporan='$idlaporan'";
$query=mysqli_query($con,$select);
?>
<div class="panel panel-default">
	<div class="panel-heading">Klaim Milik</div>
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Klaim Oleh</th>
					<th>Tanggal</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php while($row=mysqli_fetch_array($query)) { ?>
				<tr>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['tgl_klaim']; ?></td>
					<td><?php echo "<a href='klaim.php?id=".$row['id_klaim']."'>Lihat</a>" ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php
}

?>

