<?php
include "function.php";
$con=koneksi();
$ownLapor=false;
if(checkSessionBool()){
 $username=$_SESSION['username'];
 headBanner($username);
} else {
	header('Location:login.php');
}

$id=$_GET['id'];
$select="select * from klaim where id_klaim='$id'";
$query=mysqli_query($con,$select);
$row=mysqli_fetch_array($query);
$iduser=$row['id_user'];
if(getId($_SESSION['username'])==$iduser) {
	$ownLapor=true;
 }
?>
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-7">
				<div class="panel panel-default">
					<div class="panel-heading">Rincian Klaim</div>
					<div class="panel-body">
						<table class="table table-striped">
							<tr>
								<td>Klaim oleh</td>
								<td><a href="profil.php?user=<?php echo $row['id_user'] ?>"><?php echo getUser($row['id_user']); ?></a></td>
							</tr>
							<tr>
								<td>ID Laporan</td>
								<td><a href="laporan.php?id=<?php echo $row['id_laporan']; ?>"><?php echo $row['id_laporan']; ?></a></td>
							</tr>
							<tr>
								<td>Tanggal Klaim</td>
								<td><?php echo $row['tgl_klaim']; ?></td>
							</tr>
							<tr>
								<td>Isi Klaim</td>
								<td><?php echo $row['isi_klaim']; ?></td>
							</tr>
							<?php if(!$ownLapor){ ?>
							<tr>
								<td>Aksi</td>
								<td><a class="btn btn-md btn-primary" href="setujuiklaim.php?id=<?php echo $row['id_klaim']; ?>">Setujui</a></td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Komentar</div>
					<div class="panel-body">
						<table class="table table-striped">
						<?php
							$select="select * from klaim_komentar where id_klaim='$id' order by waktu_komentar desc";
							$query=mysqli_query($con,$select);
						?>
							<tr>
								<th>Kolom Komentar</th>
							</tr>
							<tr>
								<form name="komentar" method="post" action="proseskomentar.php">
									<input type="hidden" name="iduser" value="<?php echo $row['id_user'] ?>">
									<input type="hidden" name="idklaim" value="<?php echo $id ?>">
									<textarea name="isi"></textarea><br>
									<button type="submit">Kirim</button>
								</form>
							</tr>
						<?php while($row=mysqli_fetch_array($query)) { ?>
							<tr>
								<td><?php echo getUser($row['id_user'])." - ".$row['waktu_komentar']; ?></td>
							</tr>
							<tr>
								<td><?php echo $row['isi_komentar']; ?></td>
							</tr>
						<?php } ?>
						</table>
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="panel panel-default">
					<div class="panel-heading">Aksi</div>
					<div class="panel-body"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php footer(); ?>
</body>
</html>
