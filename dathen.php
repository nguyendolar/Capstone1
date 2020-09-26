<?php
	session_start();
	require("libraries/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Đặt hẹn khám bệnh</title>
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
                    <li class="menu_cap1"><a href="benhan.php">Bệnh án</a></li>
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
            	<div class="left_main_dh_title">đặt hẹn</div>
            <div class="calender_dh">
                	<div class="calender_dh_title">đặt lịch tực tiếp</div>
                    <div class="show_dh">
                    <?php
						$ksql = "select * from chuyenkhoa";
						$kresult = mysqli_query($conn,$ksql);
					?>
                    <?php
                    	if(isset($_POST['ok'])){
							if($_POST['name'] == NULL){
								die("Bạn chưa nhập tên người khám");	
							}else{ 
								$name = $_POST['name'];
							}
							if($_POST['phone'] == NULL){
								die("Bạn chưa nhập số điện thoại");	
							}else{
								$phone = $_POST['phone'];	
							}
							if($_POST['bacsy'] == NULL){
								die("Bạn chưa chọn bác sỹ");	
							}else{
								$bacsy = $_POST['bacsy'];	
							}
							$date = $_POST['BookDate_tt'];
							$giokham = $_POST['giokham'];
							$sqllich = "select *from lichkham where bacsy_id = '$bacsy' and ngaykham = '$date' and giokham = '$giokham'";
							//echo $sqllich;
							//die;
							$resultlich = mysqli_query($conn,$sqllich);
							if(mysqli_num_rows($resultlich) > 4){
								echo("Bác sỹ đã có lịch bạn hãy chọn lịch khác");
								die;	
							}else{
								$sql = "insert into lichkham(ten_nguoikham,bacsy_id,ngaykham,giokham,dienthoai_lienlac) values('$name','$bacsy','$date','$giokham','$phone')";	
							}
							mysqli_query($conn,$sql);
							echo"Đặt lịch khám thành công chúng tôi sẽ liên hệ với bạn sau";
								
						}
					?>
                    	<form action="dathen.php" method="post" name="show">
                            	<table width:"100%" cellpadding="5" cellspacing="5">
                                	<tr>
                                    	<td width="100px">Tên người khám</td>
                                        <td>
                                        	<input type="text" name="name" />
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td width="100px">Điện thoại liên lạc</td>
                                        <td>
                                        	<input type="text" name="phone" />
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>Chuyên Khoa</td>
                                        <td>
                                        	<select name="khoa" class="form_book" onchange="getbacsy(this.value)">
                                            	<option value="0" selected="selected">-- Chọn Chuyên Khoa --</option>
                                            	<?php while($khoa = mysqli_fetch_assoc($kresult)){ ?>
          										<option value="<?php echo $khoa['khoa_id']; ?>"><?php echo $khoa['ten_khoa']; ?></option>
												<?php }?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>Bác Sỹ</td>
                                        <td>	
                                        	<select name="bacsy" class="form_book" id="bacsys">
                                            	
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>Ngày Hẹn</td>
                                        <td>
                                        	<link type="text/css" rel="stylesheet" href="css/calender.css" media="screen">
                							<script type="text/javascript" src="script/calender.js"></script>
              								<script language="javascript">var pathToImages = "/core/calendar/images/"; </script>
                							<input type="text" value="2014-05-16" readonly="" name="BookDate_tt" id="BookDate_tt" style="width:178px;height:22px;background:#e8e8e8; border:1px solid #adadad;">
                                            <input type="button" value="" onclick="displayCalendar(BookDate_tt,'yyyy-mm-dd',this)" style="background:url(images/DateIcon.gif) no-repeat; border:none; width:20px; height:20px; cursor:pointer;">
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td width="100px">Giờ khám</td>
                                        <td>
                                        	<select name="giokham">
                                            	<option value="1">Sáng</option>
                                                <option value="0">Chiều</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td align="right" colspan="2">
                                        	<input type="submit" name="ok" style="background:#093; color:#FFF; border:none; padding:8px 8px" value="Kiểm Tra" />
                                        </td>
                                    </tr>
                                </table>
                      </form>
                    </div>
              </div>
        	</div>
            <div id="right_main">
            	<?php 
					require("views/support.php"); 
					require("views/images.php");
				?>
        </div>
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
