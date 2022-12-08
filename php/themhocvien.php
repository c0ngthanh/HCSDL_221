<?php
$ten=$_POST['ten'];
$sdt=$_POST['sdt'];
$address=$_POST['address'];
$mail=$_POST['mail'];
$dayBorn=$_POST['dayBorn'];
$level=$_POST['level'];
$tendangnhap=$_POST['tendangnhap'];
$ID=$_POST['ID'];
require_once 'connection.php';
$update_sql1= "INSERT INTO hocvien values('$ID','$ten','$sdt','$address','$mail','$dayBorn','$level','$tendangnhap')";
echo $update_sql1;
mysqli_query($conn, $update_sql1);
header("Location: hocvien.php");
?>
