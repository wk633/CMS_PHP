
<?php
if (isset($_POST['checkBoxArray'])) {
//    print_r($_POST['checkBoxArray']);
    $bulk_options = $_POST['bulk_options'];
    echo $bulk_options;
    
    foreach($_POST['checkBoxArray'] as $post_update_id){
        switch($bulk_options) {
            case 'published':
                $query = "update posts set post_status = 'published' where post_id={$post_update_id}";
                $update_to_published_status = mysqli_query($connection, $query);
                confirmQuerySuccess($update_to_published_status);
                break;
            case 'draft':
                $query = "update posts set post_status = 'draft' where post_id={$post_update_id}";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirmQuerySuccess($update_to_draft_status);
            case 'delete':
                $query = "delete from posts where post_id={$post_update_id}";
                $update_delete = mysqli_query($connection, $query);
                confirmQuerySuccess($update_delete);
            default:
                break;
        }
    }
} 
?>


<form action="" method="post">
    <div id="bulkOptionsContainer" class="col-xs-4" style="margin-bottom: 12px; padding-left: 0px">
        <select class="form-control" name="bulk_options" id="">
               <option value="">select options</option>
               <option value="published">Publish</option>
               <option value="draft">Draft</option>
               <option value="delete">Delete</option>
           </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>

    <table class='table table-hover table-bordered'>
        <thead>
            <tr>
                <th><input id="selectAllBox" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Delete</th>
                <th>Edit</th>
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
        echo "<td><input type='checkbox' name='checkBoxArray[]' class='checkBoxes' value='{$post_id}'></td>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td><a href='../post.php?post_id={$post_id}'>{$post_title}</a></td>";
        
        $query = "select * from categories where cat_id = {$post_cat_id};";
        $query_category_title = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($query_category_title);
        
        echo "<td>{$row['cat_title']}</td>";
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
</form>
