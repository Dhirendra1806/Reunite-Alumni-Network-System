<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid']==0)) {
  header('location:logout.php');
  } else{
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Reunite: Alumni Network System || All Job Post</title>
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
                              <h2>All Job Post</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>All Job Post</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th class="text-center"></th>
                                             <th>Job Title</th>
                                             <th>Company Name</th>
                                             <th>Location</th>
                                             <th>Vacancy</th>
                                             <th>Designation</th>
                                             <th>Last Date</th>
                                             <th>Posting Date</th>
                                             <th>Status</th>
                                             <th style="width: 15%;">Action</th>
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
                                          $ret = "SELECT ID FROM tbljobpost";
                                          $query1 = $dbh->prepare($ret);
                                          $query1->execute();
                                          $total_rows = $query1->rowCount();
                                          $total_pages = ceil($total_rows / $no_of_records_per_page);
                                          $sql = "SELECT * FROM tbljobpost LIMIT $offset, $no_of_records_per_page";
                                          $query = $dbh->prepare($sql);
                                          $query->execute();
                                          $results = $query->fetchAll(PDO::FETCH_OBJ);
                                          $cnt = 1;
                                          if ($query->rowCount() > 0) {
                                             foreach ($results as $row) {
                                          ?>
                                          <tr>
                                             <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                                             <td><?php echo htmlentities($row->JobTitle); ?></td>
                                             <td><?php echo htmlentities($row->CompanyName); ?></td>
                                             <td><?php echo htmlentities($row->Location); ?></td>
                                             <td><?php echo htmlentities($row->Vacancy); ?></td>
                                             <td><?php echo htmlentities($row->Designation); ?></td>
                                             <td><?php echo htmlentities($row->LastDate); ?></td>
                                             <td><span class="badge badge-primary"><?php echo htmlentities($row->PostingDate); ?></span></td>
                                             <td><?php echo ($row->Status == "") ? "Not Updated Yet" : '<span class="badge badge-primary">'.htmlentities($row->Status).'</span>'; ?></td>
                                             <td><a href="view-jobpost-detail.php?vid=<?php echo htmlentities($row->ID); ?>" class="btn btn-primary btn-sm" target="_blank">View Details</a></td>
                                          </tr>
                                          <?php $cnt++; } } ?>
                                       </tbody>
                                    </table>
                                    <div align="left">
                                       <ul class="pagination">
                                          <li><a href="?pageno=1">First</a></li>
                                          <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                             <a href="<?php if($pageno > 1){ echo '?pageno='.($pageno - 1); } else { echo '#'; } ?>">Prev</a>
                                          </li>
                                          <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                             <a href="<?php if($pageno < $total_pages){ echo '?pageno='.($pageno + 1); } else { echo '#'; } ?>">Next</a>
                                          </li>
                                          <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
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
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/jquery.fancybox.min.js"></script>
      <script src="js/custom.js"></script>
      <script src="js/semantic.min.js"></script>
   </body>
</html>
<?php } ?>
