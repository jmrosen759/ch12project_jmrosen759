<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<h1>Search Results</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));

    $conn = mysqli_connect("127.0.0.1", "root", "", "ch12_data", 3307);

    if (!$conn) {
        echo "<div class='message'>Connection failed.</div>";
    } else {
        $sql = "SELECT firstName, lastName, email FROM tbl_student WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            echo "<div class='message'>";
            echo "Student found: " . $row["firstName"] . " " . $row["lastName"] . "<br>";
            echo "Email: " . $row["email"];
            echo "</div>";
        } else {
            echo "<div class='message'>The email was not found.</div>";
        }

        mysqli_close($conn);
    }
} else {
    echo "<div class='message'>Please submit the form first.</div>";
}
?>

<p><a href="index.php">Return to search page</a></p>

</body>
</html>