<table class = "table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <!-- <th>Post Id</th> -->
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response To</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                    $query = "SELECT * FROM comments";
                                    $select_comments_query = mysqli_query($connection, $query);
                                    
                                    while($row = mysqli_fetch_assoc($select_comments_query))
                                    {
                                        $comment_id = $row['comment_id'];
                                        $comment_post_id = $row['comment_post_id'];
                                        $comment_author = $row['comment_author'];
                                        $comment_email = $row['comment_email'];
                                        $comment_content = $row['comment_content'];
                                        $comment_status = $row['comment_status'];
                                        $comment_date = $row['comment_date'];
                                        
                                        echo "<tr>";
                                        echo "<td>{$comment_id}</td>";
                                        echo "<td>{$comment_author}</td>";
                                        echo "<td>{$comment_content}</td>";
                                        
                                        //$query_2 = "SELECT * FROM categories WHERE cat_id = $post_category ";
                                        //$select_categories_2 = mysqli_query($connection, $query_2);
                                        //while($row = mysqli_fetch_assoc($select_categories_2)){
                                        //    $cat_id = $row['cat_id'];
                                        //    $cat_title = $row['cat_title'];   
                                        //echo "<td>{$cat_title}</td>";
                                        //}
                                        
                                        echo "<td>{$comment_email}</td>";
                                        echo "<td>{$comment_status}</td>";
                                        
                                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                                        $select_posts_for_response = mysqli_query($connection, $query);
                                                                 
                                        while($row = mysqli_fetch_assoc($select_posts_for_response))
                                        {
                                            
                                            $response_post_id = $row['post_id'];
                                            $response_post_title = $row['post_title'];

                                            echo "<td><a href='../post.php?p_id={$response_post_id}'>{$response_post_title}</a></td>";
                                        }
                                        
                                        
                                        echo "<td>{$comment_date}</td>";
                                        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                                        echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                                        echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                                        echo "</tr>";
                        }
                                
                                if (isset($_GET['delete']))
                                {
                                    $the_comment_id = $_GET['delete'];
                                    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
                                    $delete_query = mysqli_query($connection, $query); 
                                    header("Location: comments.php");
                                }
                                
                                if (isset($_GET['approve']))
                                {
                                    $the_comment_id = $_GET['approve'];
                                    $query = "UPDATE comments SET comment_status = 'approved' where comment_id = {$the_comment_id} ";
                                    $set_comments_to_approved = mysqli_query($connection, $query);
                                    header("Location: comments.php");
                                }
                                
                                if (isset($_GET['unapprove']))
                                {
                                    $the_comment_id = $_GET['unapprove'];
                                    $query = "UPDATE comments SET comment_status = 'unapproved' where comment_id = {$the_comment_id} ";
                                    $set_comments_to_approved = mysqli_query($connection, $query);
                                    header("Location: comments.php");
                                }
                                
                                ?>
                                
                            </tbody>
                        </table>