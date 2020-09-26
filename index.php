<?php
	session_start();
	require("libraries/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Phòng Khám Đa KHoa Việt Hàn</title>
<link href="css/style.css" rel="stylesheet" type="text/css"  />

<link href="css/jquery.bxslider.css" rel="stylesheet" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
<script src="script/nivo.js" type="text/javascript"></script>
<script src="ajax/ajax.js" type="text/javascript"></script>

</head>
<body>
	<div id="header">
    	<div id="header_top">
        	<?php
            	require("views/logo.php");
			?>
            <div class="header_menu">
               <?php 
					$msql = "select * from menu where menu_trangthai = '1' order by menu_order asc";
					$mresult = mysqli_query($conn,$msql);
				?>
				<ul>
    				<li class="menu_cap1"><a href="<?php echo BASEURL."index.php"; ?>">Trang chủ</a></li>
					<?php  while($menu = mysqli_fetch_assoc($mresult)){ ?>
					<li class="menu_cap1"><a href="<?php echo BASEURL."index.php?page=menu&act=list&menuid=".$menu['menu_id']; ?>"><?php echo $menu['menu_name']; ?></a></li>
					<?php } ?>
                    <li class="menu_cap1"><a href="dathen.php">Đặt Hẹn</a></li>
                    <li class="menu_cap1"><a href="benhan.php">Bệnh Án</a></li>
				</ul>
          	</div>
        </div>
    </div>
    <div id="conten">
    	<?php
        	require("views/slile.php");
		?>
        <div id="main">
        	<div id="left_main">
            	<?php 
					if(isset($_GET['page'])){
						switch($_GET['page']){
							case "menu" : require("modules/menu/controller.php");	break;
						}
					}else{
						require("left_main.php");
					}
				?>
            </div>
            <div id="right_main">
            	<?php 
					require("views/support.php"); 
					require("views/images.php");
				?>
    </div>
    <div id="footer">
    	<div id="footer_center">
        	<div id="footer_left">
            	<p>Việt - Hàn Hospital</p>
				<p>Cơ sở 1: Số 9 Ngô Thì Nhậm - Hai Bà Trưng - Hà Nội </p>
				<p>Tel: 04.39454688 - 04.39454690 * Fax: 04.39454689</p>
				<p>Cơ sở 2: Tầng 1&2 Tòa nhà FLC Lê Đức Thọ - Mỹ Đình - Hà Nội</p>
				<p>Tel: 04.37955255 – 04.37955355 * Fax: 04.37955289 </p>
            </div>
            <div id="footer_right">
            	<a href="#">
                	<img src="images/home_footer.png" />
                </a>
                <a href="#" style=" margin:3px 0px 0px 3px;">Trang chủ</a>
                <br />
                <p><a href="https://www.facebook.com/caotung.ong">CopyRight @CAOTUNG</a></p>
            </div>
        </div>
    </div>
</body>
</html>
