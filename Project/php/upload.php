<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    // Collect note data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $subject = $_POST['subject'];

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    // Insert note data into the database
    $sql = "INSERT INTO notes (title, description, subject, file_path, uploaded_by) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $subject, $target_file, $_SESSION['user_id']]);

    echo "Note uploaded successfully!";
}
?>

<!-- Upload Form -->
<form method="POST" enctype="multipart/form-data" action="upload.php">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="text" name="subject" placeholder="Subject" required>
    <input type="file" name="file" required>
    <button type="submit">Upload Note</button>
</form>
