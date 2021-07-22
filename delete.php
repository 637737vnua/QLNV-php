<?php 
date_default_timezone_set('Asia/Bangkok');
session_start();
require 'conn.php';

$time = date("g:i a,j F, Y "); 
$user_id = (int)$_GET['ID'];
$user_id = isset($_GET['ID']) ? $_GET['ID'] : false;
$user_id = str_replace('/[^0-9]/', '', $user_id);

$sqll = "SELECT * FROM `tbl_quan-li-nhan-vien` WHERE `ID` = {$user_id}";
$result =  mysqli_query($conn, $sqll);
$info = mysqli_fetch_assoc($result);
$manv = $info['manv'];

if (isset($_GET['ID'])) {
$sql = " DELETE FROM `tbl_quan-li-nhan-vien` WHERE `ID` = {$user_id}";

if($_SESSION['us']!=="AdminVip"){
  $add = $_SESSION['us']." đã xóa nhân viên ".$manv;
  $sqlhis = "INSERT INTO `tbl_lichsu`(`lichsu`,`time`) VALUES ('$add','$time')";
  $resulthis = mysqli_query($conn, $sqlhis);
}
if (!mysqli_query($conn, $sql)) {
	die('Loi: '. mysqli_error($conn));
}

header("Location: index.php");	
}else{
header("Location: index.php");
}
 ?>