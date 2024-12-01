<?php
require 'config.php'; // Include the database connection file (Make sure config.php has the correct database connection setup)

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $Pc_Id = htmlspecialchars($_POST['Pc_Id']);
    $Processor = htmlspecialchars($_POST['Processor']);
    $Ram_Size = htmlspecialchars($_POST['Ram_Size']);
    $Storage_Size = htmlspecialchars($_POST['Storage_Size']);
    $Os_Version = htmlspecialchars($_POST['Os_Version']);
    $Status = htmlspecialchars($_POST['Status']);
    $Comment = htmlspecialchars($_POST['Comment']);
    $Lab_ID = htmlspecialchars($_POST['Lab_ID']);

    // SQL query to insert data
    $sql = "INSERT INTO computers (Pc_Id, Processor, Ram_Size, Storage_Size, Os_Version, Status, Comment, Lab_ID) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("ssssssss", $Pc_Id, $Processor, $Ram_Size, $Storage_Size, $Os_Version, $Status, $Comment, $Lab_ID);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the lab.html page after successful insertion
            header("Location: lab.php#pcDetails");
            exit();
        } else {
            echo "Error: " . $stmt->error; // Display error if query fails
        }

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        // Display an error message in case of failure
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$conn->close();
?>
