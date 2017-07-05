<?php
if(isset($_GET['edit_id'])){
    $post_id_edit = $_GET['edit_id'];
    $query = "select * from posts where post_id = {$post_id_edit}";
    
    $query_result = mysqli_query($connection, $query);
    confirmQuerySuccess($query_result);
    $row = mysqli_fetch_assoc($query_result);
    $post_id = $row['post_id'];
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
    
    $post_image = $_FILES['post_image']['name'];
    $post_image_tmp = $_FILES['post_image']['tmp_name'];
    
    move_uploaded_file($post_image_tmp, "../images/$post_image");
    
    // deal with picture update problem
    if (empty($post_image)) {
        $query = "select * from posts where post_id = {$post_id}";
        $query_select_image = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($query_select_image);
        $post_image = $row['post_image'];
    }
    
    $update_query = "update posts set ";
    $update_query .= "post_title = '{$post_title}', ";
    $update_query .= "post_cat_id = {$post_category_id}, ";
    $update_query .= "post_date = now(), ";
    $update_query .= "post_author = '{$post_author}', ";
    $update_query .= "post_tags = '{$post_tags}', ";
    $update_query .= "post_content = '{$post_content}', ";
    $update_query .= "post_status = '{$post_status}', ";
    $update_query .= "post_image = '{$post_image}' ";
    $update_query .= "where post_id = {$post_id};";
    
    $query_update_result = mysqli_query($connection, $update_query);
    confirmQuerySuccess($query_update_result);
//    header("Location: posts.php");
    echo "<p class='bg-success'>Post updated. <a href='../post.php?post_id={$post_id}'>View Post</a>&nbsp;&nbsp;or&nbsp;&nbsp;<a href='./posts.php'>Edit More</a></p>";
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
                if ($row['cat_id'] == $post_category_id) {
                    echo "<option selected='selected' value={$row['cat_id']}>{$row['cat_title']}</option>";
                }else {
                    echo "<option value={$row['cat_id']}>{$row['cat_title']}</option>";
                }
                
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
        <br/>
        <select name="post_status" id="">
            <option value="draft" <?php if($post_status == 'draft') echo "selected='selected'"; ?>>draft</option>
            <option value="published" <?php if($post_status == 'published') echo "selected='selected'"; ?>>published</option>
        </select>
        
<!--        <input type="text" class='form-control' value='<?php echo $post_status;?>' name='post_status'>-->
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