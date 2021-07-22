<?php 
require('conn.php');

	
	$sql = "DELETE FROM `tbl_lichsu`";
	$result = mysqli_query($conn, $sql);

	header('Location:history.php');

 ?>