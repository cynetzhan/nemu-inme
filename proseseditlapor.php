<?php
include 'function.php';
$con=koneksi();
if(checkSessionBool()){
 $username=$_SESSION['username'];
 headBanner($username);
 $iduser=getId($username);
} else {
	header('Location:login.php');
}
$laporid=$_POST['laporid'];
$jns=$_POST['jenisbarang'];
$desc=$_POST['deskripsi'];
$lt=$_POST['latpost'];
$ln=$_POST['lngpost'];
$loc=$_POST['lokasipost'];
$adr=$_POST['addresspost'];
//$date=date('Y-m-d H:i:s');
$insert="update laporan set jenis_barang='$jns',deskripsi='$desc',latitude='$lt',longitude='$ln',lokasi='$loc',alamat='$adr' where id_laporan='$laporid'";
$query=mysqli_query($con,$insert);

if($query){
  echo "<div class='alert alert-success'><strong>Laporan telah diubah!</strong> Terima kasih telah berkontribusi.";
} else {
  echo "<div class='alert alert-success'><strong>Kesalahan!</strong> Terdapat gangguan teknis yang membuat laporan anda tidak terkirim.";
}
  echo "<a onclick='windows.back()'>Kembali</a></div>";
?>
