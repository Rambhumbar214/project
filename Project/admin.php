<?php
session_start();
include 'config.php';

// Check if user is admin
if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

// Get all users and notes
$sql_users = "SELECT * FROM users";
$stmt_users = $pdo->query($sql_users);
$users = $stmt_users->fetchAll();

$sql_notes = "SELECT * FROM notes";
$stmt_notes = $pdo->query($sql_notes);
$notes = $stmt_notes->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <h1>Admin Panel</h1>

    <h2>Manage Users</h2>
    <ul>
        <?php foreach ($users as $user) { ?>
            <li>
                <?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['role']) ?>)
                - <a href="delete_user.php?id=<?= $user['user_id'] ?>">Delete</a>
            </li>
        <?php } ?>
    </ul>

    <h2>Manage Notes</h2>
    <ul>
        <?php foreach ($notes as $note) { ?>
            <li>
                <?= htmlspecialchars($note['title']) ?> (<?= htmlspecialchars($note['subject']) ?>)
                - <a href="delete_note.php?id=<?= $note['note_id'] ?>">Delete</a>
            </li>
        <?php } ?>
    </ul>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
