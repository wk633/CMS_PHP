<?php
include "db.php";
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
        
    }
    
    if ($username !== $db_username &&  $password !== $db_password) {
        header('Location: ../index.php');
    }else if ($username == $db_username &&  $password == $db_password) {
        header('Location: ../admin');
    }else {
        header('Location: ../index.php');
    }
    
}
?>