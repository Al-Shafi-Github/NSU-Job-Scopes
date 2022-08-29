<!doctype html>
<html lang="en">
<?php 
require 'constants/settings.php'; 
require 'constants/check-login.php';
require 'constants/db_config.php'; 

if (isset($_GET['jobid'])) {

$jobid = $_GET['jobid'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
    $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE job_id = :jobid");
	$stmt->bindParam(':jobid', $jobid);
    $stmt->execute();
    $result = $stmt->fetchAll();
	$rec = count($result);
	if ($rec == "0") {
	header("location:./");	
	}else{

    foreach($result as $row)
    {
	$jobtitle = $row['title'];
	$jobcity = $row['city'];
	
	$jobcategory = $row['category'];
	$jobtype = $row['type'];
	$experience = $row['experience'];
	$jobdescription = $row['description'];
	$jobrespo = $row['responsibility'];
	$jobreq = $row['requirements'];
	$closingdate = $row['closing_date'];
	$opendate = $row['date_posted'];
	$compid = $row['company'];
	if ($jobtype == "Freelance") {
	$sta = '<span class="label label-success">Freelance</span>';
											  
	}
	if ($jobtype == "Part-time") {
	$sta = '<span class="label label-danger">Part-time</span>';
											  
	}
	if ($jobtype == "Full-time") {
	$sta = '<span class="label label-warning">Full-time</span>';
											  
	}

	
	}
	}

					  
	}catch(PDOException $e)
    {

    }


}else{
header("location:./");	
}


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE member_no = '$compid'");
$stmt->execute();
$result = $stmt->fetchAll();


    foreach($result as $row)
    {
    $compname = $row['first_name'];
	$complogo = $row['avatar'];
	$compbout = $row['about'];
	}

					  
	}catch(PDOException $e)
    {

    }
	

$today_date = strtotime(date('Y/m/d'));
$last_date = date_format(date_create_from_format('d/m/Y', $closingdate), 'Y/m/d');
$post_date = date_format(date_create_from_format('d/m/Y', $closingdate), 'd');
$post_month = date_format(date_create_from_format('d/m/Y', $closingdate), 'F');
$post_year = date_format(date_create_from_format('d/m/Y', $closingdate), 'Y');
$conv_date = strtotime($last_date);

if ($today_date > $conv_date){
$jobexpired = true;
}else{
$jobexpired = false;
}
?>


<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>NSU Job Scopes - <?php echo "$jobtitle"; ?></title>
	<meta name="description" content="Online Job Management / Job Portal" />
	<meta name="keywords" content="job, work, resume, applicants, application, employee, employer, hire, hiring, human resource management, hr, online job management, company, worker, career, recruiting, recruitment" />
	<meta name="author" content="BwireSoft">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta property="og:image" content="http://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:secure_url" content="https://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="Bwire Jobs" />
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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<link href="css/style.css" rel="stylesheet">

	 <script type="text/javascript">
   function update(str)
   {
	   
	var txt;
    var r = confirm("Are you sure you want to apply this job , you can not UNDO");
    if (r == true) {
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

      xmlhttp.open("GET","app/apply-job.php?opt="+str, true);
      xmlhttp.send();
    } else {

    }

  }
</script>

	
</head>

<body class="not-transparent-header">

	<div class="container-wrapper">


		<header id="header">

			<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

				<div class="container">
					
				<a class="navbar-brand branding" href="#">NSU Job Scopes</a>
					
					<div id="navbar" class="navbar-nav-wrapper navbar-arrow">
					
						<ul class="nav navbar-nav" id="responsive-menu">
						
							<li>
							
								<a href="./">Home</a>
								
							</li>
							
							<li>
								<a href="job-list.php">Job List</a>

							</li>
							
							<li>
								<a href="employers.php">Employers</a>
							</li>
							
							<li>
								<a href="employees.php">Employees</a>
							</li>
							
							<li>
								<a href="contact.php">Contact Us</a>
							</li>

							<li >
						
								<?php
								if ($user_online == true) {
								print '
								<li><a href="'.$myrole.'">Profile</a></li>
								<li><a href="logout.php">Log Out</a></li>
								';
								
								}else{
								print '<li><a href="login.php">Log In</a></li>
								<li> <a data-toggle="modal"  href="#registerModal">Register</a> </li>';
								}
								?>
						  </li>

						</ul>
				
					</div>

			
				
				</div>
				
				<div id="slicknav-mobile"></div>
				
			</nav>

			
		</header>
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
		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="job-list.php">All jobs</a></li>
						<li><a target="" href="company.php?ref=<?php echo "$compid"; ?>"><?php echo "$compname"; ?></a></li>
						<li><span><?php echo "$jobtitle"; ?></span></li>
					</ol>
					
				</div>
				
			</div>
			
			<div class="section sm">
			
				<div class="container">
				
					<div class="row">
						
						<div class="col-md-10 col-md-offset-1">
						
							<div class="job-detail-wrapper">
							
								<div class="job-detail-header text-center">
											
									<h2 class="heading mb-15"><?php echo "$jobtitle"; ?></h2>
								
									<div class="meta-div clearfix mb-25">
										<span>At <a target="" href="company.php?ref=<?php echo "$compid"; ?>"><?php echo "$compname"; ?></a> as </span>
										<?php echo "$sta"; ?>
									</div>
									
									<ul class="meta-list clearfix">
										<li>
											<h4 class="heading">Location:</h4>
											<?php echo "$jobcity"; ?>
										</li>
										<li>
											<h4 class="heading">Deadline:</h4>
											<?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?>
										</li>
										<li>
											<h4 class="heading">Experience</h4>
											<?php echo "$experience"; ?> 
										</li>
										<li>
											<h4 class="heading">Posted: </h4>
											<?php echo "$opendate"; ?>
										</li>
									</ul>
									
								</div>
					
								<div class="job-detail-company-overview clearfix">
								
									<h3>Company overview</h3>
									<div class="image">
										<?php 
										if ($complogo == null) {
										print '<center>No Company Logo</center>';
										}else{
										echo '<center><img class="autofit2" alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
										}
										?>
									</div>
									
									<p><?php echo "$compbout"; ?></p>
									
								</div>
								
								<div class="job-detail-content mt-30 clearfix">
								
									<h3>Job Description</h3>

									<p><?php echo "$jobdescription"; ?></p>

									
									<h3>Job Responsibilities</h3>
									
                                    <p><?php echo "$jobrespo"; ?></p>
									
									<h3>Requirements:</h3>
                                    <p><?php echo "$jobreq"; ?></p>
								
								</div>
								
								<div class="apply-job-wrapper">
								<?php
						        if ($user_online == true) {
								if ($jobexpired == true) {
								print '<button class="btn btn-primary disabled btn-hidden btn-lg collapsed"><i class="flaticon-line-icon-set-calendar"></i> This job is expired</button>';
								}else{
								if ($myrole == "employee") {
                                print '<button';?> onclick="update(this.value)" <?php print ' value="'.$jobid.'" class="btn btn-primary btn-hidden btn-lg collapsed"><i class="flaticon-line-icon-set-pencil"></i> Apply this job</button>';
								}else{
								print '<button class="btn btn-primary disabled btn-hidden btn-lg collapsed"><i class="flaticon-line-icon-set-padlock"></i> Login as employee to apply</button>';
								}	
								}

								
								}else{
									
								print '<button class="btn btn-primary disabled btn-hidden btn-lg collapsed"><i class="flaticon-line-icon-set-padlock"></i> Login to apply this job</button>';	
								}
								
								?>
								
								<p id="data"></p>

								</div>
								
								<div class="tab-style-01">
								
									<ul class="nav" role="tablist">
										<li role="presentation" class="active"><h4><a href="#relatedJob1" role="tab" data-toggle="tab">More jobs from <?php echo "$compname"; ?></a></h4></li>
									</ul>

									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="relatedJob1">
											<div class="tab-content-inner">
							<div class="recent-job-wrapper alt-stripe mr-0">
							<?php
							require 'constants/db_config.php';
							try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE company = '$compid' AND job_id != :jobid ORDER BY rand() LIMIT 5");
							$stmt->bindParam(':jobid', $jobid);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
  

                            foreach($result as $row) {
							$post_date = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'd');
                            $post_month = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'F');
                            $post_year = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'Y');
                            $jobtype = $row['type'];
							
							$jobtype = $row['type'];
							if ($jobtype == "Freelance") {
	                        $sta = '<div class="job-label label label-success">
									Freelance
									</div>';
											  
	                        }
	                        if ($jobtype == "Part-time") {
	                        $sta = '<div class="job-label label label-danger">
									Part-time
									</div>';
											  
	                        }
	                        if ($jobtype == "Full-time") {
	                              $sta = '<div class="job-label label label-warning">
									Full-time
									</div>';
											  
	                        }
							
							?>
																											<a href="explore-job.php?jobid=<?php echo $row['job_id']; ?>" class="recent-job-item clearfix">
														<div class="GridLex-grid-middle">
															<div class="GridLex-col-6_sm-12_xs-12">
																<div class="job-position">
																	<div class="image">
																	 <?php 
										                            if ($complogo == null) {
										                            print '<center><img class="autofit3" alt="image"  src="images/blank.png"/></center>';
										                            }else{
										                            echo '<center><img class="autofit3" alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
										                            }
										                             ?>
																	</div>
																	<div class="content">
																		<h4><?php echo $row['title']; ?></h4>
																		<p><?php echo "$compname"; ?></p>
																	</div>
																</div>
															</div>
															<div class="GridLex-col-3_sm-8-xs-8_xss-12 mt-10-xss">
																<div class="job-location">
																	<i class="fa fa-map-marker text-primary"></i> <?php echo $row['country']; ?>
																</div>
															</div>
															<div class="GridLex-col-3_sm-4_xs-4_xss-12">
                                                             <?php echo "$sta"; ?>
																<span class="font12 block spacing1 font400 text-center"> Due - <?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?></span>
															</div>
														</div>
													</a>
													<?php
								
								
							}

	                        }catch(PDOException $e)
                            { 
                   
                             }
                             ?>
						



							
							</div>

											
											</div>
										</div>

									</div>
									
								</div>
								
							</div>
						
						</div>
						
					</div>
				
				</div>
			
			</div>

				
	<footer class="footer-section">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="cta-text">
                                <h4>Find us</h4>
                                <span>Bashundhara R/A,Dhaka,Bangladesh</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4>Call us</h4>
                                <span>01956947340</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4>Mail us</h4>
                                <span><a href="mailto:abdullah.shafi1@northsouth.edu">abdullah.shafi1@northsouth.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
							    <h3>NSU  Job  Scopes</h3>
                                <!-- <a href="index.html"><img src="https://i.ibb.co/QDy827D/ak-logo.png" class="img-fluid" alt="logo"></a> -->
                            </div>
                            <div class="footer-text">
							
                                <p>NSU Job Scopes is a online job portal and job management system onlt for NSUers. Developed by Team Zero Factorial.</p>
                            </div>
                            <!-- <div class="footer-social-icon">
                                <span> Follow us</span>
                                <a href="#"><i class="fab fa-facebook-f facebook-bg"></i></a>
                                <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                                <a href="#"><i class="fab fa-google-plus-g google-bg"></i></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Useful Links</h3>
                            </div>
                            <ul>
                                <li><a href="./">Home</a></li>
                                <li><a href="job-list.php">Job List</a></li>      
                                <li><a href="employers.php">Employers</a></li>
                                <li><a href="employees.php">Employees</a></li>
                                <li><a href="contact.php">Contact us</a></li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Subscribe</h3>
                            </div>
                            <div class="footer-text mb-25">
                                <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                            </div>
                            <div class="subscribe-form">
                                <form action="#">
                                    <input type="text" placeholder="Email Address">
                                    <button><i class="fab fa-telegram-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright &copy; <?php echo date('Y'); ?>, All Right Reserved By Team Zero Factorial</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="terms&condition.php">Terms & condition</a></li>
                                <li><a href="#">Privacy</a></li>
                              
                                <li><a href="contact.php">Contact</a></li>
								
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
			
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