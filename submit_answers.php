<?php
session_start();

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Get score from session
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$totalQuestions = isset($_SESSION['answers']) ? count($_SESSION['answers']) : 0;

// Feedback message
$message = "You scored $score out of $totalQuestions.";

// Get user ID from session
$userId = $_SESSION['user_id'];

// Clear session data after showing results
unset($_SESSION['score']);
unset($_SESSION['answers']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Submission Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Submission Result</h1>
        <div class="alert alert-info text-center" role="alert">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <div class="text-center mt-4">

            <a href="ticket.php?user_id=<?php echo urlencode($userId); ?>" class="btn btn-success">Get Ticket</a> 
<p style="color:red" class="gov">Click this button and you'll get popcorn! </p>

        </div>
        <img src="image/a.gif" alt="Description of the GIF" class="gif">
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
