<?php
include_once'connectdb.php'; 

session_start();

include_once'header.php';

$id=$_GET['id']; 

$select = $pdo->prepare("select * from tbl_product where pid = $id"); 
$select->execute(); 

$row = $select->fetch(PDO::FETCH_ASSOC); 
//values from database 
$id_db = $row['pid']; 
$productname_db = $row['pname'];
$category_db = $row['pcategory'];
$purchaseprice_db = $row['purchaseprice'];
$saleprice_db = $row['saleprice'];
$stock_db = $row['pstock'];
$description_db = $row['pdescription'];
$productimage_db = $row['pimage'];

//print_r($row);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Product
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
              <h3 class="box-title">Product Update Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="post" name="formproduct" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Product Name</label>
                          <input type="text" class="form-control" name="txtpname" value = "<?php echo $productname_db; ?>" placeholder="Enter..." required>
                        </div>
                        <div class="form-group">
                          <label>Category</label>
                          <select class="form-control" name="txtselect_option" >
                            <option value="" disabled selected>Select Category</option>
                            <?php
                              $select = $pdo->prepare("select * from tbl_category order by catid desc");
                              $select->execute(); 
                              while($row=$select->fetch(PDO::FETCH_ASSOC)) {
                                  extract($row);
                            ?>
                            <option <?php if($row['category']==$category_db) {?> 
                                selected = "selected"
                            <?php }?> >
                                <?php echo $row['category']; ?>
                            </option>      
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Purchase Price</label>
                          <input type="number" min="1" step="1" class="form-control" name="txtpprice" value = "<?php echo $purchaseprice_db; ?>" placeholder="Enter..." required>
                        </div>
                        <div class="form-group">
                          <label>Sale Price</label>
                          <input type="number" min="1" step="1" class="form-control" name="txtsaleprice" value = "<?php echo $saleprice_db; ?>" placeholder="Enter..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Stock</label>
                          <input type="number" min="1" step="1" class="form-control" name="txtstock" value = "<?php echo $stock_db; ?>" placeholder="Enter..." required>
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name="txtdescription" rows="4" placeholder="Enter..."><?php echo $description_db; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>Product Image</label>
                            <img src="productimages/<?php echo $productimage_db; ?>" class="img-responsive" width="40px" height="40px"/>
                          <input type="file" class="input-group" name="myfile" required>
                          <p>upload image</p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-warning" name="btnupdate">Update product</button>
                </div>
            </form>
        </div>
   
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include_once'footer.php';
?>
