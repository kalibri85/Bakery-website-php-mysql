<?php
include('includes/connections.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $text = $_POST['text'];
    $conn->query("INSERT INTO feedback (name, email, text) VALUES ('$name', '$email', '$text')");
}
?>
<form method="post">
    <input name="name" placeholder="Name">
    <input name="email" placeholder="Email">
    <textarea name="text" placeholder="Your feedback"></textarea>
    <button type="submit">Send Feedback</button>
</form>