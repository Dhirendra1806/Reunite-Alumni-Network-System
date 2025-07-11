<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Reunite: Alumni Network System || Home Page</title>

<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<body>

<div class="super_container">
	<?php include_once('includes/header.php');?>
	<div class="home">
		<div class="home_slider_container">

			<div class="owl-carousel owl-theme home_slider">

				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/GLA.jpg)"></div>
					<div class="home_slider_content">
						<div class="container">
							<div class="row">
								<div class="col text-center">
									<div class="home_slider_title">Welcome To official Alumni Network</div>
									<div class="home_slider_subtitle">Reunite: Alumni Network System</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/home_slider_1.jpg)"></div>
					<div class="home_slider_content">
						<div class="container">
							<div class="row">
								<div class="col text-center">
									<div class="home_slider_title">Welcome to the Alumni Lineage!</div>
									<div class="home_slider_subtitle">On this website, you will find information about upcoming events</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
		<div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
	</div>

	<div class="events">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<h2 class="section_title">Upcoming events</h2>
						<div class="section_subtitle"><p>
						GLA University has an exciting lineup of upcoming events aimed at fostering 
						academic excellence and student engagement. The university will host technical workshops, 
						cultural fests, and industry seminars, providing students with opportunities to enhance their 
						skills and network with professionals. Highlights include the annual TechFest, featuring 
						coding competitions and innovation challenges, and the much-awaited Cultural Fest, 
						showcasing talent in music, dance, and drama. Additionally, guest lectures and 
						career-oriented workshops will help students stay updated with industry trends. 
						Stay tuned for official announcements and participation details!</p></div>
					</div>
				</div>
			</div>
			<div class="row events_row">

				<?php
                            
$sql="SELECT * from tblevents order by ID desc limit 6";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
				<div class="col-lg-4 event_col">
					<div class="event event_left">
						<div class="event_image"><img src="admin/images/<?php echo $row->BannerImage;?>" width="400" height="200" alt=""></div>
						<div class="event_body d-flex flex-row align-items-start justify-content-start">
							
							<div class="event_content">
								<div class="event_title"><a href="view-events.php?vid=<?php echo htmlentities ($row->ID);?>"><?php  echo htmlentities($row->EventTitle);?></a></div>
								<div class="event_info_container">
									<div class="event_info"><i class="fa fa-clock-o" aria-hidden="true"></i><span><?php  echo $row->Schedule;?></span></div>
									
									<div class="event_text">
										<p><?php  echo substr($row->Description,0,50);?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><?php $cnt=$cnt+1;}} ?>
			</div>
		</div>
	</div>

	<?php include_once('includes/footer.php');?>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>