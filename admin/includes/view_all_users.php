<table class = "table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                
                                    $query = "SELECT * FROM users ";
                                    $select_users_query = mysqli_query($connection, $query);
                                    
                                    while($row = mysqli_fetch_assoc($select_users_query))
                                    {
                                        $user_id = $row['user_id'];
                                        $user_name = $row['user_name'];
                                        $user_password = $row['user_password'];
                                        $user_firstname = $row['user_firstname'];
                                        $user_lastname = $row['user_lastname'];
                                        $user_email = $row['user_email'];
                                        $user_image = $row['user_image'];
                                        $user_role = $row['user_role'];

                                        
                                        echo "<tr>";
                                        echo "<td>{$user_id}</td>";
                                        echo "<td>{$user_name}</td>";
                                        echo "<td>{$user_firstname}</td>";
                                        echo "<td>{$user_lastname}</td>";
                                        echo "<td>{$user_email}</td>";
                                        echo "<td>{$user_role}</td>";
                                        if($_SESSION['user_role'] == 'admin'){
                                            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                                            echo "<td><a href='users.php?change_to_user={$user_id}'>User</a></td>";
                                            echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
                                            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                                        }
                                        
                                    }
                                ?>                   
                            </tbody>
                            <?php
                            if(isset($_GET['delete']))
                            {
                                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')
                                {
                                    $user_id_to_delete = mysqli_real_escape_string($_GET['delete']);
                                    $query = "DELETE FROM users WHERE user_id = {$user_id_to_delete}" ;
                                    $delete_user_query = mysqli_query($connection, $query);
                                    header("Location: users.php");
                                }

                            }
    
                            if(isset($_GET['change_to_admin']))
                            {
                                $user_id_admin = $_GET['change_to_admin'];
                                $query = "UPDATE users SET user_role = 'admin' where user_id = {$user_id_admin } ";
                                $update_user_query = mysqli_query($connection, $query);
                                header("Location: users.php");

                            }
    
                            if(isset($_GET['change_to_user']))
                            {
                                $user_id_user = $_GET['change_to_user'];
                                $query = "UPDATE users SET user_role = 'user' where user_id = {$user_id_user} ";
                                $update_user_query = mysqli_query($connection, $query);
                                header("Location: users.php");

                            }
                            ?>
</table>
                        
                    