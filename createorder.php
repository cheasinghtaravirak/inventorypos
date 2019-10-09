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
        Create Order
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
            <form action="" method="post" name="">
                <div class="box-header with-border">
                  <h3 class="box-title">New Order</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Customer Name</label>
                          <input type="text" class="form-control" name="txtcustomer" placeholder="Enter Customer Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date:</label>

                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                        <!-- /.input group -->
                        </div>
                    </div>
                </div> <!-- for customer and date -->
                
                <div class="box-body">
                    <div class="col-md-12">
                        <table id="producttable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Search Product</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Enter Quantity</th>
                                    <th>Total</th>
                                    <th>
                                        <button type="button" name="add" class="btn btn-success btn-sm btnadd"><span class="glyphicon glyphicon-plus"></span></button> 
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- for table -->
                
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Subtotal</label>
                          <input type="text" class="form-control" name="txtsubtotal" required>
                        </div>
                        <div class="form-group">
                          <label>Tax (5%)</label>
                          <input type="text" class="form-control" name="txttax" required>
                        </div>
                        <div class="form-group">
                          <label>Discount</label>
                          <input type="text" class="form-control" name="txtdiscount" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Total</label>
                          <input type="text" class="form-control" name="txttotal" required>
                        </div>
                        <div class="form-group">
                          <label>Paid</label>
                          <input type="text" class="form-control" name="txtpaid" required>
                        </div>
                        <div class="form-group">
                          <label>Due</label>
                          <input type="text" class="form-control" name="txtdue" required>
                        </div>
                    </div>
                </div> <!-- for tax, discount, etc -->
            </form>
        </div>  
   
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
</script>
<?php
include_once'footer.php';
?>
