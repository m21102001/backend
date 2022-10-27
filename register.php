<?php
require_once 'inc/conn.php';


$firstnameErr = $lastnameErr = $emailErr = $passwordErr = "";
$firstname = $lastname = $email = $password = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstname"])) {
    $firstnameErr = "Name is required";
  } else {
    $firstname = test_input($_POST["firstname"]);
  }
  if (empty($_POST["lastname"])) {
    $lastnameErr = "LastName is required";
  } else {
    $lastname = test_input($_POST["lastname"]);
  }
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
  if (empty($_POST["password"])) {
    $passwordErr = "Please enter password min 8";
  } else {
    $password = test_input($_POST["password"]);
  }
}
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  try {
    $sql = "INSERT INTO users (firstname, lastname, email, password)
    VALUES (:firstname, :lastname, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $_SESSION['success'] = "Your Account created successfully";
    header("location : header.php");
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <title>Register</title>
  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body class="bg-light">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Create Account</h3>
                </div>
                <div class="card-body">
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" name="firstname" id="inputFirstName" type="text"
                            placeholder="Enter your first name" />
                          <label for="inputFirstName">First name</label>
                          <span class="error">*
                            <?php echo $firstnameErr; ?>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" name="lastname" id="inputLastName" type="text"
                            placeholder="Enter your last name" />
                          <label for="inputLastName">Last name</label>
                          <span class="error">*
                            <?php echo $lastnameErr; ?>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" name="email" id="inputEmail" type="email"
                        placeholder="name@example.com" />
                      <label for="inputEmail">Email address</label>
                      <span class="error">*
                        <?php echo $emailErr; ?>
                      </span>

                    </div>
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" name="password" id="inputPassword" type="password"
                            placeholder="Create a password" />
                          <label for="inputPassword">Password</label>
                          <span class="error">*
                            <?php echo $passwordErr; ?>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" name="cpassword" id="inputPasswordConfirm" type="password"
                            placeholder="Confirm password" />
                          <label for="inputPasswordConfirm">Confirm Password</label>
                        </div>
                      </div>
                    </div>
                    <div class="mt-4 mb-0">
                      <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Register</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center py-3">
                  <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

  </div>
  <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>

<script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>