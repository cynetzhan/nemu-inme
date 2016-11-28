<?php
include 'function.php';
$con=koneksi();
checkSession();
$username=$_SESSION['username'];
$iduser=getId($username);
$select="select * from klaim where id_user='$id_user'";
$query=mysqli_query($con,$select);

?>
