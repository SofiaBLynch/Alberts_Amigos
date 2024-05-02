#!/usr/local/bin/php
<?php
session_start();
$mysqli = new mysqli("mysql.cise.ufl.edu", "chelseanguyen", "Caa20210408", "AlbertsAmigos");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

if (!isset($_SESSION['UFID'])) {
    // If UFID isn't set, redirect to the login page
    header("Location: login.php");
    exit();
}

$specific_ufid = $_SESSION['UFID'];

// Query to get the clubs based on UFID
$query = "SELECT c.* FROM UserClubs uc JOIN Clubs c ON uc.ClubID = c.ClubID WHERE uc.UFID = ?";
$clubInfo = [];
if ($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param("s", $specific_ufid); // Bind parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($club = $result->fetch_assoc()) {
            $clubInfo[] = $club;
        }
    }
    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./hub_page.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>GatorMeet</title>
</head>
<body>
    <h1>GatorMeet</h1>
    <div class="navbar">
        <a href="./hub_page.php">My Clubs</a>
        <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
            echo("<a href=''./admin.php'>Admin</a>");
        } ?>
        <a href="./search_page.php">Join a New Club</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
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
                minLength: 1
            });
        });
    </script>
    <div class="button-container">
    <?php
    if (!empty($clubInfo)) {
        foreach ($clubInfo as $club) {
            echo "<div class='button'>";
            echo "<h3>" . htmlspecialchars($club['name']) . "</h3>";
            echo "<p>" . htmlspecialchars($club['email']) . "</p>";
            echo "<a href='member_view.php?session=" . urlencode(session_id()) . "&club=" . urlencode($club['ClubID']) . "' class='btn btn-primary'>View</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No clubs found.</p>";
    }
    ?>
    </div>
</body>
</html>