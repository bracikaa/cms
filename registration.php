<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

    
<?php

    function checkQuery($query)
    {
        global $connection;
        if(!$query)
        {
            die("Error " . mysqli_error($connection));
        }
            
    }


    if(isset($_POST['submit']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        if(empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($email))
        {
            echo "<div class='alert alert-danger col-md-6 col-md-offset-3'>";
            if(empty($firstname)) {
                echo "<p><strong>Field Empty </strong> First Name should not be empty</p>";
            }
               
            if(empty($lastname)) {
                echo "<p><strong>Field Empty </strong> Lastname should not be empty </p>";
            }
                              
            if(empty($username)) {
                echo "<p><strong>Field Empty </strong> Username should not be empty </p>";
            }
                                             
            if(empty($password)) {
                echo "<p><strong>Field Empty </strong> Password should not be empty </p>";
            }
                                                            
           if(empty($email)) {
                echo "<p><strong>Field Empty </strong> First Name should not be empty </p>";
            }
            echo "</div>";
        }
              
        
        else {
            $firstname = mysqli_real_escape_string($connection, $firstname);
            $lastname = mysqli_real_escape_string($connection, $lastname);
            $username = mysqli_real_escape_string($connection, $username);
            //$password = mysqli_real_escape_string($connection, $password);
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
            $email = mysqli_real_escape_string($connection, $email);

            //$query = "SELECT user_randSalt FROM users ";
            //$select_salt = mysqli_query($connection, $query);
            //checkQuery($select_salt);

            //$row = mysqli_fetch_assoc($select_salt);
            //$salt = $row['user_randSalt'];
            //$password = crypt($password, $salt);
            

            $query = "INSERT INTO users (user_firstname, user_lastname, user_name, user_email, user_password, user_image, user_role) ";
            $query.= "VALUES('{$firstname}', '{$lastname}', '{$username}', '{$email}', '{$password}', 'image', 'user') ";

            $register_user_query = mysqli_query($connection, $query);
            checkQuery($register_user_query);
            
            echo "<div class='alert alert-success col-md-6 col-md-offset-3'>";
            echo "<p><strong>User Created! </strong> Welcome $username! </p>";
            echo "</div>";
        }
        
    }
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Please enter your First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Please enter your Last Name">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
