<?php
include 'config.php';

if (isset($_GET['id'])) {
    $note_id = $_GET['id'];

    // Get note details
    $sql = "SELECT * FROM notes WHERE note_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$note_id]);
    $note = $stmt->fetch();

    if ($note) {
        // Update download count
        $sql = "UPDATE notes SET download_count = download_count + 1 WHERE note_id = ?";
        $pdo->prepare($sql)->execute([$note_id]);

        // Increment download record
        $sql = "INSERT INTO downloads (user_id, note_id) VALUES (?, ?)";
        $pdo->prepare($sql)->execute([$_SESSION['user_id'], $note_id]);

        // Serve the file for download
        $file_path = $note['file_path'];
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        readfile($file_path);
        exit();
    } else {
        echo "Note not found!";
    }
}
?>
