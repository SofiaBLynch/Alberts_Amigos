#!/usr/local/bin/php

<head>
    <link rel="stylesheet" href="./admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin All Organizations</title>
    <html lang="en">

</head>
<body>
    <h1>GatorMeet</h1>
    <div class="navbar">
        <a href="./hub_page.php">My Clubs</a>
        <a href="./admin.php">Admin</a>
        <a href="./search_page.php">Join New Club</a>
        <!-- <a href="#">Engagement</a> -->
        <a href="logout.php" class="btn btn-danger">Logout</a>
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
                            $row .= "<td>$name</td>";
                            $row .= "<td>$email</td>";
                            $row .= "<td>300</td>";
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
