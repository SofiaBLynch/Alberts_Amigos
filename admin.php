#!/usr/local/bin/php

<head>
    <link rel="stylesheet" href="./admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <html lang="en">
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
                document.getElementById("addOrganizationNameError").innerHTML = "*Required add organization name";
                ready = false; ;
            }

            var orgAbbrev = document.getElementById("addOrganizationAbbreviation").value;
            if(orgAbbrev === "")
            {
                document.getElementById("addOrganizationAbbreviationError").innerHTML = "*Required add organization abbreviation";
                ready = false;
            } 

            var orgPres = document.getElementById("addOrganizationEmail").value;
            var email = checkEmail(orgPres);
            if(!email)
            {
                document.getElementById("addOrganizationEmailError").innerHTML = "*Required add organization president UFL email";
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
            var oldEmail = document.getElementByID("changePresidentEmailOld").value;
            if(oldEmail === NULL || oldEmail === "")
            {
                document.getElementById("changePresidentErrorOld").innerHTML = "*Error: No current presdient. Complete add president form";
                return false; 
            }
            
            
            var email =document.getElementById("changePresidentEmailNew").value;
            if(!checkEmail(email))
            {
                document.getElementById("changePresidentEmailErrorNew").innerHTML = "*Required: Input valid UFL email";
                ready = false; 
            }
            
            if(ready)
            {
                console.log('ready');
                return true;
            } else {
                console.log('not');
                return false;
            }
        }
    </script>
</head>
<body>
   

    <h1>GatorMeet</h1>
    <div class="navbar">
        <a href="./member_view.html">My Clubs</a>
        <a href="./admin.html">Admin</a>
        <a href="#">Search</a>
        <a href="#">Engagement</a>
    </div>
    <?php
        $mysqli = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos");
        // Check connection
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        } 
        if(array_key_exists("addOrganizationSubmit", $_POST))
        {
            $orgName = $_POST["addOrganizationName"];
            $orgAbbr = $_POST["addOrganizationAbbreviation"];
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
        
    ?>
    <h1 style="color:black"> Admin </h1>
    <div class="adminForms">
        <div class = "form" id="addOrganizationForm">
            <h3> Add Organization </h3>
            <p class="errorMsg" id="addOrgSubmitError">
            
            </p>
            <form class="adminInputForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return checkAddOrg();">
                <p class="errorMsg" id="addOrganizationNameError"></p>
                <label for="addOrganizationName">Name of Organization:</label>
                <input type="text" id="addOrganizationName" name="addOrganizationName"autofocus placeholder="Women in Computer Science and Engineering"><br>
                <p class="errorMsg" id="addOrganizationAbbreviationError"></p>
                <label for="addOrganizationAbbreviation">Abbreviation of Organization:</label>
                <input type="text" id="addOrganizationAbbreviation"  name="addOrganizationAbbreviation" autofocus placeholder="WiCSE"><br>
                <p class="errorMsg" id="addOrganizationEmailError"></p>
                <label for="addOrganizationEmail">President's Email</label>
                <input type="text" id="addOrganizationEmail" name="addOrganizationEmail"autofocus placeholder="albert@ufl.edu"><br>
                <input type="submit" class="submitAdmin" id="addOrganizationSubmit" name = "addOrganizationSubmit"></input>
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
                <input type="text" id="addPresidentEmail" name="addPresidentEmail"autofocus placeholder="albert@ufl.edu"><br>
                <input type="submit" class="submitAdmin" id="addPresidentSubmit" name="addPresidentSubmit"></input>
            </form>
            
        </div>
        <div class = "form" id="removePresidentForm">
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
                <input type="text" id="removePresidentEmail" name="removePresidentEmail" autofocus placeholder="albert@ufl.edu"><br>
                <input type="submit" class="submitAdmin" id="removePresidentSubmit" name="removePresidentSubmit"></input>
            </form>
        </div> 
        <div class = "form" id="changePresidentForm">
            <h3> Change President </h3>
            <form class="adminInputForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return checkChangePres();">
                <p class="errorMsg" id="changePresidentEmailError"></p>            
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
                <input type="text" id="changePresidentOldEmail" autofocus placeholder="albert@ufl.edu"><br>
                <p class="errorMsg" id="changePresidentEmailErrorNew"></p>            
                <label for="changePresidentNewEmail">New President's Email</label>
                <input type="text" id="changePresidentNewEmail" autofocus placeholder="newAlbert@ufl.edu"><br>
                <input type="submit" class="submitAdmin" id="changePresidentSubmit" name="changePresidentSubmit"></input>
            </form>
        </div> 
    </div>
    <br>
    <div class="orgData">
        <h3>On-Campus Involvement</h3>
        <table>
            <tr>
                <th>Organization</th>
                <th>President Email</th>
                <th># of Members</th>
                <th># of Events</th>
                <th># of Events Attended/Member</th>
            </tr>
            <tr class="orgDataRow">
                <td>Society of Hispanic Engineers</td>
                <td>albert@ufl.edu</td>
                <td> 323 </td>
                <td> 25 </td>
                <td> 4 </td>
            </tr>
            <tr class="orgDataRow">
                <td>Women in Computer Science and Engineering</td>
                <td>albert@ufl.edu</td>
                <td> 120 </td>
                <td> 16 </td>
                <td> 5 </td>
            </tr>
            <tr class="orgDataRow">
                <td>Indian Student Association</td>
                <td>albert@ufl.edu</td>
                <td> 285 </td>
                <td> 13 </td>
                <td> 7 </td>
            </tr>
        </table>
        <br>
        
        <div id="orgDataButton">
            <button id="AdminViewAll">View All</button>
        </div>
        
    </div>
    <br><br>
</body>