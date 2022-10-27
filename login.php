<?php
require_once 'inc/conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email =  $_POST['email'];
  $password =  $_POST['password'];


  try {
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();  
    
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $result = $stmt->fetch();
  if($result) {
    $_SESSION['userid'] = $result['id'];
    $_SESSION['username'] = $result['firstname'];
    header("location: header.php");
    die;
  } else {
    $error = "Check your email and password!";
  }

  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  
  $conn = null;
}



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<section class="vh-100" style="background-color: #9A616D;">
              <div class="container h-100 pt-5" >
      <div class="row d-flex justify-content-center align-items-center h-50">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 10px;">
            <div class="card-body p-5">
                <form action=" " method="POST">
            
         
                  <div class="d-flex align-items-center mb-3 pb-1">
                
                    <span class="h1 fw-bold mb-0 text-center">Blog</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="name@example.com" />
                    <label class="form-label" for="email">Email address</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password"  name="password" class="form-control form-control-lg" id="password" placeholder="Password" />
                    <label for="password">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg " name="login" type="submit">Login</button>
                  </div>
                  <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register.php"
                      style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>