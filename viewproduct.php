<?php
include_once'connectdb.php'; 

session_start();

include_once'header.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Product
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">View Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

              <div class="box-body">
              <?php 
                  $id = $_GET['id']; 
                  $select = $pdo->prepare("select * from tbl_product where pid=".$id);
//                  $select = $pdo->prepare("select * from tbl_product where pid='$id'");
                  $select->execute(); 
                  while($row=$select->fetch(PDO::FETCH_OBJ)) {
                      echo '
                         <div class="col-md-6">
                            <ul class="list-group">
                            <center><p class="list-group-item list-group-item-success"><b>Product Detail</b></p></center>
                              <li class="list-group-item">ID <span class="badge">'.$row->pid.'</span></li>
                              <li class="list-group-item">Product Name <span class="label label-info pull-right">'.$row->pname.'</span></li>
                              <li class="list-group-item">Product Category <span class="label label-info pull-right">'.$row->pcategory.'</span></li>
                              <li class="list-group-item">Purchase Price <span class="label label-info pull-right">'.$row->purchaseprice.'</span></li>
                              <li class="list-group-item">Sale Price <span class="label label-info pull-right">'.$row->saleprice.'</span></li>
                              <li class="list-group-item">Stock <span class="label label-info pull-right">'.$row->pstock.'</span></li>
                              <li class="list-group-item">Description <span class="label label-info pull-right">'.$row->pdescription.'</span></li>
                            </ul>  
                         </div>
                         <div class="col-md-6">
                            <ul class="list-group">
                            <center><p class="list-group-item list-group-item-success"><b>Product Image</b></p></center>
                              <li class="list-group-item">New <span class="badge">12</span></li>
                              <li class="list-group-item">Deleted <span class="badge">5</span></li>
                              <li class="list-group-item">Warnings <span class="badge">3</span></li>
                            </ul>  
                         </div>';
                  }
                  
              ?>
<!--
              <li class="list-group-item">Product Profit <span class="label label-info pull-right">'(.$row->saleprice - $row->purchaseprice.)'</span></li>
                 <div class="col-md-6">
                    <ul class="list-group">
                    <center><p class="list-group-item list-group-item-success"><b>Product Detail</b></p></center>
                      <li class="list-group-item">New <span class="badge">12</span></li>
                      <li class="list-group-item">Deleted <span class="badge">5</span></li>
                      <li class="list-group-item">Warnings <span class="badge">3</span></li>
                    </ul>  
                 </div>
-->
                  
              </div>
        </div>
   
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include_once'footer.php';
?>
