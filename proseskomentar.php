<?php
include "function.php";
$con=koneksi();
$id=$_POST['idklaim'];
$uid=$_POST['iduser'];
$isi=$_POST['isi'];
$insert=postKomentar($id,$uid,$isi);
if($insert){
	header('Location:klaim.php?id='.$id.'');
} else {
	echo "Gagal";
}
?>
