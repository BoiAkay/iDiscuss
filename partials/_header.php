<?php
    @session_start();
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/idiscuss">
      <img src="images/android-chrome-512x512.png" width="30" height="30" class="d-inline-block align-top" alt="">
      
      iDiscuss
      
      
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/idiscuss">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php" >About Us</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            <li class="nav-item">
            <a class="nav-link" href="contactus.php">Contact Us</a>
          </li>
        </ul>
     
        <form class="d-flex" action="search.php" method="GET">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>';
      
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
      {
        echo '<div class="mx-2">
              <a href="partials/_logout.php" class="btn btn-outline-success my-2 mb-1" " data-bs-target="#logoutmodal">Logout</a>
              </div>';
        
      }
      else
      {
       echo '
        <div class="mx-2">
           <button class="btn btn-outline-success my-2 mb-1" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
           <button class="btn btn-outline-success my-2 mb-1" data-bs-toggle="modal" data-bs-target="#signupmodal">SignUp</button>
       </div>'; 

      }
      echo '
      </div>
    </div>
  </nav>';
  include 'partials/_loginmodal.php';
  include 'partials/_signupmodal.php';
  if(isset($_GET['signup_success']) && $_GET['signup_success']=="true")
  {
    echo '<div class="alert alert-success alert-dismissible fade show text-center my-0" role="alert">
    <strong>Signup successful !!!</strong> you have joined the community of 100+ members. Login to start disscussion
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  if(isset($_GET['login_success']) && $_GET['login_success']=="true")
  {
    echo '<div class="alert alert-success alert-dismissible fade show text-center my-0" role="alert">
    <strong>Login successful !!!</strong> You can post query now.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  if(isset($_GET['error']))
  {
    echo '<div class="alert alert-danger alert-dismissible fade show text-center my-0" role="alert">
    <strong>faliure !!!</strong> '.$_GET['error'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  
?>
