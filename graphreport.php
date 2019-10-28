<?php
include_once'connectdb.php'; 
error_reporting(0);
session_start();

include_once'header.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Graph Report
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
                  <h3 class="box-title">From: <?php echo $_POST['date_1'] ?> To <?php echo $_POST['date_2'] ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                  <div class="box-body">
                     <div class="row">
                          <div class="col-md-5">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepicker1" name="date_1" data-date-format="yyyy-mm-dd">
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepicker2" name="date_2" data-date-format="yyyy-mm-dd">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div align="left">
                                <input type="submit" name="btndatefilter" value="Filter by Date" class="btn btn-success">
                            </div>
                          </div>
                     </div>
                     <br>
                     <br>
                    <?php 
                        $select = $pdo->prepare("select order_date, sum(total) as price from tbl_invoice where order_date between :fromdate AND :todate group by order_date"); 
                        $select->bindParam(':fromdate', $_POST['date_1']);
                        $select->bindParam(':todate', $_POST['date_2']);
                        $select->execute(); 
                      
                        $total = []; 
                        $date = []; 
                        while($row=$select->fetch(PDO::FETCH_ASSOC)) {
                            //This function uses array keys as variable names and values as variable values.
                            extract($row); 
                            $total[] = $price; //add an element to array $total  
                            $date[] = $order_date; 
                        }
//                      echo json_encode($total); 
                    ?>
                      <div class="chart">
                          <canvas id="myChart" style="height: 250px"></canvas>    
                      </div>
                    <?php 
                        $select = $pdo->prepare("select product_name, sum(qty) as q from tbl_invoice_details where order_date between :fromdate AND :todate group by product_id"); 
                        $select->bindParam(':fromdate', $_POST['date_1']);
                        $select->bindParam(':todate', $_POST['date_2']);
                        $select->execute(); 
                      
                        $pname = []; 
                        $qty = []; 
                        while($row=$select->fetch(PDO::FETCH_ASSOC)) {
                            //This function uses array keys as variable names and values as variable values.
//                            echo $row['product_name']." "; 
//                            echo $row['q']." "; 
                            extract($row); 
                            $pname[] = $product_name; //add an element to array $pname  
                            $qty[] = $q; 
                            
                        }
//                      echo "<br>".json_encode($pname);
//                      echo "<br>".json_encode($qty);
                    ?>
                      <div class="chart">
                          <canvas id="bestsellingproduct" style="height: 250px"></canvas>    
                      </div>
                  </div>
            </form>
        </div>
   
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: <?php echo json_encode($date); ?>,
        datasets: [{
            label: 'Total Earning',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($total); ?>
        }]
    },

    // Configuration options go here
    options: {}
});
</script>

<script>
var ctx = document.getElementById('bestsellingproduct').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: <?php echo json_encode($pname); ?>,
        datasets: [{
            label: 'Total Quantity',
            backgroundColor: 'rgb(102, 255, 102)',
            borderColor: 'rgb(0, 102, 0)',
            data: <?php echo json_encode($qty); ?>
        }]
    },

    // Configuration options go here
    options: {}
});
</script>

<script>
    //Date picker
    $('#datepicker1').datepicker({
      autoclose: true
    })
    $('#datepicker2').datepicker({
      autoclose: true
    })
</script>
<?php
include_once'footer.php';
?>
