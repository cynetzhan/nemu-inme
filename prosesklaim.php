<?php
include 'function.php';
$con=koneksi();
if(checkSessionBool()){
 $username=$_SESSION['username'];
 $iduser=getId($username);
}
$idlapor=$_POST['idlapor'];
$klaim=$_POST['klaim'];
$tgl=date('Y-m-d');
$insert="insert into klaim values('','$iduser','$idlapor','$klaim','$tgl','0')";
$query=mysqli_query($con,$insert);
if($query){
?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Klaim Terkirim!</h4>
  </div>
  <div class="modal-body">
    <p>Terima Kasih. Klaim anda akan ditindak lanjuti oleh pelapor. Cek kembali di dashboard beberapa waktu lagi untuk mengetahui status klaim anda.</p>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
  </div>
<?php } else {
  ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Klaim Tidak Terkirim!</h4>
  </div>
  <div class="modal-body">
    <p>Maaf, ada gangguan teknis. Mohon tutup dialog ini lalu coba klaim kembali.</p>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
  </div>
<?php } ?>
