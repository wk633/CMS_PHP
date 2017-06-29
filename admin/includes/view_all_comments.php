<table class='table table-hover table-bordered'>
<thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>
   <?php
    $query1 = "SELECT * FROM comments";
    $select_all_comments = mysqli_query($connection, $query1);
    confirmQuerySuccess($select_all_comments);
    
    while ($row = mysqli_fetch_assoc($select_all_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id  = $row['comment_post_id'];
        $comment_content = $row['comment_content'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_author = $row['comment_author'];
        $comment_date = $row['comment_date'];
        
        

        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content</td>";
        
        echo "<td>$comment_email</td>";
        echo "<td>{$comment_status}</td>";
        
        $query = "select * from posts where post_id = {$comment_post_id};";
        $query_post_title = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($query_post_title);
        
        echo "<td><a href='../post.php?post_id={$comment_post_id}'>{$row['post_title']}</a></td>";
        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</></td>";
        
        echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
    
    <?php
    if (isset($_GET['delete'])) {
        $comment_id_delete = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$comment_id_delete}";
        $delete_query = mysqli_query($connection, $query);
        confirmQuerySuccess($delete_query);
        header("Location: comments.php");
    }
    
    ?>

</tbody>
</table>
