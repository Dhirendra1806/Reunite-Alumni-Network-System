<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid']==0)) {
  header('location:logout.php');
} else {
  if(isset($_POST['submit'])) {
    $coursename=$_POST['coursename'];
    $eid=$_GET['editid'];
    $sql="update tblcourse set CourseName=:coursename where ID=:eid";
    $query=$dbh->prepare($sql);
    $query->bindParam(':coursename',$coursename,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Course name has been updated")</script>';
  }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Reunite: Alumni Network System || Update Course</title>
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="style.css" />
      <link rel="stylesheet" href="css/responsive.css" />
      <link rel="stylesheet" href="css/colors.css" />
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <link rel="stylesheet" href="css/custom.css" />
      <link rel="stylesheet" href="js/semantic.min.css" />
   </head>
   <body class="inner_page general_elements">
      <div class="full_container">
         <div class="inner_container">
           <?php include_once('includes/sidebar.php');?>
            <div id="content">
               <?php include_once('includes/header.php');?>
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Update Course</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row column8 graph">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Update Course</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="full">
                                          <div class="padding_infor_info">
                                             <div class="alert alert-primary" role="alert">
                                                <form method="post">
                                                   <?php
                                                      $eid=$_GET['editid'];
                                                      $sql="SELECT * from tblcourse where ID=$eid";
                                                      $query = $dbh -> prepare($sql);
                                                      $query->execute();
                                                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                      $cnt=1;
                                                      if($query->rowCount() > 0) {
                                                         foreach($results as $row) {
                                                   ?>
                                                            <fieldset>
                                                               <div class="field">
                                                                  <label class="label_field">Course Name</label>
                                                                  <input type="text" name="coursename" value="<?php  echo htmlentities($row->CourseName);?>" class="form-control" required='true'>
                                                               </div>
                                                            <?php $cnt=$cnt+1;}} ?>
                                                            <br>
                                                            <div class="field margin_0">
                                                               <label class="label_field hidden">hidden label</label>
                                                               <button class="main_bt" type="submit" name="submit" id="submit">Update</button>
                                                            </div>
                                                         </fieldset>
                                                </form></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php include_once('includes/footer.php');?>
               </div>
            </div>
         </div>
      </div>
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/animate.js"></script>
      <script src="js/bootstrap-select.js"></script>
      <script src="js/owl.carousel.js"></script>
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>var ps = new PerfectScrollbar('#sidebar');</script>
      <script src="js/custom.js"></script>
      <script src="js/semantic.min.js"></script>
   </body>
</html>
<?php } ?>
