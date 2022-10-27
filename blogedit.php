<?php
require_once 'header.php';

try {
    $id = (int) $_GET['id'];

    
    $sql = "SELECT * FROM blog WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    
    $blog = $stmt->fetch();

     die;

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  
    $title =  $_POST['title'];
    $body =  $_POST['body'];
    $category =  $_POST['category'];

 
    try {
        $sql = "UPDATE blog SET title = :title, body = :body , category = :category ";

        $sql .= " WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':body', $body);
        $stmt->bindParam(':category', $category);


       

        $stmt->execute();

        $_SESSION['success'] = "Blog updated successfully";
        echo "<script>window.location = 'blog1.php'</script>";
        die;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
        .ride{
            position : relative;
            bottom : 500px;
            width:400px;
        }
        .note{
            position : relative;
            bottom : 600px;
            padding-left: 400px;

        }
        .link{
            padding-right : 40px;
        
        }
       
    </style>
</head>
<body>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom note">
    <h1 class="h2 ">Update Blog</h1>
    <div class="link">
    <a href="blog1.php" class="btn btn-warning">
        < back</a>
    </div>

    </div>
<div class="container card my-3 p-3 ride">
    <form method="POST">
        <div class="form-floating my-3">
            <input type="text" name="title" class="form-control" id="title" placeholder="title" value="<?= $blog['title'] ?>">
            <label for="title">title</label>
        </div>
        <div class="form-floating my-3">
            <input type="text" name="body" class="form-control" id="body" placeholder="Description" value="<?= $blog['body'] ?>">
            <label for="body">Description</label>
        </div>
        <div class="form-floating my-3">
            <input type="text" name="category" class="form-control" id="category" placeholder="Category" value="<?= $blog['category'] ?>">
            <label for="category">Category</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>

    </form>
</div>
</body>
</html>

<?php require_once 'footer.php'; ?>
