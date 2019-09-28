<?php
include_once'connectdb.php'; 

session_start();

if($_SESSION['useremail']=="" OR $_SESSION['role']=='User') {
    header('location:index.php');
}

include_once'header.php';

error_reporting(0); 

//codes for delete button
if(isset($_POST['btndelete'])) {
    $delete = $pdo->prepare("delete from tbl_user where userid=".$_POST['btndelete']);
    if($delete->execute()) {
        echo '
        <script type="text/javascript">
            jQuery(function validation() {
                swal({
                  title: "Deleted!!!",
                  text: "The user is deleted successfully.",
                  icon: "success",
                  button: "Ok",
                });
            });
        </script>';
    } else {
        echo '
        <script type="text/javascript">
            jQuery(function validation() {
                swal({
                  title: "Error!",
                  text: "The user is not deleted.",
                  icon: "error",
                  button: "Ok",
                });
            });
        </script>'; 
    }
}

//codes for save button; for inserting new user
if(isset($_POST['btnsave'])) {
    $username = $_POST['txtname'];
    $useremail = $_POST['txtemail'];
    $password = $_POST['txtpassword'];
    $userrole = $_POST['txtselect_option'];   
    
    if(isset($_POST['txtemail'])) {
        $select = $pdo->prepare("select useremail from tbl_user where useremail='$useremail'"); 
        $select->execute(); 
        if($select->rowCount() > 0) {
            echo '
            <script type="text/javascript">
                jQuery(function validation() {
                    swal({
                      title: "Warning!",
                      text: "Email already exists. Please use a different email.",
                      icon: "warning",
                      button: "Ok",
                    });
                });
            </script>';
            
        } else {
            $insert = $pdo->prepare("insert into tbl_user(username, useremail, password, role) values (:name, :email, :pass, :role)"); 
            $insert->bindParam(':name', $username); 
            $insert->bindParam(':email', $useremail); 
            $insert->bindParam(':pass', $password); 
            $insert->bindParam(':role', $userrole);
            
            if($insert->execute()) {
                echo '
                <script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                          title: "Good Job!!!",
                          text: "Register Successfully",
                          icon: "success",
                          button: "Ok",
                        });
                    });
                </script>';
            } else {
                echo '
                <script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                          title: "Error!",
                          text: "Registration Fails",
                          icon: "error",
                          button: "Ok",
                        });
                    });
                </script>';
            }
        }
    }
      
}

//Codes for update button (for editing or updating user information)
if(isset($_POST['btnupdate'])) {
    //declare variables 
    $id = $_POST['txtid']; 
    $username = $_POST['txtname'];
    $useremail = $_POST['txtemail'];
    $password = $_POST['txtpassword'];
    $userrole = $_POST['txtselect_option']; 
    if(empty($username) || empty($useremail) || empty($password) || empty($userrole)) {
        $errorupdate = '
                <script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                          title: "A field cannot be empty!!!",
                          text: "Please fill all the fields.",
                          icon: "error",
                          button: "Ok",
                        });
                    });
                </script>';
        echo $errorupdate;
    } 
    if(!isset($errorupdate)) {
        $update = $pdo->prepare("update tbl_user set username=:name, useremail=:email, password=:pass, role=:role where userid=".$id);
        $update->bindParam(':name', $username);
        $update->bindParam(':email', $useremail);
        $update->bindParam(':pass', $password);
        $update->bindParam(':role', $userrole);
        if($update->execute()) {
            echo '
            <script type="text/javascript">
                jQuery(function validation() {
                    swal({
                      title: "Updated!!!",
                      text: "The user information is updated successfully.",
                      icon: "success",
                      button: "Ok",
                    });
                });
            </script>';    
        } else {
            echo '
            <script type="text/javascript">
                jQuery(function validation() {
                    swal({
                      title: "Error!",
                      text: "The user information is not updated.",
                      icon: "error",
                      button: "Ok",
                    });
                });
            </script>'; 
        }
    }
}

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
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Registration Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
              
                <?php 
                //codes for edit button
                if(isset($_POST['btnedit'])) {
                    $select = $pdo->prepare("select * from tbl_user where userid=".$_POST['btnedit']);
                    $select->execute(); 
                    if($select) {
                        $row = $select->fetch(PDO::FETCH_OBJ); 
                        echo '
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label>Name</label>
                                  <input type="hidden" class="form-control" value="'.$row->userid.'" name="txtid">
                                  <input type="text" class="form-control" value="'.$row->username.'" name="txtname" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                  <label>Email address</label>
                                  <input type="email" class="form-control" value="'.$row->useremail.'" name="txtemail" placeholder="Enter email" >
                                </div>
                                <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" class="form-control" value="'.$row->password.'" name="txtpassword" placeholder="Password" >
                                </div>
                                <div class="form-group">
                                  <label>Role</label>
                                  <select class="form-control" name="txtselect_option" >
                                    <option value="" disabled selected>Select role</option>
                                    <option>User</option>
                                    <option>Admin</option>
                                  </select>
                                </div>
                                <button type="submit" class="btn btn-info" name="btnupdate">Update</button>
                            </div>';
                        
                    }
                } else {
                    echo '
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control" name="txtname" placeholder="Enter name" >
                            </div>
                            <div class="form-group">
                              <label>Email address</label>
                              <input type="email" class="form-control" name="txtemail" placeholder="Enter email" >
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" name="txtpassword" placeholder="Password" >
                            </div>
                            <div class="form-group">
                              <label>Role</label>
                              <select class="form-control" name="txtselect_option" >
                                <option value="" disabled selected>Select role</option>
                                <option>User</option>
                                <option>Admin</option>
                              </select>
                            </div>
                            <button type="submit" class="btn btn-info" name="btnsave">Save</button>
                        </div>';
                }
                  
                ?>
                
                <div class="col-md-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PASSWORD</th>
                                <th>ROLE</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
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
                                       <td>
                                            <button type="submit" value="'.$row->userid.'" class="btn btn-success" name="btnedit"><span class="glyphicon glyphicon-pencil" title="edit"></span></button>
                                       </td>
                                       <td>
                                            <button type="submit" value="'.$row->userid.'" class="btn btn-danger" name="btndelete"><span class="glyphicon glyphicon-trash" title="delete"></span></button>
                                       </td>
                                    </tr>
                                ';
                            }
                            ?>
                        </tbody> 
                    </table>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
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
