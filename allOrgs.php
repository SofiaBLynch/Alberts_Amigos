#!/usr/local/bin/php

<head>
    <link rel="stylesheet" href="./admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin All Organizations</title>
    <html lang="en">

</head>
<body>
    <h1>GatorMeet</h1>
    <div class="navbar">
        <a href="./member_view.html">My Clubs</a>
        <a href="./admin.php">Admin</a>
        <a href="#">Search</a>
        <a href="#">Engagement</a>
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
                            $row .= "<td>$name</td>";
                            $row .= "<td>$email</td>";
                            $row .= "<td>$numMem</td>";
                            $row .= "<td>20</td>";
                            $row .= "<td>5</td>";
                        $row .= "</tr>";
                        echo($row);
                        $i += 1; 
                    }
                    
                } 
            ?>
        </table>
        <br> 
        <div id="orgDataButton">
            <button id="returnAdminButton"><a href="./admin.php">Return to Admin</a></button>
        </div>
    </div>
</body>
