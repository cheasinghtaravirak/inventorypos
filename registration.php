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
        Registration
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
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registration Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
              
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label>Role</label>
                      <select class="form-control">
                        <option>Admin</option>
                        <option>User</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PASSWORD</th>
                                <th>ROLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $select = $pdo->prepare("select * from tbl_user order by userid desc"); 
                            $select->execute(); 
                            while($row=$select->fetch(PDO::FETCH_OBJ)) {
                                echo '
                                    <tr>
                                        <td>'.$row->userid.'</td>
                                        <td>'.$row->username.'</td>
                                        <td>'.$row->useremail.'</td>
                                        <td>'.$row->password.'</td>
                                        <td>'.$row->role.'</td>
                                    </tr>
                                ';
                            }
                            ?>
<!--
                            <tr>
                                <td>'.$row->userid.'</td>
                                <td>'.$row->username.'</td>
                                <td>'.$row->useremail.'</td>
                                <td>'.$row->password.'</td>
                                <td>'.$row->role.'</td>
                            </tr>
-->
                        </tbody>
                    </table>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
