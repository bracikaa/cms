<?php include "includes/header.php" ?>
    <div id="wrapper">

        <!-- Navigation -->

<?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php if(isset($_GET['msg'])) { ?>
                                <div class="alert alert-success">
                                      <strong>Welcome back!</strong> You have successfully logged in <?php echo $_SESSION['user_name']; ?>!
                                </div>
                           <?php } ?>
                        <h1 class="page-header">
                            Blank Page
                            <small><?php echo $_SESSION['user_name']; ?></small>
                        </h1>
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
