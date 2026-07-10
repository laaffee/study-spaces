<?php
require_once '../auth/check.php';
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: comments_page.php');
    exit();
}

$value1 = isset($_POST['value1']) ? trim($_POST['value1']) : '';
$value2 = isset($_POST['value2']) ? trim($_POST['value2']) : '';
$value3 = isset($_POST['value3']) ? trim($_POST['value3']) : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Prepare and insert safely
$stmt = mysqli_prepare($con, "INSERT INTO feedback (username, value1, value2, value3) VALUES (?, ?, ?, ?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssss', $username, $value1, $value2, $value3);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Feedback Sent</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ede70cc9f6.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="feedback-success-page">

    <div class="success-card">

        <div class="success-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <h1>Thank You!</h1>

        <h5>Your feedback has been sent successfully.</h5>

        <p>
            Thank you for taking the time to share your feedback with us. Your comments and suggestions help us make <strong>Study Spaces</strong> even better.
        </p>

        <div class="emoji">
            💖 ☕ 📚
        </div>

        <a href="../index.php" class="home-btn">
            <i class="fa-solid fa-house"></i>
            Back to Home
        </a>

    </div>

</body>

</html>