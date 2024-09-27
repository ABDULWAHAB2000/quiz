<?php
session_start();
include_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $company = $_POST['company'];

    // Check if the company number already exists
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE company = ?");
    $checkStmt->bind_param("s", $company);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        $error_message = "This phone number is already registered.";
    } else {
        // Prepare and execute SQL statement to insert new user
        $stmt = $conn->prepare("INSERT INTO users (name, company) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $company);
        $stmt->execute();

        // Store user ID in session
        $_SESSION['user_id'] = $conn->insert_id;
        $stmt->close();
        header("Location: select_category.php"); // Redirect to category selection
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Choice Question Game</title>
</head>
<body>
    <div class="container mt-5">
        <img src="image/logo.png" alt="UHS Enterprises Logo" class="img-fluid mb-4"> <!-- Logo image -->
        <img src="image/f.png" alt="Description of the image" class="responsive-image">

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="mt-4">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <input type="tel" name="company" class="form-control" 
                       placeholder="Enter your number" required 
                       pattern="0\d{9}" maxlength="10" 
                       title="Please enter a valid number, starting with 0 followed by 10 digits." 
                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity('');" 
                       oninvalid="this.setCustomValidity('Please enter a valid number, starting with 0 followed by 10 digits.')">
            </div>
            <button type="submit" class="btn btn-success btn-block">Login</button>
            <img src="image/a.gif" alt="Description of the GIF" class="gif">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>










102
Anoop 
0503975566

103
Uma
0504093347

104
Subin
0566813262

105
arush
0553374454

106
unni
0555528670

107
fcbgdg
0987665431

108
santhosh
0509654758

109
sindhu
0553396423

110
Deytha
0564084415

111
Deytha
0567911459

112
Gireesh
0558975525

113
Pooja 
0583068017

114
Dimju Gopal
0553651129

115
Abin
0562486334

116
devanand
0507392527

117
devanand
0559947235

118
smitha
0558107320

119
anith jayson
0505776842

120
devipriya
0555440872

121
anjana
0521557273

122
Sowmya Manoj
0551468520

123
aoma
0553484036

124
mohamed kalfan
0524961133

125
Rajeshkrishnan
0526251077

126
abdul
0936765475

127
Sameera 
0561377953

128
rithikaa
0565515447

129
Ishan 
0563717946

130
Saravanan
0562607870