<?php
require('../config/config.php');
session_start();

$error = '';
$validate = '';

//mengecek apakah sesssion username tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if (isset($_SESSION['password'])) header('Location: ../index.php');

//mengecek apakah form disubmit atau tidak
if (isset($_POST['submit'])) {

    // menghilangkan backshlases
    $username = stripslashes($_POST['username']);
    //cara sederhana mengamankan dari sql injection
    $username = mysqli_real_escape_string($con, $username);
    // menghilangkan backshlases
    $password = stripslashes($_POST['password']);
    //cara sederhana mengamankan dari sql injection
    $password = mysqli_real_escape_string($con, $password);

    //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    if (!empty(trim($username)) && !empty(trim($password))) {

        //select data berdasarkan username dari database
        $query      = "SELECT * FROM users WHERE username = '$username'";
        $result     = mysqli_query($con, $query);
        $rows       = mysqli_num_rows($result);

        if ($rows != 0) {
            $hash   = mysqli_fetch_assoc($result)['password'];
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $username;
                header('Location: ../index.php');
                exit();
            } else {
                $error =  'Login failed!';
            }

            //jika gagal maka akan menampilkan pesan error
        } else {
            $error =  'Login failed!';
        }
    } else {
        $error =  'Data cannot be empty!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Study Spaces</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        :root {
            --primary: #FB9B8F;
            --primary-dark: #FDC3A1;
            --bg-light: #f4f5fb;
            --text-dark: #2d2d3a;
            --text-muted: #8a8a99;
            --danger: #e63950;
            --radius: 16px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            background: linear-gradient(135deg, #FDC3A1 20%, #FB9B8F 45%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 860px;
            background: #fff;
            border-radius: var(--radius);
            box-shadow: 0 20px 50px rgba(30, 20, 90, 0.25);
            overflow: hidden;
            display: flex;
            min-height: 500px;
        }

        /* left illustration / brand panel */
        .login-side {
            flex: 1 1 45%;
            background: linear-gradient(160deg, var(--primary), var(--primary-dark));
            color: #fff;
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-side::before,
        .login-side::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .login-side::before {
            width: 260px;
            height: 260px;
            top: -80px;
            right: -80px;
        }

        .login-side::after {
            width: 180px;
            height: 180px;
            bottom: -60px;
            left: -40px;
        }

        .login-side h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
            z-index: 1;
        }

        .login-side h2 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 18px;
            z-index: 1;
        }

        .login-side p {
            opacity: 0.9;
            font-size: 0.95rem;
            z-index: 1;
            max-width: 260px;
        }

        /* right form panel */
        .login-form-panel {
            flex: 1 1 55%;
            padding: 48px 56px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form-panel h3 {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .login-form-panel .subtitle {
            color: var(--text-muted);
            margin-bottom: 24px;
            font-size: 0.95rem;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .form-control {
            border: 1.5px solid #e4e4ee;
            border-radius: 10px;
            padding: 10px 14px;
            height: auto;
            font-size: 0.95rem;
            background: var(--bg-light);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.15);
            background: #fff;
        }

        .btn-login {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            margin-top: 6px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(108, 99, 255, 0.35);
        }

        .form-footer {
            text-align: center;
            margin-top: 18px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .form-footer a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .alert-danger {
            border-radius: 10px;
            font-size: 0.9rem;
            padding: 10px 14px;
        }

        .text-danger.small-note {
            font-size: 0.8rem;
            margin-top: 4px;
            margin-bottom: 0;
        }

        /* Responsive breakpoints */
        @media (max-width: 900px) {
            .login-wrapper {
                max-width: 440px;
                flex-direction: column;
                min-height: unset;
            }

            .login-side {
                padding: 32px 32px 24px;
                text-align: center;
                align-items: center;
            }

            .login-side p {
                max-width: 100%;
            }

            .login-form-panel {
                padding: 32px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 12px;
            }

            .login-side {
                padding: 24px 20px;
            }

            .login-side h1 {
                font-size: 1.5rem;
            }

            .login-side h2 {
                font-size: 1.1rem;
            }

            .login-form-panel {
                padding: 24px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-side">
            <h1>WELCOME TO</h1>
            <h2>STUDY SPACES</h2>
             <p>Let's Study Together! Create an account to organize your study and stay productive.</p>
        </div>

        <div class="login-form-panel">
            <h3>Login to your account</h3>
            <p class="subtitle">Enter your username and password</p>

            <?php if ($error != '') { ?>
                <div class="alert alert-danger" role="alert"><?= $error; ?></div>
            <?php } ?>

            <form action="login.php" method="POST" novalidate>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                </div>

                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Enter password" required>
                    <?php if ($validate != '') { ?>
                        <p class="text-danger small-note"><?= $validate; ?></p>
                    <?php } ?>
                </div>

                <button type="submit" name="submit" class="btn-login">Login</button>

                <div class="form-footer">
                    <p>Don't have an account? <a href="signup.php">Sign up here for free</a></p>
                </div>
            </form>
        </div>

    </div>

    <!-- Bootstrap requirement: jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>