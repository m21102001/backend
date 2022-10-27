<?php
require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    try {
        $sql = "INSERT INTO users(firstname, email, password) VALUES (:firstname, :email, :password)";

        $stmt = $conn->prepare($sql);

        $params = [
            'firstname' => $firstname,
            'email' => $email,
            'password' => $password
        ];

        $stmt->execute($params);

        $_SESSION['success'] = "Account created successfully";
        echo "<script>window.location = 'users.php'</script>";
        die;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
<head>
    <style>
        .good{
            position : relative;
            bottom : 600px;
        }
        .ride{
            position : relative;
            bottom : 500px;
            width:400px;
        }
    </style>
</head>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom good">
    <h1 class="h2">Add User</h1>
    <a href="users.php" class="btn btn-warning">
        < back</a>
</div>
<div class="container card my-3 p-3 ride">
    <form method="POST">
        <div class="form-floating my-3">
            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="firstname">
            <label for="firstname">First Name</label>
        </div>
        <div class="form-floating my-3">
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating my-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Save</button>

    </form>
</div>


<?php require_once 'footer.php'; ?>