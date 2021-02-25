<?php
include('session.php');
?>
<html">

    <head>
        <title>Welcome </title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- custom css -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/form-style.css">

        <!-- bootstrap css links -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- font awesome cdn -->
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>

        <?php include('inc/connection.php'); ?>

        <?php include('inc/functions.php'); ?>


        <div class="top-nav-bar">
            <div class="search-box">
                <i class="fa fa-bars" aria-hidden="true" id="menu-btn" onclick="openmenu()"></i>
                <i class="fa fa-times" aria-hidden="true" id="close-btn" onclick="closemenu()"></i>
                <a href="./welcome.php" title="Home"><img src="img/logo/logo1.png" class="logo"></a>
                <!-- <h2 class="logo">Amba Sewana</h2> -->
                <!-- <input type="text" name="search-box" class="form-control-search">
                </a><span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span> -->
            </div><!-- search-box -->
            <div class="menu-bar">
                <ul>
                    <li><a href="./profile.php?employeeid=<?php echo $login_session ?>"><i class="fa fa-user-circle"></i> Profile</a></li>

                    <!-- non logged in user items go here -->  
                    <li><a href="./view-salary.php?employeeid=<?php echo $login_session ?>" ><i class="fa fa-money" ></i> Salary</a></li>

                    <li><a href="./logout.php" ><i class="fa fa-power-off" ></i> Log Out</a></li>

            </div>	
        </div>
        <section class="header">
            <!-- ---------------slider--------------- -->

            <div class="slider">
                <div id="slider" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider" data-slide-to="0" class="active"></li>
                        <li data-target="#slider" data-slide-to="1"></li>
                        <li data-target="#slider" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/slider1.jpg" class="d-block w-100" alt="..." >
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Welcome To Your Place</h5>
                                <p>Employee  <?php echo $login_session; ?></p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider2.jpg" class="d-block w-100" alt="..." >
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider3.jpg" class="d-block w-100" alt="..." >
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Third slide label</h5>
                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>	
            </div><!-- slider -->

        </section>




        <?php include('inc/footer.php'); ?>
    </body>

</html>

