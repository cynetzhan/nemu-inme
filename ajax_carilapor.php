<?php
include 'function.php';
$con=koneksi();
$jns=$_GET['jenis'];
$lat=$_GET['lat'];
$lng=$_GET['lng'];
$select="SELECT id_laporan,jenis_barang,lokasi,alamat,waktu,id_user,( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$lng.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) ) AS distance FROM laporan where jenis_barang='".$jns."' HAVING distance < 0.3 ORDER BY distance";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0) {
while($row=mysqli_fetch_array($query)){
?>
  <tr>
    <td><?php echo $row['jenis_barang']; ?></td>
    <td><?php echo "<strong>".$row['lokasi']."</strong><br>".$row['alamat']; ?></td>
    <td><?php echo getUser($row['id_user']); ?></td>
    <td><?php echo $row['waktu']; ?></td>
    <td><a href="laporan.php?id=<?php echo $row['id_laporan']; ?>">Lihat</a></td>
  </tr>
<?php }
} else {
?>
  <tr>
    <td colspan="5" id="infosc">Laporan tidak ditemukan.</td>
  </tr>
<?php } ?>
