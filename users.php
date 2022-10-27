<?php
require_once 'header.php';

if (!empty($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $sql = "DELETE FROM users WHERE id = $id";
    $stmt = $conn->prepare($sql);
    $stmt = $stmt->execute();

    $_SESSION['success'] = "User Deleted!";
    echo "<script>window.location = 'users.php'</script>";
     
    die;
}

try {
    $sql = "SELECT * FROM users";

   

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.good{
    position : absolute;
    bottom : 400px !important;

}
.bad{
    position : relative;
    bottom : 550px;
    
}

    </style>
</head>
<body>
    
</body>
</html>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom bad">
    <h1 class="h2">Users</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
        </button>
        <a href="useradd.php" class="btn btn-sm btn-outline-primary mx-2">
            <span data-feather="plus" class="align-text-bottom"></span>
            Add user
        </a>
    </div>
</div>
<div class="d-flex justify-content-center ">
<div class="table-responsive good">
    <table class="table table-striped table-lg">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">FirstName</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['firstname'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                        <a href="useredit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="?delete=<?= $user['id'] ?>" ></a>
                        

                        <button type="button" data-id="<?= $user['id'] ?>" onclick="deleteClick(this)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
            </div>
<script>
    function deleteClick(e) {
        console.log(e)
        let id = e.getAttribute('data-id');
        let answer = confirm("Are you sure to delete user " + id + "?")
        if (answer) {
            window.location = "?delete=" + id
        }

    }
</script>

<?php require_once 'footer.php'; ?>