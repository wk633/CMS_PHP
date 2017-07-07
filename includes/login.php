<?php
include "db.php";
session_start();
?>


<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $username = mysqli_real_escape_string($connection, $username); // data clean
    $password = mysqli_real_escape_string($connection, $password); // data clean
    
    $query = "select * from users where user_name = '{$username}'";
    $query_result = mysqli_query($connection, $query);
    
    if (!$query_result) {
        die("Query Failed " . mysqli_error($connection));
    }
    
    while ($row = mysqli_fetch_array($query_result)) {
        $db_id = $row['user_id'];
        $db_username = $row['user_name'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_password = $row['user_password'];
        $db_user_role = $row['user_role'];
        $db_user_salt = $row['randSalt'];
        
        
        
        
        if (password_verify($password, $db_password)) {
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_firstname;
            $_SESSION['lastname'] = $db_lastname;
            $_SESSION['role'] = $db_user_role;
            $_SESSION['user_id'] = $db_id;
            header('Location: ../admin');
            return;
        }
        
    }
    header('Location: ../index.php');
    
   
    
}
?>