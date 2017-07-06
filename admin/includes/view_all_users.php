<table class='table table-hover table-bordered'>
<thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
</thead>
<tbody>
   <?php
    $query_user = "SELECT * FROM users";
    $select_all_users = mysqli_query($connection, $query_user);
    while ($row = mysqli_fetch_assoc($select_all_users)) {
        
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

        
        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$user_name</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";
        echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
        echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</></td>";
        echo "</tr>";
    }
    ?>
    
    <?php
    if (isset($_GET['delete'])) {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin'){
                $user_id_delete = mysqli_real_escape_string($_GET['delete']);
                $query = "DELETE FROM users WHERE user_id = {$user_id_delete}";
                $delete_query = mysqli_query($connection, $query);
                confirmQuerySuccess($delete_query);
                header("Location: users.php");
            }
        }
        
    }
    ?>

</tbody>
</table>