#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./member_view.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>GatorMeet - Member View</title>
</head>

<body>

    <h1>GatorMeet</h1>

    <div class="navbar">
        <a href="./hub_page.php">My Clubs</a>
        <a href="./search_page.php">Join New Club</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

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

    // Check if session ID and club name parameters are set
    if(isset($_GET['session']) && isset($_GET['club'])) {
        // Retrieve session ID and club name from URL parameters
        $session_id = $_GET['session'];
        $club_id = $_GET['club'];
        $events = array();

        // Validate session ID and club name if necessary

        // Prepare the SQL statement using a parameterized query
        $query = "SELECT * FROM EventAttendees WHERE ClubID = ? AND UFID = ? AND Attended = 1";
        if ($stmt = $mysqli->prepare($query)) {
            // Bind parameters
            $stmt->bind_param("ii", $club_id, $_SESSION['UFID']); // Assuming UFID is an integer
            // Execute the statement
            $stmt->execute();
            // Get result
            $result = $stmt->get_result();

            $points = 0;
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Loop through each row
                while ($row = $result->fetch_assoc()) {
                    // Increment points for each attended event
                    $points += 1;
                    $events[$row["EventID"]] = $row["Attended"];
                }
            }
            $stmt->close();
        } else {
            echo "Failed to prepare the SQL statement.";
        }
        $stmt = $mysqli->prepare("SELECT * FROM Clubs WHERE ClubID = ?");
        $stmt->bind_param("i", $club_id);
        $stmt->execute();
        $clubData = $stmt->get_result();
        $clubName = "";
        $clubAbbrv = "";
        $clubEmail = "";
        $isPres = false;
        if ($clubData->num_rows > 0) {
            // Loop through each row
            while ($club = $clubData->fetch_assoc()) {
                // Retrieve club data
                $clubName = $club["name"];
                $clubAbbrv = $club["abbrv"];
                $clubEmail = $club["email"];
                $st = $mysqli->prepare("SELECT * FROM Users WHERE UFID = ?");
                $st->bind_param("i", $_SESSION["UFID"]);
                $st->execute();
                $usr = $st->get_result();
                if ($usr->num_rows > 0) {
                    while ($userInfo = $usr->fetch_assoc()) { // forgive the spaghetti code
                        if ($clubEmail == $userInfo["email"]) {
                            $isPres = true;
                        } else {
                        }
                    }
                }
            }
        } else {
            echo "Club not found.";
        }
        $stmt->close();
        // Now you can process the data as needed
        echo "<br><br><br>";
        echo "<h1>" . $clubName . "</h1>";
        if ($clubAbbrv == "NULL") {
            $clubAbbrv = "";
        }
        echo "<h3>" . $clubAbbrv . "</h3>";
        echo "<div class='container'>";
        echo "<div class='attendance-box'><h3>Attendance:</h3><form name='enter-code' action='event_code.php' method='post'><input type='text' class='attendance-input' name='code' placeholder='GBM1'><input type='hidden' name='clubId' value='".$club_id."'><input name='event' type='submit' class='attendance-submit'></form></div>";
        echo "<div class='points-box'><h3>Points:</h3><h4>" . $points . "</h4></div>";
        echo "<div class='events-box'><h3>Recent Events:</h3>";
        echo "<table class='events-table'><tr style='bold'><td>Event</td><td>Date</td><td>Points</td></tr>";
        $stmt = $mysqli->prepare("SELECT * FROM Events WHERE ClubID = ?");
        $stmt->bind_param("i", $club_id);
        $stmt->execute();
        $evts = $stmt->get_result();
        if ($evts->num_rows > 0) {
            while ($row = $evts->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $events[$row["EventID"]] . "</td>";
                echo "</tr>";
            };
        }
        $stmt->close();
        echo "</table></div>";
        if ($isPres) {
            echo "<div class='make-event-box'><h3>Create Event</h3>";
            echo "<form name='make-event-form' action='make_event.php' method='post'>
            <input type='text' name='eventName' id='event-name-input' placeholder='event name'>
            <input type='date' name='eventDate' id='event-date-input'>
            <input type='text' name='eventCode' id='event-code-input' placeholder='CODE'>
            <input type='hidden' name='clubId' value='".$club_id."'>
            <input name='make_event' type='submit'>
            </form>
            </div>";
            echo "<div class='remove-member-box'><table class='remove-member-table'><h3>Remove Members</h3>";
            $st = $mysqli->prepare("SELECT * FROM UserClubs WHERE ClubID = ?");
            $st->bind_param("i", $club_id);
            $st->execute();
            $mems = $st->get_result();
            if ($mems->num_rows > 0) {
                while ($row = $mems->fetch_assoc()) {
                    echo "<tr>";
                    $ust = $mysqli->prepare("SELECT * FROM Users WHERE UFID = ?");
                    $ust->bind_param("i",$row["UFID"]);
                    $ust->execute();
                    $usr = $ust->get_result();
                    if ($usr->num_rows > 0) {
                        while ($usrRow = $usr->fetch_assoc()) {
                            echo "<td>" . $usrRow["fullname"] . "</td>";
                            echo "<td>
                                <form method='post' action='remove_member.php'>
                                    <input type='hidden' name='deleteId' value='" . $usrRow["UFID"] . "'>
                                    <input type='hidden' name='clubId' value='" . $club_id . "'>
                                    <input type='submit' name='delete' value='Delete'>
                                </form>
                            </td>";
                        }
                    }
                }
            }
            echo "</table></div>";
        }
        echo "</div>";
    } else {
        // Handle case where parameters are missing
        echo "<p>Internal Server Error. Go back a page and try again.</p>";
    }
    ?>
</body>
</html>
