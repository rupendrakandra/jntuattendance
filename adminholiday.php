<?php
   include('session.php');
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Holidays </title>
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
  	height: 27px;
  	overflow: hidden;
  	padding: 2px 1.8%;
  	width: 13%;
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
               <li ><a href="adminhome.php">Home</a></li>
                <li ><a href="admindept.php">Departments</a></li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Staff <b class="caret"></b></a> 
				  <ul class="dropdown-menu ">
					<li class="kopie"><a href="adminstaff.php">Staff</a></li>
					<li class="kopie"><a href="adminaddstaff.php">AddStaff</a></li>
					</ul>
				</li>
				<li class="dropdown active">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Holidays <b class="caret"></b></a> 
				  <ul class="dropdown-menu active">
					<li class="kopie"><a href="adminholiday.php">Holi Days</a></li>
					<li class="kopie"><a href="adminaddholiday.php">Create New Holiday</a></li>
					</ul>
				</li>
                 <li><a href="adminattendence.php">Attendence</a></li>
               
                <li><a href="adminreports.php">Reports</a></li>
				
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
    <span class="pull-right"><a href="adminhome.php">Home</a> / Holidays</span>
    <h2>Holidays</h2>
</div>
</div>
<!-- banner -->


<div class="container">
<div class="spacer">

  
 
<h2>Holidays</h2>
<div class="rTable">
<div class="rTableRow">
<div class="rTableHead" style="width:5%"><strong>SNO</strong></div>
<div class="rTableHead"><span style="font-weight: bold;">Holiday Name</span></div>
<div class="rTableHead">From Date</div>
<div class="rTableHead">To Date</div>
<div class="rTableHead">NoofDays</div>
<div class="rTableHead" style='width:25%;'>Description</div>


<?php
	$sql = "SELECT holiday_id, holiday_name,from_date,to_date,created_on,created_by,holiday_descr,to_date-from_date+1 as nofDays  FROM holiday_tl order by holiday_id desc ";
    $rs = mysqli_query($db,$sql);
	 $count = mysqli_num_rows($rs);
	if ($count > 0) {
		$sno=0;
		while($row = $rs->fetch_assoc()) {
			$sno++;
			echo "<div class='rTableRow'>";
			echo"<div class='rTableCell' style='width:5%'>".$sno."</div>";
			echo "<div class='rTableCell'>".$row["holiday_name"]."</div>";
			echo "<div class='rTableCell'>".$row["from_date"]."</div>";
			echo "<div class='rTableCell'>".$row["to_date"]."</div>";
			echo "<div class='rTableCell'>".$row["nofDays"]."</div>";
			echo "<div class='rTableCell' style='width:25% ;overflow: visible;'>".$row["holiday_descr"]."</div></div>";
			
		}
	}

?>




                
        </div>
  
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
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="agents.html">Agents</a></li>         
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