<?php
require_once 'header.php';

try {
    $id = (int) $_GET['id'];

    // TODO:: prepare the query first then bind params
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error'] = "User not Found!";
        header("location: users.php");
        die;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // TODO:: Validation data first
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // TODO:: skip if validation error
    // you can do it better when using funtion or OOP
    try {
        $sql = "UPDATE users SET firstname = :firstname, email = :email";

        if (!empty($password))
            $sql .= ", password = :password";

        $sql .= " WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);

        if (!empty($password))
            $stmt->bindParam(':password', $password);

        $stmt->execute();

        $_SESSION['success'] = "Account updated successfully";

        // header("location: users.php"); # mostly will result error (Cannot modify header information - headers already sent)
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
    .hello{
        position : relative;
    bottom : 500px !important;
    width :400px;
  
    
    }
    .like{
        position : relative;
    bottom : 550px;
    }
    .beauty{
        padding-left : 300px;
    }
    .link{
            padding-right : 40px;
        
        }
        
</style>

</head>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom like">
    <h1 class="h2 beauty">Update User</h1>
    <div class="link">
    <a href="users.php" class="btn btn-warning">
        < back</a>
</div>
</div>
<div class="container card  p-3 hello">
<div class="d-flex justify-content-center ">
    <form method="POST" class="bad">
        <div class="form-floating">
            <input type="text" name="firstname" class="form-control" id="name" placeholder="Name" value="<?= $user['firstname'] ?>">
            <label for="name">Name</label>
        </div>
        <div class="form-floating my-3">
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="<?= $user['email'] ?>">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating my-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>

    </form>
</div>
</div>

<?php require_once 'footer.php'; ?>
