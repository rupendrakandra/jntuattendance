<?php
   include('session.php');
   $msg="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      
      $deptId = mysqli_real_escape_string($db,$_POST['deptId']);
     
	  $subjectName = mysqli_real_escape_string($db,$_POST['subjectName']); 
	  $subjectTitle = mysqli_real_escape_string($db,$_POST['subjectTitle']); 
	
	  $semester= mysqli_real_escape_string($db,$_POST['sem']);
      $sql = "insert into subject_tl(subject_name, subject_code, semester, status, dept_id)values('$subjectName','$subjectTitle','$semester','Active',$deptId)";
      $result = mysqli_query($db,$sql);
      
		
      if($result == TRUE) {
         
				

        $msg = "Subject Details are successfully  inserted";
        
      }else {
         $msg = "Not inserted";
      }
   }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Add Subject </title>
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
				<li class="dropdown active">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Staff <b class="caret"></b></a> 
				  <ul class="dropdown-menu ">
					<li class="kopie"><a href="adminstaff.php">Staff</a></li>
					<li class="kopie"><a href="adminaddstaff.php">AddStaff</a></li>
					</ul>
				</li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Holidays <b class="caret"></b></a> 
				  <ul class="dropdown-menu ">
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
    <span class="pull-right"><a href="adminhome.php">Home</a> / AddStaff</span>
    <h2>Add Staff Details</h2>
</div>
</div>
<!-- banner -->


<div class="container">
<div class="spacer">
 <form method="post" action="">
<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $msg; ?></div>
 
			<!-- row  -->
			   <div class="row">
				<div class="col-xs-1 col-md-1">
				</div>
			   <div class="col-xs-4 col-md-1" align="right">
				<label for="concept" class="col-xs-4 col-md-1 control-label-left"><font color="red">*&nbsp;</font>Dept&nbsp;Name</label>
			   </div>
			   <div class="col-xs-5 col-md-6">
					<div class="form-group">
					   <select type="text" class="textbox" name="deptId" id="deptId" required>
							<option value="">Select Department</option>
							
							<?php
	$sql = "SELECT dept_id,dept_name,dept_description FROM dept_tl ";
    $rs = mysqli_query($db,$sql);
	 $count = mysqli_num_rows($rs);
	if ($count > 0) {
		while($row = $rs->fetch_assoc()) {
			
			echo "<option value='".$row["dept_id"]."'>".$row["dept_name"]."</option>";
		
			
		}
	}

?>
					   </select>

					 </div>
									  
				</div>
								
			   </div>
			   <!-- end row -->
			   
			   <!-- row  -->
			   <div class="row">
				<div class="col-xs-1 col-md-1">
				</div>
			   <div class="col-xs-4 col-md-1" align="right">
				<label for="concept" class="col-xs-4 col-md-1 control-label-left"><font color="red">*&nbsp;</font>Semester</label>
			   </div>
			   <div class="col-xs-5 col-md-6">
					<div class="form-group">
					   <select type="text" class="textbox" name="sem" id="sem" required>
							<option value="">Select Semester</option>
							<option value="1.1">1.1</option>
							<option value="1.2">1.2</option>
							<option value="2.1">2.1</option>
							<option value="2.2">2.2</option>
							<option value="3.1">3.1</option>
							<option value="3.2">3.2</option>
							<option value="4.1">4.1</option>
							<option value="4.2">4.2</option>
							
							
							
					   </select>

					 </div>
									  
				</div>
								
			   </div>
			   <!-- end row -->
			<!-- row  -->
			   <div class="row">
			  <div class="col-xs-1 col-md-1">
				</div>
			   <div class="col-xs-4 col-md-1" align="right">
				<label for="concept" class="col-xs-4 col-md-2 control-label-left"><font color="red">*&nbsp;</font>SubjectName</label>
			   </div>
			   <div class="col-xs-5 col-md-6">
					<div class="form-group">
					   <input type="text" class="textbox" name="subjectName" id="subjectName" required>

					 </div>
									  
				</div>
								
			   </div>
			   <!-- end row -->
			   
			   <!-- row  -->
			   <div class="row">
			  <div class="col-xs-1 col-md-1">
				</div>
			   <div class="col-xs-4 col-md-1" align="right">
				<label for="concept" class="col-xs-4 col-md-1 control-label-left"><font color="red">*&nbsp;</font>SubjectTitle</label>
			   </div>
			   <div class="col-xs-5 col-md-6">
					<div class="form-group">
					   <input type="text" class="textbox" name="subjectTitle" id="subjectTitle" required>

					 </div>
									  
				</div>
								
			   </div>
			   <!-- end row -->
			   
			 
			   
			   <!-- row  -->
		   <div class="row">
		   <div class="col-xs-1 col-md-1">
				</div>
		   <div class="col-xs-4 col-md-1"></div>
		   
		   <div class="col-xs-5 col-md-2">
				<div class="form-group">
				
		<input type="submit"  class="btn btn-success btn-bold" value="Submit">
				   
				 </div>
								  
			</div>
							
		   </div>
		   <!-- end row -->
 </form>


                
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