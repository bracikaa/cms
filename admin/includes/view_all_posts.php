<?php include('delete_modal.php'); ?>


<script>
function toggle(source) {
  checkboxes = document.getElementsByName('checkbox_array[]');
  for(var i=0, n=checkboxes.length; i<n; i++) {
    checkboxes[i].checked = source.checked;
  }
}
    
$(document).ready(function(){
   $(".delete_link").on('click', function(){
      var id = $(this).attr("rel");
      var delete_url = "posts.php?delete=" + id + " ";
      $(".modal_delete").attr("href", delete_url);
       $("#myModal").modal('show');
   });
});
</script>

    <?php 

    if(isset($_POST['checkbox_array']))
    {
        foreach($_POST['checkbox_array'] as $check_box_value)
        {
            //echo $check_box_value;
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options)
            {
                case 'published':
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' where post_id = {$check_box_value} ";
                    $update_post_status = mysqli_query($connection, $query);
                    break;
                    
                case 'clone':
                    $query="SELECT * FROM posts where post_id = {$check_box_value}";
                    $clone_post_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($clone_post_query))
                    {
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_title = $row['post_title'];
                        $post_category = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_comments = $row['post_comment_count'];
                        $post_date = $row['post_date'];
                        $post_content = $row['post_content'];
                        
                        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                        $query .= "VALUES('{$post_category}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
                        $create_post_query = mysqli_query($connection, $query);
                    }  
                    break;
                    
                case 'delete':   
                    $query = "DELETE FROM posts WHERE post_id = {$check_box_value} ";
                    $delete_query = mysqli_query($connection, $query);
                    header("Location: posts.php");
                    break;
            } 
            
        }
    }

?>
   

   <table class = "table table-bordered table-hover">
    
                           <form class="form-group" method="post" action="">
                            <div id="bulkContainer" class = "col-xs-4">
                                <select class = "form-control" name="bulk_options" id="">
                                    <option value="draft">Draft</option>
                                    <option value="published">Publish</option>
                                    <option value="clone">Clone</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input onClick=" javascript: return confirm('Are you sure you want to change the status of the Posts?')" type="submit" name="bulk_update" class="btn btn-success" value="Apply">
                                <a href="posts.php?source=add_post" class="btn btn-primary">Add New Post</a>
                            </div>
                            
                            <br><br><br>
                            
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all_checkboxes" onClick="toggle(this)"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>View Count</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                   
                               <?php
                                    //$query = "SELECT * FROM posts ORDER BY post_id DESC ";
                                    $query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_view_count, categories.cat_id, categories.cat_title ";
                                
                                    $query .= " FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC ";
                                
   
                                    $select_posts_query = mysqli_query($connection, $query);
                                
                                         if(!$select_posts_query)
                                        {
                                            die("Query Failed " . mysqli_error($connection));
                                        }
                                    
                                    while($row = mysqli_fetch_assoc($select_posts_query))
                                    {
                                        $post_id = $row['post_id'];
                                        $post_author = $row['post_author'];
                                        $post_title = $row['post_title'];
                                        $post_category = $row['post_category_id'];
                                        $post_status = $row['post_status'];
                                        $post_image = $row['post_image'];
                                        $post_tags = $row['post_tags'];
                                        $post_comments = $row['post_comment_count'];
                                        $post_date = $row['post_date'];
                                        $post_view_count = $row['post_view_count'];
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        
                                        echo "<tr>";
                                        echo "<td><input type='checkbox' class='check_box' name='checkbox_array[]' value={$post_id}></td>";
                                        echo "<td>{$post_id}</td>";
                                        echo "<td>{$post_author}</td>";
                                        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                                        
                                        //$query_2 = "SELECT * FROM categories WHERE cat_id = $post_category ";
                                        //$select_categories_2 = mysqli_query($connection, $query_2);
                                        //while($row = mysqli_fetch_assoc($select_categories_2)){
                                        //    $cat_id = $row['cat_id'];
                                        //    $cat_title = $row['cat_title'];
                                            
                                        
                                        echo "<td>{$cat_title}</td>";
                                        //}
                                        echo "<td>{$post_status}</td>";
                                        echo "<td><image width='100' src='../images/{$post_image}'></td>";
                                        echo "<td>{$post_tags}</td>";
                                        
                                        $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} AND comment_status ='approved' ";
                                        $count_comments_query = mysqli_query($connection, $query);
                                        $row = mysqli_fetch_array($count_comments_query);
                                        $comment_id = $row['comment_id'];
                                        $num_of_comments = mysqli_num_rows($count_comments_query);
                                        
                                        echo "<td><a href='comments.php?post_comments_id={$post_id}'>{$num_of_comments}</a></td>";
                                        echo "<td><a href='posts.php?reset={$post_id}'>{$post_view_count}</a></td>";
                                        echo "<td>{$post_date}</td>";
                                        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                                        //echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?') \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                                        echo "<td><a rel='{$post_id}' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                                        echo "</tr>";
                        }
                                
                                if (isset($_GET['delete']))
                                {
                                    $the_post_id = $_GET['delete'];
                                    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
                                    $delete_query = mysqli_query($connection, $query);
                                    header("Location: posts.php");
                                    
                                }
                                
                                if (isset($_GET['reset']))
                                {
                                    $the_post_id = mysqli_real_escape_string($connection, $_GET['reset']);
                                    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$the_post_id} ";
                                    $reset_query = mysqli_query($connection, $query);
                                    header("Location: posts.php");
                                    
                                }
                                ?>
                                
                            </tbody>
                        </table>
                         </form>