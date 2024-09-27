<?php
session_start();
include_once 'database.php';

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Sample questions
$questions = [
    [
        'title' => " Which accounting software do you prefer?",
        'type' => "input", // Mark this as an input question
        'answer' => "Recording and analyzing financial transactions"
    ],
    [
        'title' => "What is accounts?",
        'choices' => ["Managing inventory","Recording and analyzing financial transactions","Tracking customer complaints","Handling employee salaries"],
        'answer' => "Recording and analyzing financial transactions"
    ],
    [
        'title' => "What is vat?",
        'choices' => ["Value added tax", "Vat added tax", "Value addition tax", "Vat authority tax"],
        'answer' => "Value added tax"
    ],
    [
        'title' => "Mention some Accounting Software?",
        'choices' => ["Photoshop, QuickBooks, Canva", "Canva, Word, Photoshop", "Tally, Excel, Word", "Tally, QuickBooks, Zoho Books"],
        'answer' => "Tally, QuickBooks, Zoho Books"
    ],
    [
        'title' => "what are the problems you face while doing accounts in a business?",
        'choices' => ["Errors in data entry and managing cash flow", "Delayed payments and outdated software","Difficulty keeping up with tax regulations","All of the above"],
        'answer' => "All of the above"
    ],
    [
        'title' => "Accounts helps in which category?",
        'choices' => ["Financial Management", "Marketing Strategies","Product Design","Customer Service"],
        'answer' => " Financial Management"
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];  // Assuming user_id is stored in session

    if ($currentQuestion === 0 && isset($_POST['answer'])) {
        // For the first question, save the input answer
        $answer = $_POST['answer'];
        $_SESSION['answers'][$currentQuestion] = $answer;

        // Save the answer to the database
        $stmt = $conn->prepare("INSERT INTO quiz_answers (user_id, question_id, answer) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $userId, $currentQuestion, $answer);
        $stmt->execute();

        // Check if the answer is correct
        if (strtolower(trim($answer)) === strtolower(trim($questions[$currentQuestion]['answer']))) {
            $_SESSION['score']++;
        }
    } elseif (isset($_POST['answer'])) {
        // For other questions with radio buttons
        $answer = $_POST['answer'];
        $_SESSION['answers'][$currentQuestion] = $answer;

        // Save the answer to the database
        $stmt = $conn->prepare("INSERT INTO quiz_answers (user_id, question_id, answer) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $userId, $currentQuestion, $answer);
        $stmt->execute();

        // Check if the answer is correct
        if ($answer === $questions[$currentQuestion]['answer']) {
            $_SESSION['score']++;
        }
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
    <title>Accounts Questions</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4"style="color:green;">Accounts Questions</h1>
    <img src="image/f.png" alt="Description of the image" class="responsive-image">
    <form action="" method="POST">
        <input type="hidden" name="currentQuestion" value="<?php echo $currentQuestion; ?>">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($currentQuestionData['title']); ?></h5>
                        <!-- Check if this is the first question (input field) -->
                        <?php if ($currentQuestion === 0 && $currentQuestionData['type'] === "input"): ?>
                            <!-- For the first question, use an input box -->
                            <div>
                                <input class="form-control" type="text" name="answer" required>
                            </div>
                        <?php else: ?>
                            <!-- For all other questions, use radio buttons -->
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
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-block mt-3">Submit Answer</button>
    </form>
    <a href="select_category.php" class="btn btn-secondary btn-block mt-3">Back to Categories</a>
    <img src="image/a.gif" alt="Description of the GIF" class="gif">
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>