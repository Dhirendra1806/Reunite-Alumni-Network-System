<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid']==0)) {
  header('location:logout.php');
} else {
  if(isset($_POST['submit'])) {

    $eid=$_GET['editid'];
    $pic=$_FILES["pic"]["name"];
    $extension = substr($pic,strlen($pic)-4,strlen($pic));
    $allowed_extensions = array(".jpg","jpeg",".png",".gif");

    if(!in_array($extension,$allowed_extensions)) {
      echo "<script>alert('Pic has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {

      $pic=md5($pic).time().$extension;
      move_uploaded_file($_FILES["pic"]["tmp_name"],"images/".$pic);
      $sql="update tblevents set BannerImage=:pic where ID=:eid";
      $query=$dbh->prepare($sql);

      $query->bindParam(':pic',$pic,PDO::PARAM_STR);
      $query->bindParam(':eid',$eid,PDO::PARAM_STR);
      $query->execute();
      echo '<script>alert("Banner image has been updated")</script>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Reunite: Alumni Network System || Update Banner Image</title>
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
                              <h2>Update Banner Image</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row column8 graph">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Update Banner Image</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="full">
                                          <div class="padding_infor_info">
                                             <div class="alert alert-primary" role="alert">
                                                <form method="post" enctype="multipart/form-data">
                                                   <?php
                                                   $eid=$_GET['editid'];
                                                   $sql="SELECT tblevents.BannerImage,tblevents.EventTitle from tblevents where tblevents.ID=:eid";
                                                   $query = $dbh->prepare($sql);
                                                   $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                                   $query->execute();
                                                   $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                   if($query->rowCount() > 0) {
                                                     foreach($results as $row) {
                                                   ?>
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Event Title</label>
                              <input type="text" name="eventtitle" value="<?php echo htmlentities($row->EventTitle);?>" class="form-control" readonly="true">
                           </div>
                         <br>
                           <div class="field">
                              <label class="label_field">Old Banner Image</label>
                              <img src="images/<?php echo $row->BannerImage;?>" width="100" height="100" value="<?php  echo $row->BannerImage;?>">
                           </div>

                           <br>
                           <div class="field">
                              <label class="label_field">New Banner Image</label>
                              <input type="file" name="pic" value="" class="form-control" required='true'>
                           </div>

                           <br>
                          <?php }} ?>

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
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <script src="js/custom.js"></script>
      <script src="js/semantic.min.js"></script>
   </body>
</html>
<?php } ?>
