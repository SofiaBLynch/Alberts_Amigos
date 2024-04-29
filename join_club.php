#!/usr/local/bin/php
<?php
session_start();
error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 1);

if (!isset($_SESSION['UFID'])) {
    echo "You are not logged in.";
    exit;
}

$ufid = $_SESSION['UFID'];
$clubID = isset($_POST['ClubID']) ? $_POST['ClubID'] : null;

if (is_null($clubID)) {
    echo "No Club ID provided.";
    exit;
}

$conn = new mysqli("mysql.cise.ufl.edu", "sofia.lynch", "Ramiro2012", "AlbertsAmigos"); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO UserClubs (UFID, ClubID) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ii", $ufid, $clubID);
    if ($stmt->execute()) {
        echo "Successfully joined the club!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>
