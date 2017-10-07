<?php include "includes/header.php" ?>
   
<?php if(isset($_SESSION['user_name']))
{
    $username = $_SESSION['user_name'];
    $query = "SELECT * FROM users where user_name = '{$username}' ";
    
    $select_profile_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($select_profile_query))
    {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        

    }
    
        if(isset($_POST['edit_user']))
    {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        
        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_name = '{$user_name}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE user_name = '{$username}' ";
        
        $update_user_query = mysqli_query($connection, $query);
        
        confirm_query($update_user_query);
    }
    
}
?> 

    
    <div id="wrapper">

        <!-- Navigation -->

<?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Profile
                            <small>by <?php echo $_SESSION['user_name']; ?></small>
                        </h1>
                        
                        
  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value = "<?php echo $user_firstname; ?>">
    </div>
           
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value = "<?php echo $user_lastname; ?>">
    </div>
            
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select class='form-control' name="user_role" id="">
            <?php 
                $user_role_capital = ucfirst($user_role);
                echo "<option value='$user_role'>$user_role_capital</option>";
            
                if($user_role == 'admin')
                {
                    echo "<option value='user'>User</option>";
                } else
                {
                    echo "<option value='admin'>Admin</option>";
                }
            ?>
             
             <option value = 'admin'>Admin</option>
        </select>
        <!-- <input type="text" class="form-control" name="status"> -->
    </div>
    
    <div class="form-group">
        <label for="user_email">User Email</label>
        <input type="email" class="form-control" name="user_email" value = "<?php echo $user_email; ?>">
    </div>
    
    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name" value = "<?php echo $user_name; ?>">
    </div>
    
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" value = "<?php echo $user_password; ?>">
    </div>     
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
    </div>
</form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/footer.php"; ?>
