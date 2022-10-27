<?php
require_once 'inc/conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title =  $_POST['title'];
    $body =  $_POST['body'];
    $category =  $_POST['category'];
  
  
  
  
    try {
      $sql = "INSERT INTO blog (title, body, category)
      VALUES (:title,  :body, :category)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':title' , $title);
      $stmt->bindParam(':body' , $body);
      $stmt->bindParam(':category' , $category);
  
     $stmt->execute();  
    //   $_SESSION['success'] = "Your post created successfully";
      header("location : blog1.php");
    //   echo "<script>window.location = 'users.php'</script>";

    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    
    $conn = null;
  }
  
  ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Home - Start Bootstrap Template</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .ride{
            width:400px;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
            </div>
        </div>
    </header>
    <div class="container card my-3 p-3 ride">
    <form method="POST">
        <div class="form-floating my-3">
            <input type="text" name="title" class="form-control" id="title" placeholder="title">
            <label for="title">title</label>
        </div>
        <div class="form-floating my-3">
            <input type="text" name="body" class="form-control" id="body" placeholder="Description">
            <label for="body">Description</label>
        </div>
        <div class="form-floating my-3">
            <input type="text" name="category" class="form-control" id="category" placeholder="Category">
            <label for="category">Category</label>
        </div>

        <button class="w-100 btn btn-md btn-primary" type="submit">Post</button>

    </form>
</div>


    
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>
    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
   
    <script src="js/scripts.js"></script>
</body>

</html>
