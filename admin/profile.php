<?php include "includes/header.php"; ?>

<?php
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    
    $query = "select * from users where user_id = '{$user_id}'";
    $query_result = mysqli_query($connection, $query);

    confirmQuerySuccess($query_result);
    $row = mysqli_fetch_assoc($query_result);
    
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_name = $row['user_name'];
    $user_role = $row['user_role'];
    $user_email = $row['user_email'];
}

if (isset($_POST['update_profile'])) {
    
    $user_id = $_SESSION['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_name = $_POST['user_name'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    
    
    $update_query = "update users set ";
    $update_query .= "user_firstname = '{$user_firstname}', ";
    $update_query .= "user_lastname = '{$user_lastname}', ";
    $update_query .= "user_name = '{$user_name}', ";
    $update_query .= "user_role = '{$user_role}', ";
    $update_query .= "user_email = '{$user_email}' ";
    $update_query .= "where user_id = $user_id";

    
    $query_update_result = mysqli_query($connection, $update_query);
    confirmQuerySuccess($query_update_result);
    header("Location: profile.php");
}

?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    
                    <h1 class="page-header">
                        Welcome to admin page
                        <small>Subheading</small>
                    </h1>
                    
                    <form action="" method='post' enctype="multipart/form-data">
   
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class='form-control' value="<?php echo $user_firstname?>" name='user_firstname'>
                        </div>

                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class='form-control' value="<?php echo $user_lastname?>" name='user_lastname'>
                        </div>

                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" class='form-control' value="<?php echo $user_name?>" name='user_name'>
                        </div>

                        <div class="form-group">
                            <label for="">Role</label>
                            <br/>
                            <select name="user_role" id="">
                              <?php
                                if ($user_role === 'admin') {
                                    echo "<option value='admin' selected='selected'>admin</option>";
                                }else {
                                    echo "<option value='admin'>admin</option>";
                                }

                                if ($user_role === 'subscriber') {
                                    echo "<option value='subscriber' selected='selected'>subscriber</option>";
                                }else {
                                    echo "<option value='subscriber'>subscriber</option>";
                                }

                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class='form-control' value="<?php echo $user_email; ?>" name='user_email'>
                        </div>



                    <!--
                        <div class="form-group">
                            <label for="post_image">Post Image</label>
                            <input type="file" name='post_image'>
                        </div>
                    -->


                        <div class="form-group">
                            <input type="submit" value='Update Profile' name='update_profile' class='btn btn-primary'>
                        </div>
                    </form>
                    
                    
                    
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/footer.php"; ?>
