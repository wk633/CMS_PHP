<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    $user_name = mysqli_real_escape_string($connection, $user_name);
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $user_password = mysqli_real_escape_string($connection, $user_password);
    if (empty($user_name) || empty($user_email) || empty($user_password)) {
        echo "<script>alert('Fields cannot be empty')</script>";
//        header('Location: registration.php');
    }else {
        $message = "Your Registration has been submitted";
    
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        

        $query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
        $query .= "values('{$user_name}', '{$user_email}', '{$user_password}', 'subscriber');";

        $register_query = mysqli_query($connection, $query);
        if (!$register_query){
            die('Query Failed ' . mysqli_error($connection));
        }
        header("Location: index.php");
    }
  
}

?>
   
   
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php if (isset($message)) {echo $message;}?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="user_name" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2017</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->


<?php include "includes/footer.php";?>
