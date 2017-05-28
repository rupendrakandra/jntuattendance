<?php
   include('session.php');

   $user_check = $_SESSION['login_user'];
   $msg="";
   
	
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	   $sql = "SELECT count(class_room_id) as classroomid FROM class_room_tl";
    $rs = mysqli_query($db,$sql);
	 $count = mysqli_num_rows($rs);
	 $sno=1;
	 $class_room_id=0;
	if ($count > 0) {
		if($row = $rs->fetch_assoc()) {
			
			$class_room_id=$row['classroomid'];
			
		}
	}
	$class_room_id=$class_room_id+1;

      $size=(int)mysqli_real_escape_string($db,$_POST['size']);
      $subjId = mysqli_real_escape_string($db,$_POST['subjId']);
	    $sql = "insert into class_room_tl(class_room_id, subject_id)values($class_room_id,'$subjId')";
      $result = mysqli_query($db,$sql);
	  
	  for($index=1;$index<=$size;$index++)
	  {
		  $uid="userId"."$index.";
		  
		   $st="rd"."$index.";
		   $userId = mysqli_real_escape_string($db,$_POST['userId1']);
		   $astatus=mysqli_real_escape_string($db,$_POST['rd1']);
		   
		   $sql = "insert into student_attendance_tl(class_room_id, student_id, status)values($class_room_id,$userId,'$astatus')";
      $result = mysqli_query($db,$sql);
		   
	  }
       $msg = "Student attendance successfully  completed";
   }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff Class Room </title>
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

<script src='/google_analytics_auto.js'></script>

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
  	height: 27px;
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

<script>
function showUser() {
	var subjId=document.getElementById("subjId").value;
	
	
    if (subjId == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
	else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getclassstudents.php?subjId="+subjId,true);
        xmlhttp.send();
    }
}
</script>
</head>

<body>


<!-- Header Starts -->
<div class="navbar-wrapper">

        <div class="navbar-inverse" role="navigation">
          <div class="container">
            <div class="navbar-header">


              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
               <li ><a href="staffhome.php">Home</a></li>
                <li ><a href="mysubjects.php">MySubjects</a></li>
				 <li class="active"><a href="myclassroom.php">Class Room</a></li>
				  <li><a href="myreports.php">Reports</a></li>
              
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </div>
            <!-- #Nav Ends -->

          </div>
        </div>

    </div>
<!-- #Header Starts -->





<div class="container">

<!-- Header Starts -->
<div class="header">
	<a href="index.html"><img src="images/logo.png" alt="Realestate"></a>
	<div class="pull-right">
		<h2>Online Attendence System</h2>
	</div>
              
</div>
<!-- #Header Starts -->
</div><!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="#">Home</a></span>
    <h2>Home</h2>
</div>
</div>
<!-- banner -->


<div class="container">
<div class="spacer">
<form action="" method="post">
<div class="row register">
  <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
  

<?php
	
	
	$sql = "SELECT s.subject_id, subject_name, subject_code, semester,  dept_id  FROM subject_tl s,staff_subject_tl ss where s.subject_id=ss.subject_id and ss.user_id=$user_check";
    $rs = mysqli_query($db,$sql);
	 $count = mysqli_num_rows($rs);
	 $sno=1;
	if ($count > 0) {
		echo "<select name='subjId' id='subjId' required onchange='showUser()'><option value=''>Select Class</option>";
		while($row = $rs->fetch_assoc()) {
		echo "<option value='".$row["subject_id"]."'>".$row["semester"]."|".$row["subject_name"]."</option>";
	
		
			
		}
		
		echo "</select>";
	}

?>


<div class="row">
 <div class="col-md-12  col-xs-12 ">
		<div id="txtHint" ></div>
			</div>            
  </div>

</div>
                
        </div>
		</form>
  
</div>
</div>
</div>




<div class="footer">

<div class="container">



<div class="row">
            <div class="col-lg-3 col-sm-3">
                   <h4>Information</h4>
                   <ul class="row">
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.html">About JNTU</a></li>
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="staff.html">Staff</a></li>         
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="blog.html">Student Blog</a></li>
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="contact.html">Contact</a></li>
              </ul>
            </div>
            
            <div class="col-lg-3 col-sm-3">
                    <h4>Newsletter</h4>
                    <p>Get notified about the latest news in jntu.</p>
                    <form class="form-inline" role="form">
                            <input type="text" placeholder="Enter Your email address" class="form-control">
                                <button class="btn btn-success" type="button">Notify Me!</button></form>
            </div>
            
            <div class="col-lg-3 col-sm-3">
                    <h4>Follow us</h4>
                    <a href="#"><img src="images/facebook.png" alt="facebook"></a>
                    <a href="#"><img src="images/twitter.png" alt="twitter"></a>
                    <a href="#"><img src="images/linkedin.png" alt="linkedin"></a>
                    <a href="#"><img src="images/instagram.png" alt="instagram"></a>
            </div>

             <div class="col-lg-3 col-sm-3">
                    <h4>Contact us</h4>
                 
<span class="glyphicon glyphicon-map-marker"></span> Jawaharlal Nehru Technological University Anantapur <br>
<span class="glyphicon glyphicon-envelope"></span> jntua@gmail.com<br>
<span class="glyphicon glyphicon-earphone"></span> (08544) 243944</p>
            </div>
        </div>
<p class="copyright">Copyright 2017. All rights reserved.	</p>


</div></div>





</body>
</html>