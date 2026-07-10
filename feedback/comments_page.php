<?php
require_once '../auth/check.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daily Feedback</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ede70cc9f6.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="feedback-page">

    <div class="feedback-container">

        <!-- Back Button -->
        <a href="../index.php" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <!-- Card -->
        <div class="feedback-card">

            <div class="feedback-header">

                <div class="feedback-icon">
                    <i class="fa-solid fa-comments"></i>
                </div>

                <h2>Daily Feedback</h2>

                <p>
                    Thank you for using <strong>Study Spaces</strong>. Your feedback, suggestions, and comments are greatly appreciated and help us continuously improve the quality of our website.
                </p>

            </div>

            <form action="success_page.php" method="POST">

                <div class="mb-4">

                    <label class="form-label">
                        <i class="fa-solid fa-heart text-danger"></i>
                        What do you like about Study Spaces?
                    </label>

                    <textarea
                        class="form-control"
                        rows="3"
                        name="value1"
                        placeholder="Type your answer here..."
                        required></textarea>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        <i class="fa-solid fa-lightbulb text-primary"></i>
                        What should we improve?
                    </label>

                    <textarea
                        class="form-control"
                        rows="4"
                        name="value3"
                        placeholder="Type your answer here..."
                        required></textarea>

                </div>

                <button class="submit-btn" type="submit">
                    <i class="fa-solid fa-paper-plane"></i>
                    Send Feedback
                </button>

            </form>

        </div>

    </div>

</body>

</html>