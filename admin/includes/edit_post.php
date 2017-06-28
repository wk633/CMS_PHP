<?php
if(isset($_GET['edit_id'])){
    $post_id_edit = $_GET['edit_id'];
    $query = "select * from posts where post_id = {$post_id_edit}";
    
    $query_result = mysqli_query($connection, $query);
    confirmQuerySuccess($query_result);
    $row = mysqli_fetch_assoc($query_result);
    
    $post_title = $row['post_title'];
    $post_category_id = $row['post_cat_id'];
    $post_author = $row['post_author'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
}

if (isset($_POST['update_post'])) {
    $post_id = $_POST['post_id'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_status = $_POST['post_status'];
    $post_image = $_POST['post_image'];
    
    $update_query = "update posts set post_title = '{$post_title}', post_cat_id = {$post_category_id}, post_author = '{$post_author}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_status = '{$post_status}' ";
    $query .= "where post_id = {$post_id};";
    
    $query_update_result = mysqli_query($connection, $update_query);
    confirmQuerySuccess($query_update_result);
}
    
?>



<form action="" method='post' enctype="multipart/form-data">
   <input type="post_id" name="post_id" value='<?php echo $post_id;?>' class="hidden">
   
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class='form-control' value='<?php echo $post_title;?>' name='post_title'>
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category Id</label>
        <br/>
        <select name="post_category_id" id="">
           <?php
            $query_cat = "select * from categories";
            $query_cat_result = mysqli_query($connection, $query_cat);
            confirmQuerySuccess($query_cat_result);
            
            while ($row=mysqli_fetch_assoc($query_cat_result)) {
                echo "<option value={$row['cat_id']}>{$row['cat_title']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class='form-control' value='<?php echo $post_author;?>' name='post_author'>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class='form-control' value='<?php echo $post_status;?>' name='post_status'>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        
        <input type="file" name='post_image'>
        <img src='../images/<?php echo $post_image;?>' width='100' alt="">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class='form-control' value='<?php echo $post_tags;?>' name='post_tags'>
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class='form-control' name="post_content" id="" cols="30" rows="10"><?php echo $post_content;?></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" value='update' name='update_post' class='btn btn-primary'>
    </div>
</form>