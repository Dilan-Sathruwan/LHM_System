<?php 
include 'db_connection.inc.php';
include 'function.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = filter_input(INPUT_POST, 'username',  FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password',  FILTER_SANITIZE_SPECIAL_CHARS);

    if ($email === false) {
        die('Invalid email address.');
    }

    $result = registerStudent($conn, $username, $email, $password);

    // Display the result (success or error message)
    echo $result;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>

<body>

    <!-- Display success or error message to the user -->
    <?php if (isset($result_message)): ?>
    <p style="color: green;"><?= htmlspecialchars($result_message) ?></p>
    <?php elseif (isset($error_message)): ?>
    <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

</body>

</html>