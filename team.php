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
    <link rel="stylesheet" href="./css/imginfo1.css">
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
    <div class="main_home bg-light">
        <div class="container">
            <div class="text-center"><h1>Thành viên nhóm 3</h1></div>
            <div class="grid_info">
            <div class="info_img">
                <div class="img_user">
                    <img src="./img/khanh_.jpg" alt="">
                    <div class="flow_img ">
                    </div>
                </div>
                <label for="check1" class="border_img2"></label>
                <input class='check1' hidden type="checkbox" id="check1">
                <div class="show_info">
                    <div class="tab_cs">
                        <div class="close m-3">
                            <label for="check1"><i class="fas fa-times"></i></label>
                        </div>
                        <div class="title_tab-cs"><i class="fas fa-user-circle"></i> Trần Duy Khánh</div>
                        <div class="list_mission">
                            <div class="item_mission">
                                <div class="icon_ms"><i class="fas fa-check-circle"></i></i></div>
                                <div class="name_ms">Xây dựng chức năng tìm kiếm.</div>
                            </div>
                            <div class="item_mission">
                                <div class="icon_ms"><i class="fas fa-check-circle"></i></i></div>
                                <div class="name_ms">Xây dựng chức năng xác thực người dùng.</div>
                            </div>
                            <div class="item_mission">
                                <div class="icon_ms"><i class="fas fa-check-circle"></i></i></div>
                                <div class="name_ms">Xây dựng giao diện trang web.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border_img"></div>
            </div>
            <div class="info_img">
                <div class="img_user">
                    <img src="./img/truong_.jpg" alt="">
                    <div class="flow_img ">
                    </div>
                </div>
                <label for="check2" class="border_img2"></label>
                <input class='check1' hidden type="checkbox" id="check2">
                <div class="show_info">
                    <div class="tab_cs">
                        <div class="close m-3">
                            <label for="check2"><i class="fas fa-times"></i></label>
                        </div>
                        <div class="title_tab-cs"><i class="fas fa-user-circle"></i> Đặng Bá Trường</div>
                        <div class="list_mission">
                            <div class="item_mission">
                                <div class="icon_ms"><i class="fas fa-check-circle"></i></i></div>
                                <div class="name_ms">Thiết kế giao diện trang web.</div>
                            </div>
                            <div class="item_mission">
                                <div class="icon_ms"><i class="fas fa-check-circle"></i></i></div>
                                <div class="name_ms">Xây dựng chức năng thêm, sửa dữ liệu.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border_img"></div>
            </div>
            <div class="info_img">
                <div class="img_user">
                    <img src="./img/duc_.jpg" alt="">
                    <div class="flow_img ">
                    </div>
                </div>
                <label for="check3" class="border_img2"></label>
                <input class='check1' hidden type="checkbox" id="check3">
                <div class="show_info">
                    <div class="tab_cs">
                        <div class="close m-3">
                            <label for="check3"><i class="fas fa-times"></i></label>
                        </div>
                        <div class="title_tab-cs"><i class="fas fa-user-circle"></i> Nguyễn Minh Đức</div>
                        <div class="list_mission">
                            <div class="item_mission">
                                <div class="icon_ms"><i class="fas fa-check-circle"></i></i></div>
                                <div class="name_ms">Xây dựng database.</div>
                            </div>
                            <div class="item_mission">
                                <div class="icon_ms"><i class="fas fa-check-circle"></i></i></div>
                                <div class="name_ms">Xây dựng chức năng xóa dữ liệu.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border_img"></div>
            </div>
            </div>
        </div>
    </div>
    <!-- footer  -->
    <div class="footer">
        <span>Design by Team 3 || © Bản quyền thuộc về Team 3</span>
    </div>
</body>
<script>
    elementShow = document.querySelectorAll('.tab_cs');
     
    for ( var i = 0; i < elementShow.length; i ++) {
        elementShow[i].onmousemove = function (e) {
            event.preventDefault();
            e.stopPropagation();
        } 
    }
    
</script>
<script src="https://kit.fontawesome.com/882f0e5447.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>