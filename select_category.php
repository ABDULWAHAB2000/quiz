<?php
session_start();
include_once 'database.php';
if (!isset($_SESSION['user_id'])) {
    session_destroy();
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    
    switch ($category) {
        case 'crm':
            header("Location: crm.php");
            exit();
        case 'tally':
            header("Location: tally.php");
            exit();
        case 'accounts':
            header("Location: accounts.php");
            exit();
        default:
            // Optional: handle unexpected category
            break;
    }
}
?>
<style>
  .btn {
    transition: background-color 0.3s, color 0.3s;
  }

  .btn:hover {
    background-color: #0056b3; /* Change to your desired hover color */
    color: #fff; /* Change text color on hover */
  }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Select Category</title>
</head>
<body>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Select Category</title>
</head>
<body>
    
    <div class="container mt-5">
        <h1 class="text-center"style="color:green;">Category</h1>
        <img src="image/f.png" alt="Description of the image" class="responsive-image">
               <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <form method="GET">
                        <style>
.btn-secondary {
    transition: background-color 0.3s, transform 0.3s;
}

.btn-success:hover {
    background-color: #e05c2d; /* Change to your desired hover color */
    transform: scale(1.05); /* Slightly enlarge the button on hover */
}
</style>

<button type="submit" name="category" value="crm" class="btn btn-success btn-block mb-2">CRM</button>
<button type="submit" name="category" value="tally" class="btn btn-success btn-block mb-2">Tally</button>
<button type="submit" name="category" value="accounts" class="btn btn-success btn-block mb-2">Accounts</button>
<img src="image/a.gif" alt="Description of the GIF" class="gif">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


