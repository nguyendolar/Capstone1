<?php 
	require("libraries/config.php");
?>
<?php
	$id = $_GET['val'];
	$sql = "select * from bacsy where khoa_id = '$id'";
	$result = mysqli_query($conn,$sql);
	while($data = mysqli_fetch_assoc($result)){
		echo "<option value='".$data['bacsy_id']."'>".$data['bacsy_ten']."</option>";
	}
?>
