<?php
session_start();
include_once 'database.php';
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    session_destroy();
}
// Get user ID from the session
$userId = htmlspecialchars($_SESSION['user_id']);

// Check if the download request was made
if (isset($_GET['action']) && $_GET['action'] === 'download') {
    // Load the logo image
    $logoPath = 'image/1.png';
    if (!file_exists($logoPath)) {
        die("Logo image not found.");
    }
    
    $logo = imagecreatefrompng($logoPath);
    if (!$logo) {
        die("Failed to load logo image.");
    }

    // Get the dimensions of the logo
    $width = imagesx($logo);
    $height = imagesy($logo);

    // Create a true color image with the same dimensions
    $image = imagecreatetruecolor($width, $height);
    imagecopy($image, $logo, 0, 0, 0, 0, $width, $height);

    // Set the text color to white
    $textColor = imagecolorallocate($image, 255, 255, 255);

    // Add the user ID text to the image
    // Add the user ID text to the image
    $text = "000$userId";
    $fontSize = 30; // Set font size
    $fontFile = 'fonts/arial.ttf'; // Path to your TTF font file

    // Check if font file exists
    if (!file_exists($fontFile)) {
        die("Font file not found.");
    }

    $angle = 0; // Angle for the text

    // Calculate text bounding box to center it
    $bbox = imagettfbbox($fontSize, $angle, $fontFile, $text);
    $textWidth = abs($bbox[2] - $bbox[0]);

// Adjust these values to shift left/right
$x = ($width - $textWidth) / 2.85; // Center the text horizontally
$y = ($height / 7.93) + ($fontSize / 2); // Position text vertically centered

    // Add the text to the image using the TTF font
    imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $fontFile, $text);


    // Set the content type header
    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="ticket.png"');

    // Output the image
    imagepng($image);
    imagedestroy($image);
    imagedestroy($logo);
    exit(); // Prevent further output
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; /* Light background for contrast */
        }

        .container {
            max-width: 600px; /* Limit max width for readability */
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .image-container {
            position: relative;
            text-align: center;
            color: white;
            margin: 0 auto;
        }

        .overlay-image {
            width: 100%; /* Adjusts to the width of the container */
            height: auto; /* Maintain aspect ratio */
        }

        .user-id {
            position: absolute;
            top: 18px; /* Position text near the top */
            left: 37%;
            transform: translateX(-50%);
            font-size: 0.8rem; /* Default font size */
            color: white; /* Set text color to white */
            padding: -10px;
            border-radius: 5px; /* Rounded corners */
        }

        /* Mobile styles */
        @media (max-width: 576px) {
            .user-id {
                font-size: 0.45rem; /* Smaller font size for mobile */
                padding: 5px; /* Less padding on smaller screens */
                top: 4px; /* Adjust position for mobile */
            }

            .container {
                padding: 0 10px; /* Add padding to the container */
            }

            h1 {
                font-size: 1.5rem; /* Adjust heading size for mobile */
            }

            .btn {
                width: 100%; /* Make buttons full-width on mobile */
                margin: 5px 0; /* Space between buttons */
            }
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            background-color: #007bff; /* Primary button color */
            border: none;
            border-radius: 5px;
            text-decoration: none; /* Remove underline from links */
        }

        .btn-secondary {
            background-color: #6c757d; /* Secondary button color */
        }

        .btn:hover {
            opacity: 0.8; /* Slightly dim button on hover */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Ticket Information</h1>
    <div class="image-container">
        <img src="image/1.png" alt="Ticket Background" class="overlay-image">
        <div class="user-id">000<?php echo htmlspecialchars($userId); ?></div>
    </div>
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">Back to Home</a>
        <a href="?action=download" class="btn btn-secondary">Download Ticket</a>
    </div>
</div>
</body>
</html>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
