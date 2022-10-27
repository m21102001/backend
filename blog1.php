<?php
require_once 'inc/conn.php';
if (!empty($_GET['delete'])) {
  $id = (int) $_GET['delete'];

  $sql = "DELETE FROM blog WHERE id = $id";
  $stmt = $conn->prepare($sql);
  $stmt = $stmt->execute();

  // $_SESSION['success'] = "blog Deleted!";

  header("location: blog1.php");
  die;
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
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- My style sheet -->
  <link href="css/styles.css" rel="stylesheet" />
  <style>
    .hello {
      height: 100px;
    }
  </style>
</head>

<body>
  <!-- Responsive navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#!">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
          class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="blog.php">Blog</a></li>
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
  <div class="container">
    <div class="row" style="align-content: center;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;"
    >
      <div class="col-lg-8 hello">
        <div class="card mb-4">
          <?php
                $a = 1;
                $stmt = $conn->prepare(
                  "SELECT * FROM blog");
                $stmt->execute();
                $blogs = $stmt->fetchAll();
                foreach ($blogs as $blog) {
                ?>
          <div class="card-body" style="text-align: center;">
            <h3 class="card-title" name="category">
              <?= $blog["category"] ?>
            </h3>
            <h2 class="card-title" name="title">
              <?= $blog["title"] ?>
            </h2>
            <p class="card-text" name="body">
              <?=$blog["body"]?>
            </p>
            <a href="blogadd.php" class="btn btn-sm btn-outline-primary mx-2">
              <span data-feather="plus" class="align-text-bottom"></span>
              Add
            </a>
            <a href="blogedit.php?id=<?= $blog['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
            <a href="?delete=<?= $blog['id'] ?>" class="btn btn-sm btn-danger">Delete</a>

          </div>
          <?php
                  echo "<hr>";

                }

                    ?>
        </div>




      </div>
      <?php
    if (!empty($_SESSION['success'])):
    ?>
      <div class="alert alert-success my-3">
        <p class="m-0 fs-5 text-center">
          <?= $_SESSION['success'] ?>
        </p>
      </div>
      <?php
      unset($_SESSION['success']);
    endif;
                ?>

      <?php
                if (!empty($_SESSION['error'])):
                ?>
      <div class="alert alert-danger my-3">
        <p class="m-0 fs-5 text-center">
          <?= $_SESSION['error'] ?>
        </p>
      </div>
      <?php
                  unset($_SESSION['error']);
                endif;
                ?>

      <script src="assets/js/bootstrap.bundle.min.js"></script>
      <script src="js/scripts.js"></script>
</body>

</html>