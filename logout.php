#!/usr/local/bin/php
<?php
session_start();

// Destroy the session.
session_destroy();

// Redirect to login page
header("Location: welcome_page.html");
exit();
?>
