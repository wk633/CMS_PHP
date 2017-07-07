<?php
if(isset($_POST['create_user'])){
    
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_name = escape($_POST['user_name']);
    $user_role = escape($_POST['user_role']);
    $user_email = escape($_POST['user_email']);
    $user_password = password_hash($_POST['user_password'], PASSWORD_BCRYPT, array('cost' => 12));
    
    $query_insert = "insert into users (user_firstname, user_lastname, user_name, user_role, user_email, user_password) ";
    $query_insert .= "values ('{$user_firstname}', '{$user_lastname}', '{$user_name}', '{$user_role}', '{$user_email}', '{$user_password}')";
    
    $query_insert_result = mysqli_query($connection, $query_insert);
    confirmQuerySuccess($query_insert_result);
    header("Location: users.php");

}
?>



<form action="" method='post' enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" class='form-control' name='user_firstname'>
    </div>
    
    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" class='form-control' name='user_lastname'>
    </div>
    
    <div class="form-group">
        <label for="">User Name</label>
        <input type="text" class='form-control' name='user_name'>
    </div>
    
    <div class="form-group">
        <label for="">Role</label>
        <br/>
        <select name="user_role" id="">
           <option value="subscriber">Select a role</option>
           <option value="admin">admin</option>
           <option value="subscriber">subscriber</option>
        </select>

    </div>
    
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" class='form-control' name='user_email'>
    </div>
    
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" class='form-control' name='user_password'>
    </div>
    
    
    
<!--
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name='post_image'>
    </div>
-->

    
    <div class="form-group">
        <input type="submit" value='submit' name='create_user' class='btn btn-primary'>
    </div>
</form>