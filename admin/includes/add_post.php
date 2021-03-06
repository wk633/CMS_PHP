<?php
if(isset($_POST['create_post'])){
    $post_title = escape($_POST['post_title']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_author = escape($_POST['post_author']);
    $post_status = escape($_POST['post_status']);
    
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    
    
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    
//    $post_date = date('d-m-y');
//    $post_comment_count = 4;
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query = "insert into posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) values ";
    
    $query .= "({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
    
    $create_post_query = mysqli_query($connection, $query);
    
    confirmQuerySuccess($create_post_query);
    
    $the_post_id = mysqli_insert_id($connection);
    
    echo "<p class='bg-success'>Post created. <a href='../post.php?post_id={$the_post_id}'>View Post</a></p>";
//    header('Location: posts.php');

}
?>



<form action="" method='post' enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class='form-control' name='post_title'>
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
        <input type="text" class='form-control' name='post_author'>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br/>
        <select name="post_status" id="post_status">
            <option value="draft">draft</option>
            <option value="published">published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name='post_image'>
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class='form-control' name='post_tags'>
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class='form-control' name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" value='publish' name='create_post' class='btn btn-primary'>
    </div>
</form>