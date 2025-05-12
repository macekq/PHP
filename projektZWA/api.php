<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    die("Unauthorized!"); // Reject if not logged in
}

// Handle AJAX actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'] ?? '';
    echo "You searched for: " . htmlspecialchars($query);
}
?>