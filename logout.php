#!/usr/local/bin/php
<?php
session_start();

// Destroy the session.
session_destroy();

// Redirect to login page
header("Location: index.php");
exit();
?>
