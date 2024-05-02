#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Rowdies', sans-serif;
    }

    h2 {
      color: #002C88;
      font-weight: 400;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .btn-custom-1 {
    background-color: #74aeed; 
      border-color: #002C88;
      width: 100%;
	  font-size: 16px;
    }

    .btn-custom-1:hover {
      background-color: #a3cbf5; 
      border-color: #002C88;
    }
	.btn-custom-2 {
      background-color: #74aeed; 
      border-color: #002C88;
      width: 100%;
	  font-size: 16px;
    }

    .btn-custom-2:hover {
      background-color: #a3cbf5; 
      border-color: #002C88;
    }

    .rowdies-light {
      font-family: "Rowdies", sans-serif;
      font-weight: 300;
      font-style: normal;
    }

    .rowdies-regular {
      font-family: "Rowdies", sans-serif;
      font-weight: 400;
      font-style: normal;
    }

    .rowdies-bold {
      font-family: "Rowdies", sans-serif;
      font-weight: 700;
      font-style: normal;
    }

    .button-container {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .login-box {
      margin-top: 100px;
      width: 400px;
      background-color: #d3d3d3;
      border: 2px solid #002C88;
      border-radius: 8px;
      padding: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 login-box">
        <h2 class="text-center mb-4">Login to GatorMeet</h2>
        <form method="POST">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
          </div>
          <div class="button-container">
            <button type="submit" name="login" class="btn btn-custom-1">Login</button>
            <a href="signup.php" class="btn btn-custom-2">Sign Up</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <?php
  session_start();
  // PHP code for handling form submission and database connection
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    // Your database connection code
    $servername = 'mysql.cise.ufl.edu';
    $username = 'chelseanguyen';
    $password_db = 'Caa20210408';
    $dbname = 'AlbertsAmigos';
  
    $conn = new mysqli($servername, $username, $password_db, $dbname);
  
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  
    // SQL query to get the hashed password from the database
    $sql = "SELECT isAdmin, UFID, passwordhash FROM Users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if ($result->num_rows > 0) {
      // User authenticated successfully
      $row = $result->fetch_assoc();
      $hashedPassword = $row['passwordhash'];  // get the hashed password from the database
  
      // Verify the password against the hash
      if (password_verify($password, $hashedPassword)) {
        $_SESSION['UFID'] = $row['UFID'];  
        $_SESSION['isAdmin'] = $row['isAdmin'];
        header("Location: hub_page.php");
        exit();
      } else {
        echo "<script>alert('Invalid credentials');</script>";
      }
    } else {
      echo "<script>alert('Invalid credentials');</script>";
    }
    $stmt->close();
    $conn->close();
  }
  ?>
</body>

</html>
