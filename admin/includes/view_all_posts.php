<script>
function toggle(source) {
  checkboxes = document.getElementsByName('checkbox_array[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
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
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" name="bulk_update" class="btn btn-success" value="Apply">
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
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                   
                               <?php
                                    $query = "SELECT * FROM posts ORDER BY post_id DESC ";
                                    $select_posts_query = mysqli_query($connection, $query);
                                    
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
                                        
                                        echo "<tr>";
                                        echo "<td><input type='checkbox' class='check_box' name='checkbox_array[]' value={$post_id}></td>";
                                        echo "<td>{$post_id}</td>";
                                        echo "<td>{$post_author}</td>";
                                        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                                        
                                        $query_2 = "SELECT * FROM categories WHERE cat_id = $post_category ";
                                        $select_categories_2 = mysqli_query($connection, $query_2);
                                        while($row = mysqli_fetch_assoc($select_categories_2)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            
                                        
                                        echo "<td>{$cat_title}</td>";
                                        }
                                        echo "<td>{$post_status}</td>";
                                        echo "<td><image width='100' src='../images/{$post_image}'></td>";
                                        echo "<td>{$post_tags}</td>";
                                        echo "<td>{$post_comments}</td>";
                                        echo "<td>{$post_date}</td>";
                                        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                                        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                                        echo "</tr>";
                        }
                                
                                if (isset($_GET['delete']))
                                {
                                    $the_post_id = $_GET['delete'];
                                    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
                                    $delete_query = mysqli_query($connection, $query);
                                    header("Location: posts.php");
                                    
                                }
                                ?>
                                
                            </tbody>
                        </table>
                         </form>