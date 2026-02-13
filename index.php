<?php
// Main entry point - acts as a simple router or redirector
require_once 'config/config.php';

// If no specific page is requested, redirect to landing page
if ($_SERVER['REQUEST_URI'] == '/PrimeStateMS/' || $_SERVER['REQUEST_URI'] == '/PrimeStateMS/index.php') {
    header("Location: " . BASE_URL . "views/public/home.php");
    exit();
}
?>
