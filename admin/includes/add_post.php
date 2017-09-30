<?php 
    if(isset($_POST['create_post']))
    {
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['contents'];
        
        $post_tags = $_POST['tags'];
        $date = date('d-m-y');
        //$post_comment_count = 4;
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
        
        $create_post_query = mysqli_query($connection, $query);
        
        confirm_query($create_post_query);
    }
?>
  

  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
            
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select class='form-control' name="post_category_id" id="">
            <?php
                $query = "SELECT * FROM categories";
                $select_categories_query = mysqli_query($connection, $query);
                confirm_query($select_categories_query);
            
                 while($row = mysqli_fetch_assoc($select_categories_query)){
                     $cat_id = $row['cat_id'];
                     $cat_title = $row['cat_title'];
                     echo "<option value='$cat_id'>{$cat_title}</option>";
                 }
            ?>

        </select>
    </div>
    
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
                 <select class='form-control' name="status" id="">
             <option value='draft'>Draft</option>
             <option value = 'published'>Published</option>
        </select>
        <!-- <input type="text" class="form-control" name="status"> -->
    </div>
    
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>    
    
    <div class="form-group">
        <label for="contents">Post Contents</label>
        <textarea type="text" class="form-control" name="contents" cols="30" rows="10"></textarea>
    </div> 
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>