<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></title>
</head>
<body>
    <h1>Welcome! You're logged in.</h1>

    <!-- Example: AJAX form (no refresh) -->
    <form id="ajaxForm">
        <input type="text" name="query" placeholder="Search...">
        <button type="submit">Search</button>
    </form>
    <div id="result"></div>

    <script>
    // Handle AJAX form submission
    document.getElementById("ajaxForm").addEventListener("submit", async (e) => {
        e.preventDefault();
        const response = await fetch("api.php", {
            method: "POST",
            body: new FormData(e.target),
        });
        const result = await response.text();
        document.getElementById("result").innerHTML = result;
    });
    </script>
</body>
</html>