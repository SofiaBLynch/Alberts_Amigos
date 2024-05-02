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
    // Handle unauthorized access here
    exit();
}

if (isset($_POST['event'])) {
    $code = $_POST['code'];
    $clubId = $_POST['clubId'];
    $eventId = "";
    $st = $mysqli->prepare("SELECT * FROM Events WHERE ClubID = ? AND AttendanceCode = ?");
    $st->bind_param("is", $clubId, $code);
    $st->execute();
    $evts = $st->get_result();
    if ($evts->num_rows > 0) {
        while ($row = $evts->fetch_assoc()) {
            $eventId = $row["EventID"];
        };
    }
    $st->close();

    // Prepare and bind the delete statement
    $stmt = $mysqli->prepare("INSERT INTO EventAttendees (UFID, EventID, Attended, ClubID) VALUES (?, ?, 1, ?)");
    $stmt->bind_param("iii", $_SESSION["UFID"], $eventId, $clubId);

    if ($stmt->execute()) {
        echo "<script>alert('Attendance recorded.'); window.location.href = 'member_view.php';</script>";
    } else {
        echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
    }

    $stmt->close();
}
?>
