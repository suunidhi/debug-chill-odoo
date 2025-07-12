<?php include 'db.php';

$id = (int)$_GET['id'];
$result = $conn->query("SELECT * FROM questions WHERE id = $id");
$question = $result->fetch_assoc();

$answers = $conn->query("SELECT * FROM answers WHERE question_id = $id ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($question['title']); ?> - StackIt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($question['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($question['description'])); ?></p>
    <small>Posted on <?php echo $question['created_at']; ?></small>
    <hr>
    <h2>Answers</h2>
    <?php
    while ($row = $answers->fetch_assoc()) {
        echo "<div class='answer'>";
        echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
        echo "<small>By " . htmlspecialchars($row['author']) . " on " . $row['created_at'] . "</small>";
        echo "</div>";
    }
    ?>
    <hr>
    <h2>Post an Answer</h2>
    <form action="add_answer.php" method="post">
        <input type="hidden" name="question_id" value="<?php echo $id; ?>">
        <input type="text" name="author" placeholder="Your Name" required><br>
        <textarea name="description" placeholder="Your Answer..." rows="5" required></textarea><br>
        <button type="submit">Post Answer</button>
    </form>
    <a href="index.php">⬅ Back to Questions</a>
</body>
</html>
