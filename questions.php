<?php
session_start();
$conn = new mysqli("localhost", "root", "", "choice_game");

if (!isset($_SESSION['user_id'])) {
    session_destroy();
}

$category = $_GET['category'];
$stmt = $conn->prepare("SELECT * FROM questions WHERE category = ? LIMIT 5");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for answers
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Questions</title>
</head>
<body>
    <h1><?php echo ucfirst($category); ?> Questions</h1>
    <form method="POST">
        <?php foreach ($questions as $question): ?>
            <div>
                <p><?php echo $question['question']; ?></p>
                <input type="radio" name="answer[<?php echo $question['id']; ?>]" value="1"> <?php echo $question['option1']; ?><br>
                <input type="radio" name="answer[<?php echo $question['id']; ?>]" value="2"> <?php echo $question['option2']; ?><br>
                <input type="radio" name="answer[<?php echo $question['id']; ?>]" value="3"> <?php echo $question['option3']; ?><br>
            </div>
        <?php endforeach; ?>
        <button type="submit">Submit Answers</button>
    </form>
</body>
</html>
