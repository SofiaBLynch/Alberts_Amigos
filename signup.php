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
	  font-szie: 28px;
	  margin-bottom: 20px;
	}
	.btn-custom-1 {
      background-color: #006A35; /* Custom color for buttons */
      border-color: #002C88;
      width: 100%; /* Equal width for buttons in a row */
	  font-size: 16px;
    }

    .btn-custom-1:hover {
      background-color: #006A35; /* Custom color for buttons on hover */
      border-color: #002C88;
    }
	.btn-custom-2 {
      background-color: #FA440E; /* Custom color for buttons */
      border-color: #002C88;
      width: 100%;
	  font-size: 16px;
    }

    .btn-custom-2:hover {
      background-color: #FA440E; /* Custom color for buttons on hover */
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

      var emailError = document.getElementById('emailError');
      var passwordError = document.getElementById('passwordError');
      var isValid = true;

      emailError.textContent = ''; // Clear previous error message
      passwordError.textContent = ''; // Clear previous error message

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

      // You can add more password strength criteria checks here

      return isValid;
    }
  </script>
  
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 login-box">
        <h2 class="text-center mb-4">Signup for GatorLink</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            <span id="emailError" class="validation-message"></span> <!-- Validation message for email -->
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password1" name="password" placeholder="Enter password">
          </div>
          <div class="form-group">
            <label for="password">Re-enter Password</label>
            <input type="password" class="form-control" id="password2" name="password" placeholder="Enter password">
            <span id="passwordError" class="validation-message"></span> <!-- Validation message for password -->
          </div>
          <div class="button-container">
            <button type="submit" class="btn btn-custom-2">Sign Up</button>
          </div>
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
$host = 'your_database_host';
$username = 'your_username';
$password = 'your_password';
$database = 'your_database_name';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Your SQL query to insert data into the database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo 'Signup successful!';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    mysqli_close($conn); // Close database connection
}
?>