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

if (isset($_POST['make_event'])) {
    $eventName = $_POST['eventName'];
    $clubId = $_POST['clubId'];
    $date = $_POST['eventDate'];
    $code = $_POST['eventCode'];
    
    $stmt = $mysqli->prepare("INSERT INTO Events (name, date, AttendanceCode, ClubID) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $eventName, $date, $code, $clubId); // Changed "sdsi" to "sssi"

    if ($stmt->execute()) {
        echo "<script>alert('Event created successfully'); window.location.href='member_view.php';</script>";
    } else {
        echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
    }

    $stmt->close();
}
?>
