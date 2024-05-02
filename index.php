#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to GatorMeet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;  
            justify-content: flex-end;
            align-items: center; 
            height: 100vh;      
            margin: 0;                
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('welcomepagelogo.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            text-shadow: 0px 4px 6px rgba(0,0,0,0.1);
        }
        .container {
            max-width: 500px;
            width: 100%;              
            background-color: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            margin-right: 75px;       /* Adds some spacing from the right edge */
        }
        h1 {
            margin-bottom: 30px;
            font-size: 2.5rem;
        }
        .description {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .btn-custom {
            padding: 10px 30px;
            font-size: 1rem;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>Welcome to GatorMeet</h1>
        <p class="description">
            GatorMeet is a one-stop shop for student organizations at the University of Florida to track and hold attendance for their organizations.
        </p>
        <div>
            <a href="signup.php" class="btn btn-primary btn-custom">Sign Up</a>
            <a href="login.php" class="btn btn-light btn-custom">Login</a>
        </div>
    </div>
</body>
</html>
