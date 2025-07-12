<?php
ob_start();
session_start();
include 'db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($conn->real_escape_string($_POST["username"]));
    $email = trim($conn->real_escape_string($_POST["email"]));
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "❌ Username or Email already exists. Please login or use different details.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            $success = "✅ Registration successful! You can now <a href='login.php'>login here</a>.";
        } else {
            $error = "❌ Registration failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - StackIt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Register - StackIt Q&A Forum</h1>

    <?php
    if ($error != "") echo "<p style='color:red;'>$error</p>";
    if ($success != "") echo "<p style='color:green;'>$success</p>";
    ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
<?php ob_end_flush(); ?>
