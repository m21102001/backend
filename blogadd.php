<?php
require_once 'header.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title =  $_POST['title'];
    $body =  $_POST['body'];
    $category =  $_POST['category'];
    
        try {
            $sql = "INSERT INTO blog(title, body, category) VALUES (:title, :body, :category)";
    
            $stmt = $conn->prepare($sql);
    
            $params = [
                'title' => $title,
                'body' => $body,
                'category' => $category
            ];
    
            $stmt->execute($params);
    
            $_SESSION['success'] = "Blog created successfully";
    
        
            echo "<script>window.location = 'blog1.php'</script>";
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
    <h1 class="h2">Add Blog</h1>
    <a href="blog1.php" class="btn btn-warning">
        < back</a>
</div>


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

        <button class="w-100 btn btn-md btn-primary" type="submit">Save</button>

    </form>
</div>