<?php
    require('conn.php');
    if (session_id() === '') session_start();
    $item_page = !empty($_GET['item_page'])?$_GET['item_page']:10;
    $page = !empty($_GET['page'])?$_GET['page']:1;
    $ofset =($page-1)*$item_page;
    $sql = " SELECT * FROM `tbl_quan-li-nhan-vien` ORDER BY `ID` ASC LIMIT $item_page OFFSET $ofset ";
    $total = mysqli_query($conn, " SELECT * FROM `tbl_quan-li-nhan-vien` ");
    $num = mysqli_num_rows($total);
    $totalitem = ceil($num / $item_page);
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/home2.css">
    <title>Trang chủ</title>
</head>
<body>
    <!-- header  -->
    <div class="header">
        <div class="logo">
            <a href="index.php">Team 3</a>
            <span>Ver 1.3</span>
        </div>
        <div class="menu_pc">
            <div class="items-header">
            <a href="index.php">Trang chủ</a>
            </div>
            <div class="items-header">
                <a href="tracuu.php">Tra cứu</a>
            </div>
            <div class="items-header">
                <a href="team.php">Team 3</a>
            </div>
            <?php if (isset($_SESSION['us']) && $_SESSION['us']) {?>
            <div class="items-header">
                <a href="insert.php">Thêm nhân viên</a>
            </div>
            <?php if($_SESSION['us']==="AdminVip"){ ?>
            <div class="items-header">
                    <a href="history.php">Lịch sử</a>
            </div><?php }} ?>
            <div class="items-header_auth">
            <?php if (isset($_SESSION['us']) && $_SESSION['us']) {?>
                <a href="./logout.php">Đăng xuất</a>
            <?php } else { ?>
                <a href="./login.php">Đăng nhập</a>
            <?php } ?>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['us']) && $_SESSION['us']) {?>
        <div class = "name_user">
           <i class = "fas fa-user"></i> <?php echo $_SESSION['us']; ?>
        </div>
    <?php } ?>
    <!-- content -->
    <?php if (isset($_SESSION['us']) && $_SESSION['us']) {?>  
    <div class="main_home">
        <div class="search">
            <form class="m-auto col-sm-9 col-xl-7" action="timkiem.php">
                <input type="text" name="tukhoa" placeholder="Nhập tên nhân viên ...">
                <button>Tìm kiếm</button>
            </form>
        </div>
        <div class="text_home-2 p-2">
            <?php echo "Tổng nhân viên hiện có: ".$num; ?>
            <span style="float:right">Tổng lương chi trả: <span id="total"></span></span> 
        </div>
        <script>
        var count = 0;
        var unti = 'triệu';
            <?php 
            while ($count = mysqli_fetch_assoc($total)) {
            ?>
            var total = <?php echo $count['luong'] ?>;
                count += total;
            <?php } ?>
            document.getElementById('total').innerHTML = count + " " + unti +"/tháng";
        </script>
        <div class="pagination">
            <div class="page-item">
                <a class="page-link" href="?item_page=<?=$item_page?>&page=<?=$page-1?>"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            </div>
            <?php for ($num=1; $num <= $totalitem ; $num++) { 
              if ($num != $page) { 
            ?>
            <div class="page-item">
                <a class="page-link" href="?item_page=<?=$item_page?>&page=<?=$num?>"><b><?=$num?></b></a>
            </div>
            <?php }
            else{ ?>
            <div class="page-item ">
                <strong style="background:#5826f1;color: white" class="page-link"><?=$num?></strong>
            </div>
                <?php $so=$num;}}?>
            <div class="page-item">
                <a class="page-link" href="?item_page=<?=$item_page?>&page=<?php if ($totalitem > $page) {?><?=$page+1?><?php } else {?><?=$totalitem?><?php  } ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
        </div>
        <!-- <div class="container"> -->
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Mã nhân viên</th>
                        <th scope="col">Tên nhân viên</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Phòng ban</th>
                        <th scope="col">Chức vụ</th>
                        <th scope="col">Lương/tháng</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td> <?php echo $row['manv'] ?></td>
                        <td> <?php echo $row['tennv']; ?></td>
                        <td> <?php echo $row['diachi']; ?></td>
                        <td> <?php echo $row['sdt'] ?></td>
                        <td> <?php echo $row['phongban']; ?></td>
                        <td> <?php echo $row['chucvu']; ?></td>
                        <td> <?php echo $row['luong']; ?> triệu</td>  
                        <td>
                            <a class="btn btn-danger" 
                            href="?item_page=<?=$item_page?>&page=<?=$so?>&ID= <?php echo $row['ID'];?>">Xóa</a>
                        </td>
                        <td>
                            <a class="btn btn-info" href="update.php?ID= <?php echo $row['ID'];?>">Sửa</a>
                        </td>
                    </tr>
                <?php
                $id = !empty($_GET['ID'])?$_GET['ID']:"";
                if ($id == $row['ID']) {
                ?>
                <div class="msg-delete">
                    <div class="table-msg-delete">
                        <h2> Xóa nhân viên này?</h2>
                            <a class="btn btn-msg-delete btn-danger" href="delete.php?item_page=<?=$item_page?>&page=<?=$so?>&ID=<?=$id?>">
                                <b>Xóa</b></a>
                            <a class="btn btn-msg-back btn-secondary" href="?item_page=<?=$item_page?>&page=<?=$so?>" >
                                <b>Trở về</b></a>
                    </div>
                </div>
                <?php
                }
                ?>
                <?php
                    }
                ?>    
                </tbody>
            </table>
        <!-- </div> -->
    </div>
    <?php } else { ?>
    <!-- home 2 -->
    <div class="home_background">
        <div class="text_home-1">
            Quản lí, tra cứu thông tin nhân viên Team 3
        </div>
        <div class="btn btn_home">
           <a href="./login.php">Đăng nhập hệ thống quản lí</a> 
        </div>
    </div>
    <?php } ?>
    <!-- footer  -->
    <div class="footer">
        <span>Design by Team 3 || © Bản quyền thuộc về Team 3</span>
    </div>
</body>
<script src="https://kit.fontawesome.com/882f0e5447.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>