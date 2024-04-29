#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Club Listing</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./hub_page.css">
</head>
<body>
<h1>GatorMeet</h1>
<div class="navbar">
    <a href="./hub_page.php">My Clubs</a>
    <a href="./admin.php">Admin</a>
    <a href="./search_page.php">Join New Club</a>
    <a href="#">Engagement</a>
</div>
<div class="container">
    <br>
    <div class="search-container">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by club name...">
    </div>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Join</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $conn = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos"); 
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT ClubID, name, email FROM Clubs";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td><button class='btn btn-primary joinBtn' data-club-id='" . $row["ClubID"] . "'>Join</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No clubs found</td></tr>";
                }

                $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.joinBtn').click(function() {
        var clubId = $(this).data('club-id');
        console.log("Attempting to join club with ID:", clubId);
        $.ajax({
            url: 'join_club.php',
            type: 'POST',
            data: { ClubID: clubId },
            success: function(response) {
                alert(response);
            },
            error: function(xhr, status, error) {
                alert('Error joining club: ' + error);
            }
        });
    });

    // Search filter
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

</body>
</html>
