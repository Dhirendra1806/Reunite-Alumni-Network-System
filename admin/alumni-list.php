<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid']==0)) {
  header('location:logout.php');
} else {
if(isset($_GET['delid'])) {
$rid=intval($_GET['delid']);
$sql="delete from tblalumni where ID=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
$sql1="delete from tbljobpost where AlumniID=:rid";
$query1=$dbh->prepare($sql1);
$query1->bindParam(':rid',$rid,PDO::PARAM_STR);
$query1->execute();
 echo "<script>alert('Data deleted');</script>";
 echo "<script>window.location.href = 'alumni-list.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Reunite: Alumni Network System || Manage Alumni List</title>
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="style.css" />
      <link rel="stylesheet" href="css/responsive.css" />
      <link rel="stylesheet" href="css/colors.css" />
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <link rel="stylesheet" href="css/custom.css" />
      <link rel="stylesheet" href="js/semantic.min.css" />
      <link rel="stylesheet" href="css/jquery.fancybox.css" />
   </head>
   <body class="inner_page tables_page">
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
                              <h2>Manage Alumni List</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Manage Alumni List</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th>S.No</th>
                                             <th>Full Name</th>
                                             <th>College ID</th>
                                             <th>Batch</th>
                                             <th>Email</th>
                                             <th>Registration Date</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                           <?php
                            if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;
       $ret = "SELECT ID FROM tblalumni";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total_rows=$query1->rowCount();
$total_pages = ceil($total_rows / $no_of_records_per_page);
$sql="SELECT * from tblalumni LIMIT $offset, $no_of_records_per_page";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                          <tr>
                                             <td><?php echo htmlentities($cnt);?></td>
                                             <td><?php  echo htmlentities($row->FullName);?></td>
                                             <td><?php  echo htmlentities($row->CollegeID);?></td>
                                             <td><?php  echo htmlentities($row->Batch);?></td>
                                             <td><?php  echo htmlentities($row->Emailid);?></td>
                                             <td><?php  echo htmlentities($row->RegDate);?></td>
                                             <td><a href="view-alumni-details.php?alumniid=<?php echo htmlentities ($row->ID);?>" target="blank"><i class="btn btn-success">View</i></a>
                                                &nbsp; <a href="alumni-list.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Do you really want to Delete ?');"  target="blank"><i class="btn btn-danger"> Delete</i></a>&nbsp;<a href="alumni-jobs.php?alumniid=<?php echo htmlentities ($row->ID);?>&&aname=<?php echo htmlentities ($row->FullName);?>" target="blank"><i class="btn btn-info">Posted Jobs</i></a></td>
                                          </tr><?php $cnt=$cnt+1;}} ?>
                                       </tbody>
                                    </table>
                                    <div align="left">
    <ul class="pagination">
        <li><a href="?pageno=1"><strong>First></strong></a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px">Prev></strong></a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px">Next></strong></a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
    </ul>
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
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/jquery.fancybox.min.js"></script>
      <script src="js/custom.js"></script>
      <script src="js/semantic.min.js"></script>
   </body>
</html><?php } ?>
