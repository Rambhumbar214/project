<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user uploaded notes
$sql = "SELECT * FROM notes WHERE uploaded_by = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user_notes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <h1>Your Dashboard</h1>
    <a href="upload.php">Upload New Note</a>

    <h2>Your Uploaded Notes</h2>
    <ul>
        <?php foreach ($user_notes as $note) { ?>
            <li>
                <a href="note.php?id=<?= $note['note_id'] ?>"><?= htmlspecialchars($note['title']) ?></a>
                - <a href="delete_note.php?id=<?= $note['note_id'] ?>">Delete</a>
            </li>
        <?php } ?>
    </ul>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
