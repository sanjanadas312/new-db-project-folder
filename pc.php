<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Management System</title>
    <link rel="stylesheet" href="styleLab.css">
    <style>
        /* Existing styles */
        /* Style for the PC Details Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }
        
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        table th {
            background-color: #4CAF50;
            color: white;
        }
        
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        table tr:hover {
            background-color: #ddd;
        }
        
        table td {
            text-align: center;
        }
        
        /* Center the table and title */
        .center {
            text-align: center;
        }

        /* Style for the Button next to PC Details */
        .pc-header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-computer-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .add-computer-btn:hover {
            background-color: #45a049;
        }

        /* Add Equipment Button to the right */
        .equipment-header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-equipment-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .add-equipment-btn:hover {
            background-color: #45a049;
        }

        /* Optional: Responsive table for small screens */
        @media screen and (max-width: 768px) {
            table, th, td {
                width: 100%;
                display: block;
                text-align: left;
            }
            table th {
                text-align: center;
            }
        }

        /* Notification Form Styling */
        .notification-header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .notification-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 20px auto;
        }

        .notification-form label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .notification-form select, 
        .notification-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .notification-form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .notification-form button:hover {
            background-color: #45a049;
        }

        p.notification-success {
            color: green;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        p.notification-error {
            color: red;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <h1>Lab Management System</h1>
        </div>
        <div class="nav-right">
            <span id="labInchargeName" onclick="showLabInchargeDetails()">Lab Incharge</span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Left Sidebar (Dashboard Options) -->
        <div class="sidebar">
            <ul>
            <ul>
    <li><a href="dashboard.html">Dashboard</a></li>
    <li><a href="pc.html">PC</a></li>
    <li><a href="equipment.html">Equipment</a></li>
    <li><a href="lab-availability.html">Lab Availability</a></li>
    <li><a href="notifications.html">Notifications</a></li>
</ul>

            </ul>
        </div>

        

    <script src="scriptLab.js"></script>
    <script>
        // Function to show notification form
        function showNotificationForm() {
            hideAllSections();
            document.getElementById('notificationForm').style.display = 'block';
        }

        // Function to hide all sections
        function hideAllSections() {
            const sections = document.querySelectorAll('.details-section');
            sections.forEach(section => section.style.display = 'none');
        }

        // Existing functions (showDashboardDetails, showPCDetails, etc.) should be defined in scriptLab.js
        // Ensure that showNotificationForm is properly linked to the sidebar
    </script>
<!-- PC Details Section -->
<div id="pcDetails" class="details-section" style="display: block;">
    <div class="pc-header-container">
        <h2>PC Details</h2>
        <!-- Button that will redirect to the Add Computer page -->
        <button class="add-computer-btn" onclick="window.location.href='addcomputer.html'">Add Computer</button>
    </div>

    <center><h2>Computers List</h2></center>
    <table>
        <thead>
            <tr>
                <th>PC_Id</th>
                <th>Processor</th>
                <th>Ram_Size</th>
                <th>Storage_Size</th>
                <th>Os_Version</th>
                <th>Status</th>
                <th>Comment</th>
                <th>Lab_ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be fetched dynamically using PHP -->
            <?php
            require 'config.php'; // Include the database connection file

            // Fetch data from the database
            $sql = "SELECT * FROM computers";
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Loop through the results and display them
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Pc_Id'] . "</td>";
                    echo "<td>" . $row['Processor'] . "</td>";
                    echo "<td>" . $row['Ram_Size'] . "</td>";
                    echo "<td>" . $row['Storage_Size'] . "</td>";
                    echo "<td>" . $row['Os_Version'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "<td>" . $row['Comment'] . "</td>";
                    echo "<td>" . $row['Lab_ID'] . "</td>";
                    echo "<td>";
                    echo "<form action='' method='POST' style='display: inline-block;'>";
                    echo "<input type='hidden' name='delete_pc_id' value='" . $row['Pc_Id'] . "'>";
                    echo "<button type='submit' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No PC data available.</td></tr>";
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_pc_id'])) {
                $deleteId = $_POST['delete_pc_id'];
                $deleteSql = "DELETE FROM computers WHERE Pc_Id = '$deleteId'";
                if ($conn->query($deleteSql) === TRUE) {
                    echo "<script>alert('PC deleted successfully.'); window.location.href='pc.php';</script>";
                } else {
                    echo "<script>alert('Error deleting PC: " . $conn->error . "');</script>";
                }
            }
            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>

</div>
</body>
</html>
