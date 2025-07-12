<?php include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = (int)$_POST["question_id"];
    $author = $conn->real_escape_string($_POST["author"]);
    $description = $conn->real_escape_string($_POST["description"]);

    $conn->query("INSERT INTO answers (question_id, author, description) VALUES ($question_id, '$author', '$description')");
    header("Location: view_question.php?id=$question_id");
    exit();
}
?>
