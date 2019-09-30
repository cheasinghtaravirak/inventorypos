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
        Add Product
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
      <!-- general form elements -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><a href="productlist.php" class="btn btn-primary" role="button">Back to Product List</a></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

          <div class="box-body">
            <form action="" method="post" name="formproduct">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control" name="txtpname" placeholder="Enter..." required>
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
                        <option><?php echo $row['category'] ?></option>      
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Purchase Price</label>
                      <input type="number" min="1" step="1" class="form-control" name="txtpprice" placeholder="Enter..." required>
                    </div>
                    <div class="form-group">
                      <label>Sale Price</label>
                      <input type="number" min="1" step="1" class="form-control" name="txtsaleprice" placeholder="Enter..." required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Stock</label>
                      <input type="number" min="1" step="1" class="form-control" name="txtstock" placeholder="Enter..." required>
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="txtdescription" rows="4" placeholder="Enter..."></textarea>
                    </div>
                    <div class="form-group">
                      <label>Product Image</label>
                      <input type="file" class="input-group" name="productimage" required>
                      <p>upload image</p>
                    </div>
                </div>
            </form>
          </div>
          <div class="box-footer">
                <button type="submit" class="btn btn-info" name="btnaddproduct">Add product</button>
          </div>
        </div>
   
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include_once'footer.php';
?>
