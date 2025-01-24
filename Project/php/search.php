<?php
include 'config.php';

$search_query = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM notes WHERE title LIKE ? OR subject LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(['%' . $search_query . '%', '%' . $search_query . '%']);
$notes = $stmt->fetchAll();

foreach ($notes as $note) {
    echo "<p>" . htmlspecialchars($note['title']) . " - " . htmlspecialchars($note['subject']) . "</p>";
}
?>

<!-- Search Form -->
<form method="GET" action="search.php">
    <input type="text" name="search" placeholder="Search Notes" value="<?php echo $search_query; ?>" required>
    <button type="submit">Search</button>
</form>
