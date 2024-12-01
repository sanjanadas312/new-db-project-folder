<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and trim user input
    $name = trim($_POST['name']);
    $roll_no = trim($_POST['roll_no']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash password
    $role = trim($_POST['role']);

    $errorMessages = [];

    // Validate name: only letters and spaces
    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $errorMessages[] = "Name should only contain letters and spaces.";
    }

    // Validate roll number: only numbers
    if (!preg_match('/^\d+$/', $roll_no)) {
        $errorMessages[] = "Roll number should only contain numbers.";
    }

    // Validate email domain
    if (!preg_match('/@sycet\.org$/', $email)) {
        $errorMessages[] = "Only @sycet.org emails are allowed!";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "Invalid email format!";
    }

    // Check for duplicate entries (using prepared statement for security)
    $checkQuery = $conn->prepare("SELECT * FROM users WHERE email = ? OR roll_no = ?");
    $checkQuery->bind_param("ss", $email, $roll_no);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        $errorMessages[] = "User with the same email or roll number already exists.";
    }

    // If there are any error messages, display them and stop the registration
    if (!empty($errorMessages)) {
        foreach ($errorMessages as $message) {
            echo "<script>alert('$message'); window.history.back();</script>";
        }
        exit;
    }

    // If no errors, proceed to insert the data
    $insertQuery = $conn->prepare("INSERT INTO users (name, roll_no, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $insertQuery->bind_param("sssss", $name, $roll_no, $email, $password, $role);

    if ($insertQuery->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='login.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
