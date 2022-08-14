<!doctype html>
<html lang="en">
<?php 
include 'constants/settings.php'; 
include 'constants/check-login.php';
?>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Job Scope - Login</title>
	
	<meta name="description" content="Online Job Management / Job Portal" />
	<meta name="keywords" content="job, work, resume, applicants, application, employee, employer, hire, hiring, human resource management, hr, online job management, company, worker, career, recruiting, recruitment" />
	<meta name="author" content="BwireSoft">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta property="og:image" content="http://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:secure_url" content="https://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="Nightingale Jobs" />
    <meta property="og:description" content="Online Job Management / Job Portal" />

	<link rel="shortcut icon" href="images/ico/NSU_favicon3.png">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">	
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/component.css" rel="stylesheet">
	
	<link rel="stylesheet" href="icons/linearicons/style.css">
	<link rel="stylesheet" href="icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="icons/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="icons/rivolicons/style.css">
	<link rel="stylesheet" href="icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
	<link rel="stylesheet" href="icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
	<link rel="stylesheet" href="icons/flaticon-thick-icons/flaticon-thick.css">
	<link rel="stylesheet" href="icons/flaticon-ventures/flaticon-ventures.css">

	<link href="css/style.css" rel="stylesheet">
	<script type="text/javascript">

		
   function update(str)
   {

	if(document.getElementById('mymail').value == "")
   {
	alert("Please enter your email");

    }else{
		  document.getElementById("data").innerHTML = "Please wait...";
      var xmlhttp;

      if (window.XMLHttpRequest)
      {
        xmlhttp=new XMLHttpRequest();
      }
      else
      {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }	

      xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","app/reset-pw.php?opt="+str, true);
      xmlhttp.send();
}

  }
  
   function reset_text()
   {  
   document.getElementById('mymail').value = "";
   document.getElementById("data").innerHTML = "";
   }

</script>
</head>


<body class="not-transparent-header">

	<div class="container-wrapper">


		<header id="header">
		<div id="registerModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Create your account for free</h4>
			</div>
			
			<div class="modal-body">
			
				<div class="row gap-20">
				
					<div class="col-sm-6 col-md-6">
						<a href="register.php?p=Employer" class="btn btn-facebook btn-block mb-5-xs">Register as Employer</a>
					</div>
					<div class="col-sm-6 col-md-6">
						<a href="register.php?p=Employee" class="btn btn-facebook btn-block mb-5-xs">Register as Employee</a>
					</div>

				</div>
			
			</div>
			
			<div class="modal-footer text-center">
				<button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
			</div>
			
		</div>

			
</header>


 <div class="main-wrapper">


			<div class="login-container-wrapper">	
	
				<div class="container">
				
					<div class="row">
					
						<div class="col-md-10 col-md-offset-1">
						
							<div class="row">

								<div class="col-sm-6 col-sm-offset-3">
				
			 <!-- Form start -->

		   
				<div class="login-root">
					<div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
					<div class="loginbackground box-background--white padding-top--64">
						<div class="loginbackground-gridContainer padding-top--8">
						<div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
							<div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
							</div>
						</div>
						<div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
							<div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1 ;"></div>
						</div>
						<div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
							<div class="box-root box-background--blue800" style="flex-grow: 1 z-index: 0;"></div>
						</div>
						<div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
							<div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
						</div>
						<div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
							<div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1 ;"></div>
						</div>
						<div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
							<div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1 ;"></div>
						</div>
						<div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
							<div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1 ;"></div>
						</div>
						<div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
							<div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
						</div>
						<div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
							<div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
						</div>
						</div>
					</div>
					<div class="box-root padding-top--8 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 1;">
						<div class="box-root padding-top--8 padding-bottom--8 flex-flex flex-justifyContent--center">
						<h1><a href="index.php">NSU Job Scope</a></h1>
						</div>
						<div class="formbg-outer">
						<div class="formbg">
							<div class="formbg-inner padding-horizontal--48">
							<span class="padding-bottom--15">Sign in to your account</span>
							<?php
									include 'constants/check_reply.php';	
							?>
							<form class= "loggin-box" id="stripe-login  name="frm" action="app/auth.php" method="POST" autocomplete="off">
							
								<div class="field padding-bottom--24">
								<label for="email">Email</label>
								<input type="email" name="email">
								</div>
								<div class="field padding-bottom--24">
								<div class="grid--50-50">
									<label for="password">Password</label>
									
								</div>
								<input type="password" name="password">
								</div>
								<div class="reset-pass">
								     <a data-toggle="modal" onclick = "reset_text()" href="#forgotPasswordModal">Forgot your password ?</a>
								</div>
								<div class="field padding-bottom--24">
								
								<input type="submit" name="submit" value="Sign In">
								</div>
							  	
							</form>
							</div>
						</div>
						<div class="footer-link padding-top--24">
						 			 <span >Don't have an account? <a data-toggle="modal" href="#registerModal">Sign up</a></span>
						        </div>
					</div>
					</div>
				</div>
			</form>



			<!-- Forgot password modal form start -->

	        <div id="forgotPasswordModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
				
				<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title text-center">Restore your forgotten password</h4>
				</div>


				<div class="modal-body">
					<div class="row gap-20">
						
						<div class="col-sm-12 col-md-12">
							<p class="mb-20">Enter the email address associated to your account, we will send you the link to reset your password</p>
						</div>
						
						<div class="col-sm-12 col-md-12">
				
							<div class="form-group"> 

								<label>Email Address</label>
								<input id="mymail" autocomplete="off" name="email" class="form-control" placeholder="Enter your email address" type="email" required> 
							</div>
						
						</div>


						
						<div class="col-sm-12 col-md-12">
							<div class="login-box-box-action">
								Return to <a data-dismiss="modal">Log-in</a>
								<p id="data"></p>
							</div>
							
						</div>
						
					</div>
				</div>
				

				<div class="modal-footer text-center">
					<button  onclick="update(mymail.value)" type="submit" class="btn btn-primary">Restore</button>
					<button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
				</div>
		
		    </div>

		  <!-- Forgot password modal ends -->
									
	 	  </div>
							
	    </div>
 						
	   </div>
						
	 </div>
					
   </div>
			
</div>


		</div>


	</div> 


<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="js/bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="js/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="js/bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/jquery-filestyle.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>
<script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="js/handlebars.min.js"></script>
<script type="text/javascript" src="js/jquery.countimator.js"></script>
<script type="text/javascript" src="js/jquery.countimator.wheel.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" src="js/easy-ticker.js"></script>
<script type="text/javascript" src="js/jquery.introLoader.min.js"></script>
<script type="text/javascript" src="js/jquery.responsivegrid.js"></script>
<script type="text/javascript" src="js/customs.js"></script>


</body>

</html>