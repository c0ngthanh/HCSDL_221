<?php
    require_once 'connection.php';
    $ID = $_GET['ID'];
    $delete_sql2 = "DELETE from hocvien where ID='$ID'";
    mysqli_query($conn,$delete_sql2);
    header("Location: hocvien.php");
?>
