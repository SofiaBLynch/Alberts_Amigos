#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./hub_page.css">
    <!-- for autocomplete search bar functionality -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>GatorMeet</title>
</head>

<body>

    <h1>GatorMeet</h1>

    <div class="navbar">
        <a href="./member_view.html">My Clubs</a>
        <a href="./admin.php">Admin</a>
        <a href="#"><label for="club-search">Search for a club:</label>
            
            <input type="text" id="club-search" name="club-search">
        </a>
        <a href="#">Engagement</a>
    </div>

    <div class="button-container">
        <?php
        $mysqli = new mysqli("mysql.cise.ufl.edu", "chelseanguyen", "Caa20210408", "AlbertsAmigos");
        // Check connection
        
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        // Replace 'specific_ufid' with the actual UFID you want to filter by
        $specific_ufid = '11111111';
        $result = $mysqli->query("SELECT c.* FROM UserClubs uc JOIN Clubs c ON uc.ClubID = c.ClubID WHERE uc.UFID = '" . $specific_ufid . "'");

        $i = 0;
        if ($result->num_rows > 0) {
            while ($club = $result->fetch_assoc()) {
                if ($i % 2 == 1) {
                    $row = "<div class='button'>";
                } else {
                    $row = "<div class='button'>";
                }

                $name = $club['name'];
                $email = $club['email'];
                $row .= "<h3>" . htmlspecialchars($name) . "</h3>";
                $row .= "<p>" . htmlspecialchars($email) . "</p>";
                $row .= "<button type='button' class='btn btn-primary'>View</button>";
                $row .= "</div>";
                echo ($row);
                $i += 1;
            }
        }

        $mysqli->close();

        ?>

    </div>

    <script>
        $(document).ready(function () {
            $('#club-search').autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: 'hub_page.php', 
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                minLength: 1 // Start after at least 2 characters are typed
            });
        });
    </script>


</body>

</html>