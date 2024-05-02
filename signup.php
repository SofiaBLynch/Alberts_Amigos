#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
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
      margin-top: 20px; /* Add margin for spacing */
    }
  .login-box {
      margin-top: 100px;
    width: 400px;
      background-color: #d3d3d3; /* White background color */
      border: 2px solid #002C88; /* Blue border */
      border-radius: 8px; 
      padding: 10px; /* Add padding inside the box */
    }
  .validation-message {
      color: red;
      font-size: 14px;
      margin-top: 5px;
    }
  </style>
  <script>
    function validateForm() {
      var email = document.getElementById('email').value;
      var password1 = document.getElementById('password1').value;
      var password2 = document.getElementById('password2').value;
      var nameData = document.getElementById('name').value;
      var UFID = document.getElementById('ufid').value;
    
      var emailError = document.getElementById('emailError');
      var passwordError = document.getElementById('passwordError');
      var nameError = document.getElementById('nameError');
    var ufidError = document.getElementById('ufidError');
    
      var isValid = true;

      emailError.textContent = ''; // Clear previous error message
      passwordError.textContent = ''; // Clear previous error message
    nameError.textContent = '';
    ufidError.textContent = '';
    
      // Email validation using regular expression
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        emailError.textContent = 'Please enter a valid email address.';
        isValid = false;
      }

      // Password matching validation
      if (password1 !== password2) {
        passwordError.textContent = 'Passwords do not match.';
        isValid = false;
      }

      // Password strength validation (you can add your own criteria)
      if (password1.length < 8) {
        passwordError.textContent = 'Password must be at least 8 characters long.';
        isValid = false;
      }
    
    if (nameData.length < 1) {
      nameError.textContent = "Please enter a name";
      isValid = false;
    }
    
    if (UFID.length != 8) {
      ufidError.textContent = "Please enter your valid UFID";
      isValid = false;
    }

      // You can add more password strength criteria checks here

      return isValid;
    }
  </script>
  
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 login-box">
        <h2 class="text-center mb-4">Signup for GatorMeet</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name">
            <span id="nameError" class="validation-message"></span>
          </div>
      <div class="form-group">
            <label for="name">UFID</label>
            <input type="text" class="form-control" id="ufid" name="ufid" placeholder="Enter UFID">
            <span id="ufidError" class="validation-message"></span>
          </div>
      <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            <span id="emailError" class="validation-message"></span> <!-- Validation message for email -->
          </div>
          <div class="form-group">
            <label for="password1">Password</label>
            <input type="password" class="form-control" id="password1" name="password" placeholder="Enter password">
          </div>
          <div class="form-group">
            <label for="password2">Re-enter Password</label>
            <input type="password" class="form-control" id="password2" name="password" placeholder="Enter password">
            <span id="passwordError" class="validation-message"></span> <!-- Validation message for password -->
          </div>
          <div class="button-container">
            <button type="submit" class="btn btn-custom-2">Sign Up</button>
          </div>
          <a href="./login.php">Already have an account? Login </a>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Database connection setup (use your actual database credentials)
$host = 'mysql.cise.ufl.edu';
$username = 'chelseanguyen';
$password = 'Caa20210408';
$database = 'AlbertsAmigos';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Collect and sanitize user inputs
  $UFID = mysqli_real_escape_string($conn, $_POST['ufid']);
  $fullname = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $isAdmin = 0;

  // Hash the password before storing it
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Prepare the SQL statement to avoid SQL Injection
  $stmt = $conn->prepare("INSERT INTO Users (UFID, fullname, email, passwordhash, isAdmin) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssi", $UFID, $fullname, $email, $hashedPassword, $isAdmin);

  // Execute the query and check for success
  if ($stmt->execute()){
      echo '<script>alert("Signup successful!"); window.location.href = "login.php";</script>';
  } else {
      echo 'Error: ' . $stmt->error;
  }

  // Close statement and connection
  $stmt->close();
  mysqli_close($conn); 
}
?>
