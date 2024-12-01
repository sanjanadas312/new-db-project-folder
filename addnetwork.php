<?php
require 'config.php'; // Ensure this file connects to the database

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize inputs
    $Equipment_Id = htmlspecialchars($_POST['Equipment_Id']);
    $Type = htmlspecialchars($_POST['Type']);
    $Ip_Address = htmlspecialchars($_POST['Ip_Address']);
    $Status = htmlspecialchars($_POST['Status']);
    $Comment = htmlspecialchars($_POST['Comment']);
    $Lab_ID = htmlspecialchars($_POST['Lab_ID']);

    // Insert data into the database
    $sql = "INSERT INTO networks (Equipment_Id, Type, Ip_Address, Status, Comment, Lab_ID) 
            VALUES (?, ?, ?, ?, ?, ?)";

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("ssssss", $Equipment_Id, $Type, $Ip_Address, $Status, $Comment, $Lab_ID);

        // Execute the query
        $stmt->execute();

        // Redirect to lab.php (equipment section) after successful insert
        header("Location: lab.php#equipmentDetails");
        exit; // Always call exit after header redirect to stop further script execution
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
}

// Fetch all data from the `networks` table
$data = [];
try {
    $result = $conn->query("SELECT * FROM networks");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>Error fetching data: " . $e->getMessage() . "</p>";
}
?>
