<?php 
        session_start(); 
        $pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/569b74aa6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        html {
          scroll-behavior: smooth;
        }
        </style>
</head>

<body>
    <header>
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg ">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-heartbeat fa-3x mx-3"></i>
                    Organs</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="mr-auto"></div>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <div class="mr-auto"></div>


                        <?php if( isset($_SESSION['name']) && ! empty($_SESSION['name'])){ ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo("Welcome ".$_SESSION['name']); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="de.php">Account</a>
                                <a class="dropdown-item" href="logout.php">log out</a>

                            </div>
                        </li>


                      
                        <?php } else { ?>
                          
                        <li class="nav-item">
                            <a class="nav-link" href="demo.php">Log in</a>
                            
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Sign Up</a>
                            
                        </li>
                        <?php } ?>

                    </ul>
                </div>
            </nav>

        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <h6>SAVING PEOPLE LIVES</h6>
                    <h1>ORGAN DONATION SYSTEM</h1>
                    <p>
                    Welcome to our organ donation website. This is a platform for patients, donors and doctors. Explore to learn more.
                    </p>
                    <a href="#section1" class="w3-button w3-black">Start looking</a>
                </div>
                <div class="col-md-5 col-sm-12 h-25">
                    <img src="5.png" alt="organs" class="image" />
                </div>
            </div>

        </div>

    </header>
    <main>
        <section class="sec1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pray">
                            <img src="../images/main-coeur.png" alt="prey" class="pruu" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel text-left">
                            <h1>ABOUT</h1>
                            
                            <p>
                            
    
    Hospitals are of great value to human society and there are several patients waiting for organs in order to be saved. Due to the growing information age we live in , it has become necessary to have an efficient computerised system to manage data about number of donors and patients who require a donation.
    

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sec2 container-fluid p-0">
            <div class="cover">
                <div class="content text-center">
                    <h1>KEEPING UP !!!</h1>
                    <p>
                    Below is the live data that's updated as users log on
                    </p>
                </div>
            </div>
            <div class="cotainer-fluid text-center">
                <div class="numbers d-flex flex-md-row flex-wrap justify-content-center">
                    <div class="rect">
                    <?php
                        $stmt1=$pdo->query("SELECT count(*) as count from patient ");
                        $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
                        echo('<h1>'.$row1['count']."</h1>\n");
                        echo('<p>Patients</p>');
                        ?>
                        
                    </div>
                    <div class="rect">
                    <?php
                        $stmt1=$pdo->query("SELECT count(*) as count from donor ");
                        $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
                        echo('<h1>'.$row1['count']."</h1>\n");
                        echo('<p>Donors</p>');
                        ?>
                    </div>
                    <div class="rect">
                    <?php
                        $stmt1=$pdo->query("SELECT count(*) as count from organisation ");
                        $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
                        echo('<h1>'.$row1['count']."</h1>\n");
                        echo('<p>Hospitals</p>');
                        ?>
                    </div>
                    <div class="rect">
                    <?php
                        $stmt1=$pdo->query("SELECT count(*) as count from doctor ");
                        $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
                        echo('<h1>'.$row1['count']."</h1>\n");
                        echo('<p>Doctors</p>');
                        ?>
                    </div>
                </div>
            </div>
            <div class="purchase text-center">
                <h1>Future of Organ Donation</h1>
                
            </div>
            <div class="row" id="section1">
                <div class="col-sm-4">
                  <div class="card text-center">
                    <div class="card-body">
                      <h5 class="card-title">USER</h5>
                      <p class="card-text">
                      <a href="details.php">For Patients and Donors</a> 
                    </p>
                    <div class="pricing">
                        <br>
                    <img src="user.png" alt="organs" class="image"><br>
                    <?php
                    if(isset($_SESSION['id'])){
                        echo('<a href="user2.php" class="btn btn-dark px-4 py-2  mb-4">'."Explore"."</a>");
                    }
                    else
                    {
                        echo('<a href="demo.php" class="btn btn-dark px-4 py-2  mb-4">'."Explore"."</a>");
                    }
                        ?>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="card text-center" >
                    <div class="card-body">
                        <h5 class="card-title">ORGANIZATION</h5>
                        <p class="card-text">
                        <a href="orgdet.php">For Hospitals</a> 
                      </p>
                      <div class="pricing">
                      <br>
                    <img src="hospital.jpg" alt="organs" class="image" /><br>
                          <a href="organization.php" class="btn btn-dark px-4 py-2  mb-4">Explore</a>
                    </div>
                  </div>
                </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-center">
                      <div class="card-body">
                        <h5 class="card-title">DOCTOR</h5>
                      <p class="card-text">
                        For Doctor
                    </p>
                    <div class="pricing">
                    <br>
                    <img src="doctor.jpg" alt="organs" class="image" /><br>
                        <a href="doctor.php" class="btn btn-dark px-4 py-2  mb-4">Explore</a>
                      </div>
                    </div>
                  </div>
              </div>    
            </div>
        </section>
        <section class="section-3 container-fluid p-0 text-center">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <h1>Coming Soon!!!</h1>
                    <p>
                        Catch us on all platforms.
                    </p>
                </div>
            </div>
            <div class="platform row">
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="desktop shadow-lg">
                        <div class="d-flex flex-row justify-content-center">
                            <i class="fas fa-desktop fa-3x py-2 pr-3"></i>
                            <div class="text text-left">
                                <h3 class="pt-1 m-0">DESKTOP</h3>
                                <p class="p-0 m-0">on website</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 text-left">
                    <div class="desktop shadow-lg">
                        <div class="d-flex flex-row justify-content-center">
                            <i class="fas fa-mobile-alt fa-3x py-2 pr-3"></i>
                            <div class="text text-left">
                                <h3 class="pt-1 m-0">Mobile</h3>
                                <p class="p-0 m-0">on playstore</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </section>
        <section class="sec-4">
            <div class="container text-center">
                <h1 class="text-dark">team members</h1>
                <p class="text-sec">Meet The Team.</p>
            </div>
            <style>
                .carousel-control-prev-icon {
                    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23f00' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
                }

                .carousel-control-next-icon {
                    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23f00' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
                }
            </style>
            <div class="team row">

            <div class="col-md-4 col-12 text-center">
                    <div class="card mr-2 d-inline-block shadow-lg">
                        <div class="card-img-top">
                            <img src="../images/trishadp.jpg"  style="height: 170px;" alt="member" class="img-fluid border-radius">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">MEMBER 1</h3>
                            <p class="card-text">
                                Contact <br>
                                +91 95916 95859
                            </p>
                            <a href="#" class="text-sec text-decoration-none">Trisha Chander</a>
   

                        </div>

                    </div>

                </div>

                <div class="col-md-4 col-12 text-center">
                    <div class="card mr-2 d-inline-block shadow-lg">
                        <div class="card-img-top">
                            <img src="../images/ganithdp2.jpg" style="height: 170px;" alt="member" class="img-fluid border-radius">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">MEMBER 2</h3>
                            <p class="card-text">
                                Contact <br>
                                +91 95387 41583
                            </p>
                            <a href="#" class="text-sec text-decoration-none">V GANITH</a>
   

                        </div>

                    </div>

                </div>

                <div class="col-md-4 col-12 text-center">
                    <div class="card mr-2 d-inline-block shadow-lg">
                        <div class="card-img-top">
                            <img src="../images/vasanthdp.png" style="height: 170px;" alt="member" class="img-fluid border-radius">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">MEMBER 3</h3>
                            <p class="card-text">
                                Contact <br>
                                +91 99943 29011
                            </p>
                            <a href="#" class="text-sec text-decoration-none">Vasanth S</a>
   

                        </div>

                    </div>

                </div>
                


            </div>
        </section>


    </main>
    <footer>
        <div class="container-fluid p-0">
            <div class="row text-left">
                <div class="col-md-5 col-md-5">
                    <h1 class="text-light">About Us</h1>
                    <p class="text-muted">
                        
                    </p>
                    <p class="pt-4 text-muted">
                        Copyright ©2020 All rights reserved | This template is made by <span>"the gang"</span>
                    </p>
                </div>
                <div class="col-md-5">
                    <h4 class="text-light">Information Updates</h4>
                    <p class="text-muted">Stay updated</p>
                    <form class="form-inline">
                        <div class="col pl-">
                            <div class="input-group pr-5">
                                <input type="text" class="form-control bg-dark text-white" placeholder="Email">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 col-sm-12">
                    <h4 class="text-light">Follow Us</h4>
                    <p class="text-muted">Let us be social</p>
                    <div class="footer column ">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-twitter"></i>
                    </div>
                </div>
            </div>

        </div>

    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

</html>