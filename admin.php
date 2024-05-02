#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Admin</title>
    <script>
       
        function checkAddOrg()
        {
            var ready = true;
            document.getElementById("addOrgSubmitError").innerHTML = "";
            document.getElementById("addOrganizationNameError").innerHTML = "";
            document.getElementById("addOrganizationAbbreviationError").innerHTML = "";
            document.getElementById("addOrganizationEmailError").innerHTML = "";
            var orgName = document.getElementById("addOrganizationName").value;
            if(orgName === "")
            {
                document.getElementById("addOrganizationNameError").innerHTML = "*Required: Add organization name";
                ready = false; ;
            }

            var orgAbbrev = document.getElementById("addOrganizationAbbreviation").value;
            if(orgAbbrev === "NULL")
            {
                document.getElementById("addOrganizationAbbreviationError").innerHTML = "*Error: Organziation abbreviation can not be NULL";
                ready = false;
            } 

            var orgPres = document.getElementById("addOrganizationEmail").value;
            var email = checkEmail(orgPres);
            if(!email)
            {
                document.getElementById("addOrganizationEmailError").innerHTML = "*Required: Add organization president UFL email";
                ready = false;
            }

        
            if(ready)
            {
                return true; 
            } else {
                return false;
            }
        }
        function checkEmail(email)
        {
            if(email === "" || email.length <= 8 || email.substring(email.length-8)!= "@ufl.edu")
            {
                return false;
            }
            return true;
        }
        function checkAddPres()
        {

            document.getElementById("addPresidentEmailError").innerHTML = "";
            document.getElementById("addPresidentOrganizationError").innerHTML = "";
            var ready = true;
            var org =document.getElementById("addPresidentOrganization").value;
            if(org === "select")
            {
                document.getElementById("addPresidentOrganizationError").innerHTML = "*Required: Select an organization";
                ready = false;
            }
            
            var email =document.getElementById("addPresidentEmail").value;
            if(!checkEmail(email))
            {
                document.getElementById("addPresidentEmailError").innerHTML = "*Required: Input valid UFL email";
                ready = false; 
            }
            
            if(ready)
            {
                return true;
            } else {
                return false;
            }
        }
        function checkRemovePres()
        {
            document.getElementById("removePresidentOrganizationError").innerHTML = "";
            document.getElementById("removePresidentEmailError").innerHTML = "";
            var ready = true; 

            var org =document.getElementById("removePresidentOrganization").value;
            if(org === "select")
            {
                document.getElementById("removePresidentOrganizationError").innerHTML = "*Required: Select an organization";
                ready = false;
            }
            
            var email =document.getElementById("removePresidentEmail").value;
            if(!checkEmail(email))
            {
                document.getElementById("removePresidentEmailError").innerHTML = "*Required: Input valid UFL email";
                ready = false; 
            }
            
            
            if(ready)
            {
                return true;
            } else {
                return false;
            }
        }
        function checkChangePres()
        {
            document.getElementById("changePresidentOrganizationError").innerHTML = "";
            document.getElementById("changePresidentEmailErrorOld").innerHTML = "";
            document.getElementById("changePresidentEmailErrorNew").innerHTML = "";
            var ready = true; 

            var org =document.getElementById("changePresidentOrganization").value;
            if(org === "select")
            {
                document.getElementById("changePresidentOrganizationError").innerHTML = "*Required: Select an organization";
                ready = false;
            }
            var oldEmail = document.getElementById("changePresidentOldEmail").value;
            if(oldEmail === "")
            {
                document.getElementById("changePresidentEmailErrorOld").innerHTML = "*Required: Input current president email";
                ready = false; 
            }
            
            
            var email =document.getElementById("changePresidentNewEmail").value;
            if(!checkEmail(email))
            {
                document.getElementById("changePresidentEmailErrorNew").innerHTML = "*Required: Input valid UFL email for the new president";
                ready = false; 
            }
            
            if(ready)
            {
                return true;
            } else {
                return false;
            }
        }
        function removeOrganization()
        {
            document.getElementById("removeOrganizationError").innerHTML = "";
            document.getElementById("removeOrganizationConfirmError").innerHTML = "";
            var ready = true;
            var org = document.getElementById("removeOrganizationSelect").value;
            var orgConfirm = document.getElementById("removeOrganizationConfirmSelect").value;
            if(org === "select")
            {
                document.getElementById("removeOrganizationError").innerHTML = "*Required: Select Organization to Remove";
                ready = false; 
            }
            if(orgConfirm === "select")
            {
                document.getElementById("removeOrganizationConfirmError").innerHTML = "*Required: Confirm Organization to Remove";
                ready = false; 
            } else if(orgConfirm != org) {
                document.getElementById("removeOrganizationConfirmError").innerHTML = "*Required: Confirm Organization to Must Match Selection Made Above";
                ready = false; 
            }
            
            if(ready)
            {
                return true;
            } else {
                return false;
            }
        }
        function modifyAdmin()
        {
            document.getElementById("modifyAdminEmailError").innerHTML = "";
            document.getElementById("modifyAdminDropdownError").innerHTML = "";
            var ready = true;
            var email =document.getElementById("modifyAdminEmailDropdown").value;
            if(email=== "select")
            {
                document.getElementById("modifyAdminEmailError").innerHTML = "*Required: Select an email";
                ready = false; 
            }
            var access = document.getElementById("modifyAdminDropdown").value;
            if(access === "select")
            {
                document.getElementById("modifyAdminDropdownError").innerHTML = "*Required: Input Yes or No for administrators access";
                ready = false;
            }
            if(ready)
            {
                return true;
            } else {
                return false;
            }
        }
        function redirectToAllOrgs()
        {
            window.location.href = "allOrgs.php";
        }
    </script>

<link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS and dependencies -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="topBar">
        <h1>GatorMeet</h1>
        <div class="navbar">
            <a href="./hub_page.php">My Clubs</a>
            <a href="./admin.php">Admin</a>
            <a href="./search_page.php">Join New Club</a>
            <a href="#">Engagement</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <?php
        $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
        // Check connection
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        } 

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUFID'])) {
    $UFIDToDelete = mysqli_real_escape_string($mysqli, $_POST['deleteUFID']);
    $stmt = $mysqli->prepare("DELETE FROM Users WHERE UFID = ?");
$stmt->bind_param("s", $UFIDToDelete);
if ($stmt->execute()) {
    echo "<p>Record Deleted Successfully!</p>";
} else {
    echo "<p>Error: " . $stmt->error . "</p>";
}
$stmt->close();
}

if (isset($_GET['action']) && $_GET['action'] == 'filter') {
    $nameFilter = $_GET['name'] ?? '';
    $sql = "SELECT UFID, fullname, email, isAdmin FROM Users WHERE fullname LIKE ?";
    $stmt = $mysqli->prepare($sql);
    $searchTerm = "%" . $nameFilter . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($users);
    exit();  
}

// Handle form submission for new user registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $UFID = mysqli_real_escape_string($mysqli, $_POST['ufid']);
    $fullname = mysqli_real_escape_string($mysqli, $_POST['name']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;
    $stmt = $mysqli->prepare("INSERT INTO Users (UFID, fullname, email, passwordhash, isAdmin) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $UFID, $fullname, $email, $password, $isAdmin);
if ($stmt->execute()) {
    echo 'Signup successful!';
} else {
    echo 'Error: ' . $stmt->error;
}
$stmt->close();
}

// Handle user update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateUFID'])) {
    $UFID = mysqli_real_escape_string($mysqli, $_POST['updateUFID']);
    $name = mysqli_real_escape_string($mysqli, $_POST['updateName']);
    $email = mysqli_real_escape_string($mysqli, $_POST['updateEmail']);
    $isAdmin = mysqli_real_escape_string($mysqli, $_POST['updateIsAdmin']);
    $stmt = $mysqli->prepare("UPDATE Users SET fullname = ?, email = ?, isAdmin = ? WHERE UFID = ?");
$stmt->bind_param("ssis", $name, $email, $isAdmin, $UFID);
if ($stmt->execute()) {
    echo "<p>User Updated Successfully!</p>";
} else {
    echo "<p>Error updating record: " . $stmt->error . "</p>";
}
$stmt->close();
}

        if(array_key_exists("addOrganizationSubmit", $_POST))
        {
            $orgName = $_POST["addOrganizationName"];
            $orgAbbr = $_POST["addOrganizationAbbreviation"];
            if($orgAbbr == "")
            {
                $orgAbbr = "NULL";
            }
            $orgEmail = $_POST["addOrganizationEmail"];
            $cmd = "SELECT * FROM Clubs WHERE name = '$orgName'";
            $result = $mysqli->query($cmd);
            if($result->num_rows === 0)
            {
                $cmd = "INSERT INTO Clubs(name, abbrv, email) VALUES('$orgName', '$orgAbbr', '$orgEmail');";
                $mysqli->query($cmd);
            }
        }
        if(array_key_exists("addPresidentSubmit", $_POST))
        {
            $orgName = $_POST["addPresidentOrganization"];
            $orgEmail = $_POST["addPresidentEmail"];
            $cmd = "UPDATE Clubs SET email='$orgEmail' WHERE name='$orgName'";
            $mysqli->query($cmd);
        }
        if(array_key_exists("changePresidentSubmit", $_POST))
        {
            $orgName = $_POST["changePresidentOrganization"];
            $orgEmail = $_POST["changePresidentNewEmail"];
            $cmd = "UPDATE Clubs SET email='$orgEmail' WHERE name='$orgName'";
            $mysqli->query($cmd);
        }
        if(array_key_exists("removeOrganizationSubmit", $_POST))
        {
            $orgName = $_POST["removeOrganizationSelect"];
            $cmd = "DELETE from UserClubs WHERE ClubId=$orgName";
            $mysqli->query($cmd);
            $cmd = "DELETE from Clubs WHERE ClubId=$orgName";
            $mysqli->query($cmd);
        }
        if(array_key_exists("modifyAdminAccessSubmit", $_POST))
        {
            $email = $_POST["modifyAdminEmailDropdown"];
            $access = $_POST["modifyAdminDropdown"];
            if($access == "yes")
            {
                $cmd = "UPDATE Users SET isAdmin=1 WHERE UFID='$email'";
            } else {
                $cmd = "UPDATE Users SET isAdmin=0 WHERE UFID='$email'";
            }
            $mysqli->query($cmd);
        }
    ?>
    
    <h1 style="color:black"> Admin </h1>
    <div class="adminForms">
        <div class = "form" id="addOrganizationForm">
            <h3> Add Organization </h3>
            <p class="errorMsg" id="addOrgSubmitError"></p>
            <form class="adminInputForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return checkAddOrg();">
                <p class="errorMsg" id="addOrganizationNameError"></p>
                <label for="addOrganizationName">Name of Organization:</label>
                <input type="text" id="addOrganizationName" name="addOrganizationName" placeholder="Women in Computer Science and Engineering"><br>
                <p class="errorMsg" id="addOrganizationAbbreviationError"></p>
                <label for="addOrganizationAbbreviation">Abbreviation of Organization: (optional)</label>
                <input type="text" id="addOrganizationAbbreviation"  name="addOrganizationAbbreviation" placeholder="WiCSE"><br>
                <p class="errorMsg" id="addOrganizationEmailError"></p>
                <label for="addOrganizationEmail">President's Email</label>
                <input type="text" id="addOrganizationEmail" name="addOrganizationEmail" placeholder="albert@ufl.edu"><br>
                <input type="submit" class="submitAdmin" id="addOrganizationSubmit" name = "addOrganizationSubmit" value="Submit">
            </form>
        </div>

        <div class = "form" id="addPresidentForm">
            <h3> Add President </h3>
            <form class="adminInputForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return checkAddPres();">
                <p class="errorMsg" id="addPresidentOrganizationError"></p>
                <label for="addPresidentOrganization">Name of Organization:</label>
                <select id="addPresidentOrganization" name="addPresidentOrganization">
                    <option value="select">Select</option>
                    <?php
                        $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
                        // Check connection
                        if ($mysqli -> connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                            exit();
                        } 
                
                        $result = $mysqli->query("SELECT * from Clubs");
                        if($result->num_rows > 0)
                        {
                            $options = "";
                            
                            while($row = $result->fetch_assoc())
                            {
                                $name = $row['name'];
                                $options .= "<option value='$name'>$name</option>";
                            }
                            echo($options);
                        } 
                    ?>
                </select><br>
                <p class="errorMsg" id="addPresidentEmailError"></p>
                <label for="addPresidentEmail">President's Email</label>
                <input type="text" id="addPresidentEmail" name="addPresidentEmail" placeholder="albert@ufl.edu"><br>
                <input type="submit" class="submitAdmin" id="addPresidentSubmit" name="addPresidentSubmit" value="Submit">
            </form>
                    
        </div>

        <div class="form" id="removePresidentForm">
            <h3> Remove President </h3>
            <form class="adminInputForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return checkRemovePres();">                
                <p class="errorMsg" id="removePresidentOrganizationError">
                <?php
                    $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
                    // Check connection
                    if ($mysqli -> connect_errno) {
                        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                        exit();
                    } 
                    
                    if(array_key_exists("removePresidentSubmit", $_POST))
                    {
                        $orgName = $_POST["removePresidentOrganization"];
                        $rmvEmail = $_POST["removePresidentEmail"];
                        $cmd = "SELECT * FROM Clubs WHERE name = '$orgName'";
                        $result = $mysqli->query($cmd);
                        if($result->num_rows !== 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                $email = $row['email'];
                                if($email === 'NULL'){
                                    echo("*Error: Email cannot be NULL");
                                }else if($email !== $rmvEmail){
                                    echo("*Error: $orgEmail is not the current presidents email");
                                } else {
                                    $cmd = "UPDATE Clubs SET email='NULL' WHERE name='$orgName'";
                                    $mysqli->query($cmd);
                                }
                            }
                        }
                        
                    }
                    
                ?>
                </p>
                <label for="removePresidentOrganization">Name of Organization:</label>
                <select id="removePresidentOrganization" name="removePresidentOrganization">
                    <option value="select">Select</option>
                    <?php
                        $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
                        // Check connection
                        if ($mysqli -> connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                            exit();
                        } 
                
                        $result = $mysqli->query("SELECT * from Clubs");
                        if($result->num_rows > 0)
                        {
                            $options = "";
                            
                            while($row = $result->fetch_assoc())
                            {
                                $name = $row['name'];
                                $options .= "<option value='$name'>$name</option>";
                            }
                            echo($options);
                        } 
                    ?>
                </select><br>    
                <p class="errorMsg" id="removePresidentEmailError"></p>            
                <label for="removePresidentEmail">President's Email</label>
                <input type="text" id="removePresidentEmail" name="removePresidentEmail" placeholder="albert@ufl.edu"><br>
                <input type="submit" class="submitAdmin" id="removePresidentSubmit" name="removePresidentSubmit" value="Submit">
            </form>
        </div> 
    
        <div class = "form" id="changePresidentForm">
            <h3> Change President </h3>
            <form class="adminInputForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return checkChangePres();">
                <p class="errorMsg" id="changePresidentOrganizationError"></p>            
                <label for="changePresidentOrganization">Name of Organization:</label>
                <select id="changePresidentOrganization" name="changePresidentOrganization">
                    <option value="select">Select</option>
                    <?php
                        $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
                        // Check connection
                        if ($mysqli -> connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                            exit();
                        } 
                
                        $result = $mysqli->query("SELECT * from Clubs");
                        
                        if($result->num_rows > 0)
                        {
                            $options = "";
                            
                            while($row = $result->fetch_assoc())
                            {
                                $name = $row['name'];
                                $options .= "<option value='$name'>$name</option>";
                            }
                            echo($options);
                        } 
                    ?>
                </select><br>
                <p class="errorMsg" id="changePresidentEmailErrorOld"></p>            
                <label for="changePresidentOldEmail">Old President's Email</label>
                <input type="text" id="changePresidentOldEmail" name="changePresidentOldEmail" placeholder="albert@ufl.edu"><br>
                <p class="errorMsg" id="changePresidentEmailErrorNew"></p>            
                <label for="changePresidentNewEmail">New President's Email</label>
                <input type="text" id="changePresidentNewEmail" name="changePresidentNewEmail" placeholder="newAlbert@ufl.edu"><br>
                <input type="submit" class="submitAdmin" id="changePresidentSubmit" name="changePresidentSubmit" value="Submit">
            </form>
        </div> 

        <div class = "form" id="deleteOrganizationForm">
            <h3> Remove Organization </h3>
            <form class="adminInputForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return removeOrganization();">
                <p class="errorMsg" id="removeOrganizationError"></p>            
                <label for="removeOrganizationSelect">Name of Organization Being Removed:</label>
                <select id="removeOrganizationSelect" name="removeOrganizationSelect">
                    <option value="select">Select</option>
                    <?php
                        $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
                        // Check connection
                        if ($mysqli -> connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                            exit();
                        } 
                
                        $result = $mysqli->query("SELECT * from Clubs");
                        
                        if($result->num_rows > 0)
                        {
                            $options = "";
                            
                            while($row = $result->fetch_assoc())
                            {
                                $name = $row['name'];
                                $id = $row['ClubID'];
                                $options .= "<option value='$id'>$name</option>";
                            }
                            echo($options);
                        } 
                    ?>
                </select><br>
                <p class="errorMsg" id="removeOrganizationConfirmError"></p>            
                <label for="removeOrganizationConfirmSelect">Confirm Organization Being Removed:</label>
                <select id="removeOrganizationConfirmSelect" name="removeOrganizationConfirmSelect">
                    <option value="select">Select</option>
                    <?php
                        $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
                        // Check connection
                        if ($mysqli -> connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                            exit();
                        } 
                
                        $result = $mysqli->query("SELECT * from Clubs");
                        
                        if($result->num_rows > 0)
                        {
                            $options = "";
                            
                            while($row = $result->fetch_assoc())
                            {
                                $name = $row['name'];
                                $id = $row['ClubID'];
                                $options .= "<option value='$id'>$name</option>";
                            }
                            echo($options);
                        } 
                    ?>
                </select><br>
                <input type="submit" class="submitAdmin" id="removeOrganizationSubmit" name="removeOrganizationSubmit" value="Submit">
            </form>
        </div> 

        <div class = "form" id="modifyAdministrationForm">
            <h3> Modify Administration Access </h3>
            <form class="adminInputForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return modifyAdmin();">
                <p class="errorMsg" id="modifyAdminEmailError"></p>
                <label for="modifyAdminEmailDropdown">Account Email:</label>
                <select id="modifyAdminEmailDropdown" name="modifyAdminEmailDropdown">
                    <option value="select">Select</option>
                    <?php
                        $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
                        // Check connection
                        if ($mysqli -> connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                            exit();
                        } 
                
                        $result = $mysqli->query("SELECT * from Users");
                        
                        if($result->num_rows > 0)
                        {
                            $options = "";
                            
                            while($row = $result->fetch_assoc())
                            {
                                $email = $row['email'];
                                $id = $row['UFID'];
                                $options .= "<option value='$id'>$email</option>";
                            }
                            echo($options);
                        } 
                    ?>
                </select><br>
                <p class="errorMsg" id="modifyAdminDropdownError"></p>
                <label for="modifyAdminDropdown">Grant Administrative Access:</label>
                <select id="modifyAdminDropdown" name="modifyAdminDropdown">
                    <option value="select">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <input type="submit" class="submitAdmin" id="modifyAdminAccessSubmit" name="modifyAdminAccessSubmit" value="Submit">
            </form>
        </div> 
    </div>


    

    <br>
    <div class="orgData" style="overflow-x:auto;">
        <h3>On-Campus Involvement</h3>
        <table>
            <tr class="head">
                <th>Organization</th>
                <th>President Email</th>
                <th># of Members</th>
                <th># of Events</th>
                <th># of Events Attended/Member</th>
            </tr>
            <?php
                $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
                // Check connection
                if ($mysqli -> connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                    exit();
                } 
        
                $result = $mysqli->query("SELECT * from Clubs");
                $i = 0;
                if($result->num_rows > 0)
                {
                    
                    while($club = $result->fetch_assoc())
                    {
                        if($i > 5)
                        {
                            break;
                        }
                        if($i%2 == 1)
                        {
                            $row = "<tr class= 'orgDataRow odd'>";
                        } else {
                            $row = "<tr class= 'orgDataRow'>";
                        }
                        $name = $club['name'];
                        $email = $club['email'];
                        $id = $club['ClubID'];
                        $members = $mysqli->query("SELECT * from UserClubs WHERE ClubID = $id");
                        $numMem = mysqli_num_rows($members);    
                        $attendance = $mysqli->query("SELECT * FROM EventAttendees WHERE ClubID= $id");
                        $numAtt = mysqli_num_rows($attendance);    
                        if($numMem == 0)
                        {
                            $avg = 0;
                        } else {
                            $avg = $numAtt/$numMem;
                        }
                        $row .= "<td>$name</td>";
                        $row .= "<td>$email</td>";
                        $row .= "<td>$numMem</td>";
                        $row .= "<td>$numAtt</td>";
                        $row .= "<td>$avg</td>";
                        $row .= "</tr>";
                        echo($row);
                        $i += 1; 

                    }
                    
                } 
            ?>
        </table>
        <br>
        
        <div id="orgDataButton">
            <button id="AdminViewAll" onclick="redirectToAllOrgs()">View All</button>
        </div>
    </div>
        </form>
      </div>
    </div>
  </div>
<div class="row justify-content-center">
      <div class="col-md-6">
        <table>
          <thead>
            <tr>
              <th>UFID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Admin</th>
			  <th>Delete</th>
			  <th>Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Assuming connection is already established above
            $query = "SELECT UFID, fullname, email, isAdmin FROM Users";
            $result = mysqli_query($mysqli, $query);
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['UFID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . ($row['isAdmin'] ? 'Yes' : 'No') . "</td>";
                echo "<td>
                        <form method='POST'>
                          <input type='hidden' name='deleteUFID' value='" . $row['UFID'] . "'>
                          <button type='submit' class='btn btn-danger'>Delete</button>
                        </form>
                      </td>";
				echo "<td><button type='button' class='btn btn-info edit-btn' data-ufid='" . $row['UFID'] . "' data-name='" . $row['fullname'] . "' data-email='" . $row['email'] . "' data-isadmin='" . $row['isAdmin'] . "'>Edit</button></td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='4'>No users found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

   <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="updateForm" method="POST">
    <input type="hidden" name="updateUFID" id="updateUFID">
    <div class="form-group">
        <label for="updateName">Name</label>
        <input type="text" class="form-control" id="updateName" name="updateName">
    </div>
    <div class="form-group">
        <label for="updateEmail">Email</label>
        <input type="email" class="form-control" id="updateEmail" name="updateEmail">
    </div>
    <div class="form-group">
        <label for="updateIsAdmin">Admin</label>
        <select class="form-control" id="updateIsAdmin" name="updateIsAdmin">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
        </div>
      </div>
    </div>
  </div>
    <br><br>
<script>
 function filterUsers() {
    var inputText = document.getElementById('filterName').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            updateTable(JSON.parse(this.responseText));  
        }
    };
    xhttp.open("GET", "<?php echo $_SERVER['PHP_SELF']; ?>?action=filter&name=" + encodeURIComponent(inputText), true);
    xhttp.send();
}
function updateTable(users) {
    var table = document.querySelector('table tbody');
    table.innerHTML = '';  // Clear the table first

    users.forEach(function(user) {
        var row = table.insertRow(-1);  // Insert a new row at the end of the table
        row.innerHTML = `<td>${user.UFID}</td>
                         <td>${user.fullname}</td>
                         <td>${user.email}</td>
                         <td>${user.isAdmin ? 'Yes' : 'No'}</td>
                         <td><button onclick="deleteUser('${user.UFID}')">Delete</button></td>
                         <td><button onclick="editUser('${user.UFID}', '${user.fullname}', '${user.email}', '${user.isAdmin}')">Edit</button></td>`;
    });
}
$(document).ready(function() {
      $('.edit-btn').click(function() {
    var ufid = $(this).data('ufid');
    var name = $(this).data('name');
    var email = $(this).data('email');
    var isAdmin = $(this).data('isadmin');

    $('#updateUFID').val(ufid);
    $('#updateName').val(name);
    $('#updateEmail').val(email);
    $('#updateIsAdmin').val(isAdmin == 1 ? "1" : "0"); // Ensure correct selection

    $('#editUserModal').modal('show');
});
    });
</script>

</body>
