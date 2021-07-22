<?php
session_start();
if(isset($_SESSION['us']) && $_SESSION['us']==="AdminVip"){
	?> 
<p><?php echo "Chào: ".$_SESSION['us']; ?><a href="./logout.php"> Đăng xuất</a> | <a href="index.php">Trở về</a></p>
  
  <?php
}
else{
  header("Location:index.php");
}
require 'conn.php';
$num =0;
$sql = "SELECT * FROM `tbl_lichsu` ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
?>
	<!DOCTYPE html>
 <html>
 <head>
 	<title>Lịch sử chỉnh sửa</title>
 	<meta charset="utf-8">
 	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 	 <link rel="stylesheet" type="text/css" href="./css/stylehis.css">
 	 <link rel="icon" href="./img/fav.png" type="image/gif" sizes="24x24">
 </head>
 <body>
<div class="container col-sm-7 mt-5 text-right">
	<?php if($num === 0 ){?>
	<p class="text-center"><b>Lịch sử chỉnh sửa trống!! <a href="danhsach.php">Quay về trang danh sách</a></b></p>
	<?php } ?>
	<?php if($num !== 0 ){ ?><div class="text-right mb-4"><a class="btn btn-danger" onclick="hien()">Xóa tất cả</a></div>
	<?php } ?>
	<div class="pr-4 pt-4" style="overflow:auto;height: 500px">
 <?php 
while ($row = mysqli_fetch_assoc($result)) {?>
	
		<p>
			<?php echo $row['lichsu'];?> vào lúc <?php echo $row['time'];?> | 
			<a href="deletehistory.php?id=<?php echo $row['id'];?>"> Xóa</a>
		</p>
	
<?php } ?>
</div>
<div id="msg" class="msg-delete">
            <div class="table-msg-delete">
                <h2> Xóa nhân viên này?</h2>
                    <a class="btn btn-danger btn-msg-delete" href="deleteAll.php?>">
                        <b>Xóa</b></a>
                    <a class="btn btn-secondary btn-msg-back" onclick="an()">
                    <b>Trở về</b></a>
            </div>
        </div>
<script >
  function an(){
    document.getElementById("msg").style.display = "none";}
  function hien(){
    document.getElementById("msg").style.display = "block";
}

</script>

 </body>
 </html>
