<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>StackIt Q&A Forum</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to StackIt Q&A Forum</h1>
    <p>👋 Hello, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</p>
    <p><a href="logout.php">Logout</a></p>

    <a href="add_question.php">+ Ask a Question</a>
    <h2>All Questions</h2>

    <?php
    $result = $conn->query("SELECT * FROM questions ORDER BY created_at DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='question'>";
        echo "<h3><a href='view_question.php?id={$row['id']}'>" . htmlspecialchars($row['title']) . "</a></h3>";
        echo "<p>" . nl2br(htmlspecialchars(substr($row['description'], 0, 150))) . "...</p>";
        echo "<small>Posted on " . $row['created_at'] . "</small>";
        echo "</div>";
    }
    ?>
</body>
</html>
