<?php
session_start();

// Retrieve the search term from the URL
$searchTerm = urldecode($_GET['searchTerm']);

// Display the search term on the new page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
</head>
<body>
    <h1>Search Result</h1>
    <p>Search Term: <?php echo htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8'); ?></p>
    <a href="index.php">Back to Home</a>
</body>
</html>
