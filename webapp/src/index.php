<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input to prevent XSS and SQL injection attacks
    $searchTerm = htmlspecialchars($_POST['searchTerm'], ENT_QUOTES, 'UTF-8');

    // Check for SQL injection
    if (containsSqlInjection($searchTerm)) {
        // Clear input and remain on home page
        header('Location: index.php');
        exit();
    }

    // Display the search term on a new page
    header('Location: result.php?searchTerm=' . urlencode($searchTerm));
    exit();
}

function containsSqlInjection($input) {
    // Define common SQL injection patterns
    $sqlInjectionPatterns = [
        '/\bUNION\b/i',
        '/\bSELECT\b/i',
        '/\bINSERT\b/i',
        '/\bUPDATE\b/i',
        '/\bDELETE\b/i',
        '/\bFROM\b/i',
        '/\bWHERE\b/i',
        '/\bDROP\b/i',
        '/\bCREATE\b/i',
        '/\bALTER\b/i',
        '/\bEXEC\b/i',
    ];

    // Check for SQL injection patterns
    foreach ($sqlInjectionPatterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true; // Detected SQL injection attempt
        }
    }

    return false; // No SQL injection patterns found
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Application</title>
</head>
<body>
    <form action="index.php" method="post">
        <label for="searchTerm">Search Term:</label>
        <input type="text" name="searchTerm" id="searchTerm" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
