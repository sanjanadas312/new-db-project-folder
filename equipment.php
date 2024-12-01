<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Management System</title>
    <link rel="stylesheet" href="styleLab.css">
    <style>
        /* Existing styles */

        /* Center the table and title */
        .center {
            text-align: center;
        }

        /* Style for the Button */
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
                <li><a href="dashboard.html">Dashboard</a></li>
                <li><a href="equipment.html">Equipment</a></li>
                <li><a href="lab-availability.html">Lab Availability</a></li>
                <li><a href="notifications.html">Notifications</a></li>
            </ul>
        </div>
    </div>
 <!-- Equipment Details Section -->
 <div id="equipmentDetails" class="details-section" style="display: none;">
                <div class="equipment-header-container">
                    <h2>Equipment Details</h2>
                </div>
                <center><h2>Equipment List</h2></center>
                <table>
                    <thead>
                        <tr>
                            <th>Equipment_Id</th>
                            <th>Type</th>
                            <th>Ip_Address</th>
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
                        $sql = "SELECT * FROM networks";
                        $result = $conn->query($sql);

                        // Check if there are any results
                        if ($result->num_rows > 0) {
                            // Loop through the results and display them
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['Equipment_Id'] . "</td>";
                                echo "<td>" . $row['Type'] . "</td>";
                                echo "<td>" . $row['Ip_Address'] . "</td>";
                                echo "<td>" . $row['Status'] . "</td>";
                                echo "<td>" . $row['Comment'] . "</td>";
                                echo "<td>" . $row['Lab_ID'] . "</td>";
                                echo "<td>";
                                echo "<form action='' method='POST' style='display: inline-block;'>";
                                echo "<input type='hidden' name='delete_equipment_id' value='" . $row['Equipment_Id'] . "'>";
                                echo "<button type='submit' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No equipment data available.</td></tr>";
                        }
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_equipment_id'])) {
                            $deleteId = $_POST['delete_equipment_id'];
                            $deleteSql = "DELETE FROM networks WHERE Equipment_Id = '$deleteId'";

                            if ($conn->query($deleteSql) === TRUE) {
                                // Redirect to Equipment Details section
                                echo "<script>
                                        alert('Equipment deleted successfully.');
                                        window.location.href = 'lab.php#equipmentDetails';
                                      </script>";
                            } else {
                                echo "<script>
                                        alert('Error deleting equipment: " . $conn->error . "');
                                        window.location.href = 'lab.php#equipmentDetails';
                                      </script>";
                            }
                        }
                        // Close the database connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>

    <!-- Notification Form Section -->
    <div id="notificationForm" class="notification-form">
        <h2>Send Notification</h2>
        <form action="#" method="POST">
            <label for="notification-type">Type:</label>
            <select id="notification-type" name="notificationType">
                <option value="urgent">Urgent</option>
                <option value="info">Information</option>
                <option value="warning">Warning</option>
            </select>

            <label for="notification-message">Message:</label>
            <textarea id="notification-message" name="notificationMessage" rows="4" placeholder="Enter your message"></textarea>

            <button type="submit">Send Notification</button>
        </form>
    </div>

    <script src="scriptLab.js"></script>
</body>
</html>
