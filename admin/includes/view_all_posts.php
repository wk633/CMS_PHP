<table class='table table-hover table-bordered'>
<thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
    </tr>
</thead>
<tbody>
   <?php
    $query1 = "SELECT * FROM posts";
    $select_all_categories = mysqli_query($connection, $query1);
    while ($row = mysqli_fetch_assoc($select_all_categories)) {
        $post_id = $row['post_id'];
        $post_cat_id = $row['post_cat_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        // $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];

        echo "<tr>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_title}</td>";
        echo "<td>{$post_cat_id}</td>";
        echo "<td>{$post_status}</td>";
        echo "<td><img class='img-responsive' src='../images/{$post_image}' alt='img'></img></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "<td><a href='posts.php?source=edit_post&edit_id={$post_id}'>Edit</></td>";
        echo "</tr>";
    }
    ?>
    
    <?php
    if (isset($_GET['delete'])) {
        $post_id_delete = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$post_id_delete}";
        $delete_query = mysqli_query($connection, $query);
        confirmQuerySuccess($delete_query);
        header("Location: posts.php");
    }
    ?>

</tbody>
</table>