<?php
if(isset($_GET['user_id'])){
    $user_id_edit = $_GET['user_id'];
    $query = "select * from users where user_id = {$user_id_edit}";
    
    $query_result = mysqli_query($connection, $query);
    confirmQuerySuccess($query_result);
    $row = mysqli_fetch_assoc($query_result);
    
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_name = $row['user_name'];
    $user_role = $row['user_role'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
}

if (isset($_POST['update_user'])) {
    
    $user_id = $_GET['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_name = $_POST['user_name'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = password_hash($_POST['user_password'], PASSWORD_BCRYPT, array('cost' => 12));
    
    $update_query = "update users set ";
    $update_query .= "user_firstname = '{$user_firstname}', ";
    $update_query .= "user_lastname = '{$user_lastname}', ";
    $update_query .= "user_name = '{$user_name}', ";
    $update_query .= "user_role = '{$user_role}', ";
    $update_query .= "user_email = '{$user_email}', ";
    $update_query .= "user_password = '{$user_password}' ";
    $update_query .= "where user_id = $user_id";

    
    $query_update_result = mysqli_query($connection, $update_query);
    confirmQuerySuccess($query_update_result);
    header("Location: users.php");
}
    
?>



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
    
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" value="<?php echo $user_password; ?>" name="user_password">
    </div>
    
    
<!--
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name='post_image'>
    </div>
-->

    
    <div class="form-group">
        <input type="submit" value='submit' name='update_user' class='btn btn-primary'>
    </div>
</form>