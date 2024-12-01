<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Management System</title>
    <link rel="stylesheet" href="styleLab.css">
    <style>
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

        .notification-form {
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.notification-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

.notification-form select,
.notification-form textarea,
.notification-form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.notification-form button {
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
}

.notification-form button:hover {
    background-color: #0056b3;
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
                <li onclick="showDashboardDetails()">Dashboard</li>
                <li onclick="showPCDetails()">PC</li>
                <li onclick="showEquipmentDetails()">Equipment</li>
                <li onclick="showLabAvailabilityDetails()">Lab Availability</li>
                <li onclick="showNotificationForm()">Send Notification</li>
            </ul>
        </div>

        <!-- Right Content (Details) -->
        <div class="content">
            <!-- Lab Incharge Details (Initially Hidden) -->
            <div id="labInchargeDetails" class="details-section" style="display: none;">
                <h2>Lab Incharge Details</h2>
                <img id="labInchargeImage" src="https://via.placeholder.com/150" alt="Lab Incharge">
                <p id="labInchargeId">ID: B3</p>
                <p id="labInchargeLab">Lab Number: 123</p>
                <p id="labInchargeNameDetails">Name: Prof. F.R.Shaikh </p>
            </div>

            <!-- PC Details Section -->
            <div id="pcDetails" class="details-section" style="display: block;">
                <div class="pc-header-container">
                    <h2>PC Details</h2>
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
                        <?php
                        require 'config.php';
                        $sql = "SELECT * FROM computers";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
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
                                echo "<script>alert('PC deleted successfully.'); window.location.href='lab.php#pcDetails';</script>";
                            } else {
                                echo "<script>alert('Error deleting PC: " . $conn->error . "');</script>";
                            }
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Notification Form Section -->
            <div id="notificationForm" class="details-section" style="display: none;">
                <h2>Send Notification</h2>
                <form method="POST" class="notification-form">
                    <label for="receiver_id">Select Student:</label>
                    <select name="receiver_id" required>
                        <?php
                        require 'config.php';
                        $sql = "SELECT id, name FROM users WHERE role='student'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                        }
                        ?>
                    </select>
                    <label for="message">Message:</label>
                    <textarea name="message" rows="4" required></textarea>
                    <button type="submit" name="send">Send Notification</button>
                </form>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
                    $receiver_id = $_POST['receiver_id'];
                    $message = $_POST['message'];
                    $sql = "INSERT INTO notifications (receiver_id, message) VALUES ('$receiver_id', '$message')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Notification sent successfully.'); window.location.href='lab.php#notificationForm';</script>";
                    } else {
                        echo "<script>alert('Error sending notification: " . $conn->error . "');</script>";
                    }
                }
                ?>
            </div>

            <!-- Equipment and Lab Availability sections remain unchanged -->
        </div>
    </div>

    <script src="scriptLab.js"></script>
</body>
</html>
