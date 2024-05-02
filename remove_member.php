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

// Delete Record
if (isset($_POST['delete'])) {
    $deleteId = $_POST['deleteId'];
    $clubId = $_POST['clubId'];

    // Prepare and bind the delete statement
    $stmt = $mysqli->prepare("DELETE FROM UserClubs WHERE UFID = ? AND ClubID = ?");
    $stmt->bind_param("ii", $deleteId, $clubId);

    if ($stmt->execute()) {
        echo "<script>alert('Member removed successfully'); window.location.href = 'member_view.php';</script>";
    } else {
        echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
    }

    $stmt->close();
}
?>
