<?php 
    if(isset($_POST['create_user']))
    {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

        
        $query = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_randSalt) ";
        $query .= "VALUES('{$user_name}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', 'image', '{$user_role}', '3') ";
        
        $create_user_query = mysqli_query($connection, $query);
        
        confirm_query($create_user_query);
        
        echo "<div class='alert alert-success'>";
        echo "<strong>User Created! </strong>Go back to <a href='users.php?view_all_users'>View All Users!</a>";
        echo "</div>";
    }
?>
  

  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
           
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
            
    <div class="form-group">
        <label for="user_role">User Role</label>
                 <select class='form-control' name="user_role" id="">
             <option value='user'>User</option>
             <option value = 'admin'>Admin</option>
        </select>
        <!-- <input type="text" class="form-control" name="status"> -->
    </div>
    
    <div class="form-group">
        <label for="user_email">User Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name">
    </div>
    
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>     
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add user">
    </div>
</form>