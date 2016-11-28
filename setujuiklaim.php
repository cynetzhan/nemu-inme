<?php
include "function.php";
$con=koneksi();
if(checkSessionBool()){
 $username=$_SESSION['username'];
 headBanner($username);
} else {
	header('Location:login.php');
}
$id=$_GET['id'];
$update="update klaim set status=1 where id_klaim=$id";
$query=mysqli_query($con,$update);
echo mysqli_error($con);
if($query){
	$select="select id_laporan from klaim where id_klaim=$id";
	$query=mysqli_query($con,$select);
	echo mysqli_error($con);
?>
<div class="content-wrapper">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Berhasil Klaim!</div>
			<div class="panel-body">
				<p><a href="laporan.php?id=<?php echo $idlaporan['id_laporan']; ?>">Kembali ke laporan.</a></p>
			</div>
		</div>
	</div>
</div>
<?php } else {
?>
<div class="content-wrapper">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Gagal Klaim!</div>
			<div class="panel-body">
				<p>Terjadi kesalahan. <a href="klaim.php?id=<?php echo $id; ?>">Kembali ke klaim</a></p>
			</div>
		</div>
	</div>
</div>
<?php } ?>
