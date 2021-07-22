<?php 
require('conn.php');
$id = (int)$_GET['id'];

if (isset($_GET['id'])) {
	
	$sql = "DELETE FROM `tbl_lichsu` WHERE `id`={$id}";
	$result = mysqli_query($conn, $sql);

	header('Location:history.php');
}

 ?>