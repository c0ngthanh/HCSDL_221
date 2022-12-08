<?php
$ten=$_POST['ten'];
$sdt=$_POST['sdt'];
$address=$_POST['address'];
$mail=$_POST['mail'];
$dayBorn=$_POST['dayBorn'];
$level=$_POST['level'];
$tendangnhap=$_POST['tendangnhap'];
$sid=$_POST['sid'];
require_once 'connection.php';
$update_sql1= "UPDATE hocvien set TEN='$ten', SDT='$sdt', DIACHI='$address', MAIL='$mail', NAMSINH=$dayBorn, TRINHDODAUVAO='$level', TENDANGNHAP='$tendangnhap' where hocvien.ID = '$sid'";
echo $update_sql1;
mysqli_query($conn, $update_sql1);
header("Location: hocvien.php");
?>
