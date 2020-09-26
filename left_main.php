<div class="left_main">
                	<div class="title_left_main">giới thiệu</div>
                    <div class="about_left_main">
                    	<div class="about_about" style="color:#199d52;height:30px;line-height:30px;font-size:15px">LỜI GIỚI THIỆU</div>
                        <div class="about_about" style="color:#000;line-height:20px;font-size:15px">
                        	<p>Phòng khám ĐA KHOA VIỆT-HÀN được thành lập từ năm 2005 với tổng diện tích sử dụng gần 1000 m2, tọa lạc tại 								số 9 Ngô Thì Nhậm – Hai Bà Trưng – Hà Nội. Trong những năm đầu hoạt động phòng khám Việt Hàn chủ yếu phục					 								vụ, chăm sóc sức khỏe cho hơn 30.000 bệnh nhân Hàn Quốc sinh sống và làm việc tại Hà Nội và các tỉnh phía 								Bắc Việt Nam
                            </p>
                        </div>
                        <div class="about_about" style="float:left; width:100%">
                        	<a href="http://localhost:81/phong_kham/index.php?page=menu&act=view&nid=15" style="color:#199d52; float:right">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="left_main_mid">
                	<div class="title_left_main">đặt hẹn</div>
                    <div class="calendar">
                    	<div class="title_tructiep">đặt lịch trực tiếp</div>
                        <div class="show_tructiep">
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
							if(mysqli_num_rows($resultlich) > 0){
								echo("Bác sỹ đã có lịch bạn hãy chọn lịch khác");	
							}else{
								$sql = "insert into lichkham(ten_nguoikham,bacsy_id,ngaykham,giokham,dienthoai_lienlac) values('$name','$bacsy','$date','$giokham','$phone')";	
							}
							mysqli_query($sql);
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
                                                <?php $khoaid = $khoa['khoa_id']; ?>
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
                    <!--div class="calendar">
                    	<div class="title_tructiep">đặt lịch điện thoại</div>
                        <div class="show_tructiep">
                        	<form action="" method="post" name="phone">
                            	<table width:100%; cellpadding="5"; cellspacing="5">
                                	<tr>
                                    	<td width="100px">Trụ Sở</td>
                                        <td>
                                        	<select name="phone_truso" class="form_book">
                                            	<option value="1">Số 9 Ngô Thì Nhậm,Hai Bà Trưng</option>
                                                <option value="2">Tòa nhà FLC Lê Đức Thọ,Mỹ Đình</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>Chuyên Khoa</td>
                                        <td>
                                        	<select name="phone_khoa" class="form_book">
                                            	<option value="1">Khoa Nội </option>
                                                <option value="2">Khoa Ngoại</option>
                                                <option value="3">Sản Phụ Khoa</option>
                                                <option value="4">Khoa Nhi</option>
                                                <option value="5">Khoa Mắt</option>
                                                <option value="6">Khoa Tai Mũi Họng</option>
                                                <option value="7">Răng Hàm Mặt</option>
                                                <option value="8">Khoa Da Liễu</option> 
                                                <option value="9">Khoa Xét Nghiệm</option> 
                                                <option value="4">Khoa Chuẩn Đoán Hình Ảnh</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>Bác Sỹ</td>
                                        <td>
                                        	<select name="phone_bacsy" class="form_book">
                                            	<option value="1">Thầy Thuốc ND,GS. Phạm Gia Cường</option>
                                                <option value="2">Cao Minh Tùng</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>Ngày Hẹn</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                    	<td>Giờ Hẹn</td>
                                        <td>
                                        	<select name="phone_giohen" class="form_book">
                                                <option value="1">10h-10h30</option>
                                                <option value="2">10h30-11h</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td align="right" colspan="2">
                                        	<input type="button" style="background:#093; color:#FFF; border:none; padding:8px 8px" value="Kiểm Tra" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div!-->
                     </div>
                <div class="left_main_bot">
                	<div class="title_left_main">tin mới</div>
                    <div class="left_main_bot_new">
                    	<div class="new_left" style="font-size:14px;">
                        	<?php 
								$nsql = "select * from news order by danhmuc_id desc limit 0,8 ";
								$nresult = mysqli_query($conn,$nsql);
								while($ndata = mysqli_fetch_assoc($nresult)){	
									echo "<ul>";
									echo "<li><a href='".BASEURL."index.php?page=menu&act=view&nid=".$ndata['news_id']."'>".$ndata['news_tieude']."</a></li>";	
									echo "</ul>";
								}
							?>
                        </div>
                    </div>
                </div>
                <div class="cls"></div>