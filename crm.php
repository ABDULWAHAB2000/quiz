<?php
session_start();
include_once 'database.php';
// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    session_destroy();
}

// Sample questions
$questions = [
    [
        'title' => "Which flower is commonly used to create the traditional Onam pookalam (flower carpet)?",
        'choices' => ["Rose","Lily","Marigold","Sunflower"],
        'answer' => "Marigold"
    ],
    [
        'title' => "What does CRM stand for?",
        'choices' => ["Customer Reporting Method", "Company Resource Management", "Client Review Method", "Customer Relationship Management"],
        'answer' => "Customer Relationship Management"
    ],
    [
        'title' => "What is a CRM system used for?",
        'choices' => ["Managing customer information", "Cooking meals", "Organizing events", "Scheduling meetings"],
        'answer' => "Managing customer information"
    ],
    [
        'title' => "Which of the following is a simple benefit of using a CRM?",
        'choices' => ["It helps businesses keep track of customer details", "it helps with decorating offices","It manages office supplies","It schedules employee breaks"],
        'answer' => "It helps businesses keep track of customer details"
    ],
    [
        'title' => "Where might you find information like a customer's phone number or purchase history in a CRM?",
        'choices' => ["In a company's financial report", "In a customer profile","In an employee handbook","In a product catalog"],
        'answer' => "In a customer profile"
    ],
    [
        'title' => "Who typically uses a CRM system in a company?",
        'choices' => ["Cleaning staff","Security guards","Delivery drivers","Salespeople and customer service staff" ],
        'answer' => "Salespeople and customer service staff"
    ],
    [
        'title' => "Who is the legendary king celebrated during Onam?",
        'choices' => ["King Ashoka","SKing Vikramaditya","King Mahabali","King Solomon" ],
        'answer' => "King Mahabali"
    ],  
];

// Initialize score and questions
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
    $_SESSION['answers'] = [];
}

$totalQuestions = count($questions);
$currentQuestion = isset($_POST['currentQuestion']) ? (int)$_POST['currentQuestion'] : 0;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    // Save the answer
    $_SESSION['answers'][$currentQuestion] = $_POST['answer'];

    // Check if the answer is correct
    if ($_POST['answer'] === $questions[$currentQuestion]['answer']) {
        $_SESSION['score']++;
    }

    $currentQuestion++;
}

// Check if all questions have been answered
if ($currentQuestion >= $totalQuestions) {
    // Redirect to results page
    header("Location: submit_answers.php");
    exit();
}

// Get the current question data
$currentQuestionData = $questions[$currentQuestion];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>CRM Questions</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4"style="color:green;">CRM Questions</h1>
        
    <img src="image/f.png" alt="Description of the image" class="responsive-image">
    <form action="" method="POST">
        <input type="hidden" name="currentQuestion" value="<?php echo $currentQuestion; ?>">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($currentQuestionData['title']); ?></h5>
                        <div>
                            <?php foreach ($currentQuestionData['choices'] as $choice): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer" value="<?php echo htmlspecialchars($choice); ?>" id="choice_<?php echo md5($choice); ?>">
                                    <label class="form-check-label" for="choice_<?php echo md5($choice); ?>">
                                        <?php echo htmlspecialchars($choice); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-3">Submit Answer</button>
        
    </form>
    <a href="select_category.php" class="btn btn-secondary btn-block mt-3">Back to Categories</a>
    <img src="image/a.gif" alt="Description of the GIF" class="gif">
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
