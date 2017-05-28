<?php
   include('session.php');
   
   
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Students </title>
<meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

 	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/style.css"/>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.js"></script>
  <script src="assets/script.js"></script>



<!-- Owl stylesheet -->
<link rel="stylesheet" href="assets/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="assets/owl-carousel/owl.theme.css">
<script src="assets/owl-carousel/owl.carousel.js"></script>
<!-- Owl stylesheet -->


<!-- slitslider -->
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/custom.css" />
    <script type="text/javascript" src="assets/slitslider/js/modernizr.custom.79639.js"></script>
    <script type="text/javascript" src="assets/slitslider/js/jquery.ba-cond.min.js"></script>
    <script type="text/javascript" src="assets/slitslider/js/jquery.slitslider.js"></script>
<!-- slitslider -->

<script src='/google_analytics_auto.js'></script></head>
<style>
	.rTable {
  	display: block;
  	width: 100%;
}
.rTableHeading, .rTableBody, .rTableFoot, .rTableRow{
  	clear: both;
}
.rTableHead, .rTableFoot{
  	background-color: #DDD;
  	font-weight: bold;
}
.rTableCell, .rTableHead {
  	border: 1px solid #999999;
  	float: left;
  	height: 47px;
  	overflow: hidden;
  	padding: 2px 1.8%;
  	width: 25%;
}
.rTable:after {
  	visibility: hidden;
  	display: block;
  	font-size: 0;
  	content: " ";
  	clear: both;
  	height: 0;
}

.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
</style>

<body>




<h2>Sudent Details</h2>
<div class="rTable">
<div class="rTableRow">
<div class="rTableHead"><strong>SNO</strong></div>
<div class="rTableHead"><span style="font-weight: bold;">RegNO</span></div>
<div class="rTableHead">Present</div>
<div class="rTableHead"> Absent</div>

</div>


<?php
$subjId = strval($_GET['subjId']);

	$sql = "SELECT subject_id, subject_name, subject_code, semester, status, dept_id FROM subject_tl s where s.subject_id=$subjId";
    $rs = mysqli_query($db,$sql);
	 $count = mysqli_num_rows($rs);
	 $sno=0;
	if ($count > 0) {
		if($row = $rs->fetch_assoc()) {
			$semester=$row["semester"];
			$dept_id=$row["dept_id"];
			
			
			$sql2 = "SELECT u.user_id as userId,u.user_type as userType,u.first_Name as firstName,u.last_Name as lastName,u.email_Id as emailId,u.mobile_No as mobileNo,u.user_Name as userName,u.dept_id as deptId,d.dept_Name as deptName FROM user_tl u,dept_tl d where u.dept_id=d.dept_id and u.user_type='Student' and u.dept_id=$dept_id and u.sem='$semester'";
    $rs2 = mysqli_query($db,$sql2);
	 $count2 = mysqli_num_rows($rs2);
	 $sno2=0;
	if ($count2 > 0) {
		while($row2 = $rs2->fetch_assoc()) {
			$uid=$row2["userId"];
			echo "<div class='rTableRow'>";
			echo "<div class='rTableCell'>".++$sno2."</div>";
			
			echo "<div class='rTableCell'>".$row2["userName"]."</div>";
			
			echo "<div class='rTableCell'>
			<input type='hidden' value='".$uid."' name='userId".$sno2."'  >
			<input type='radio' value='Present' name='rd".$sno2."'  class='textbox'></div>";
			echo "<div class='rTableCell'><input type='radio' value='Absent' name='rd".$sno2."'   class='textbox'></div></div>";
			
			
		}
		echo ' <div class="row">
		   <div class="col-xs-1 col-md-1">
				</div>
		   <div class="col-xs-4 col-md-1"></div>
		   
		   <div class="col-xs-5 col-md-2">
				<div class="form-group">
				<input type="hidden" name="size" value="'.$sno2.'">
				
		<input type="submit"  class="btn btn-success" value="   Submit   ">
				   
				 </div>
				  <div class="col-xs-4 col-md-1"></div>
								  
			</div>
							
		   </div>';
	}
			
			
		}
	}

?>

</div>


                
      


</body>
</html>