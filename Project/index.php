<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Notes Sharing System</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <h1>Welcome to the Online Notes Sharing System</h1>

    <!-- Search Bar -->
    <form method="GET" action="search.php">
        <input type="text" name="search" placeholder="Search Notes" required>
        <button type="submit">Search</button>
    </form>

    <h3>Popular Notes</h3>
    <?php
    // Get popular notes (for example, based on download count or upload date)
    $sql = "SELECT * FROM notes ORDER BY download_count DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $popular_notes = $stmt->fetchAll();

    foreach ($popular_notes as $note) {
        echo "<p><a href='note.php?id=" . $note['note_id'] . "'>" . htmlspecialchars($note['title']) . "</a></p>";
    }
    ?>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
