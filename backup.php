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
                                echo "<script>alert('PC deleted successfully.'); window.location.href='lab.php#pcDetails';</script>";
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
            

            <!-- Equipment Details Section -->
            <div id="equipmentDetails" class="details-section" style="display: none;">
                <div class="equipment-header-container">
                    <h2>Equipment Details</h2>
                    <!-- Button that will redirect to the Add Equipment page -->
                    <button class="add-equipment-btn" onclick="window.location.href='addnetwork.html'">Add Equipment</button>
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

            <div id="labAvailabilityDetails" class="details-section" style="display: none;">
                <h2>Lab Availability Details</h2>
                <p>Details for Lab Availability will be added later.</p>
            </div>
        </div>
    </div>

    <script src="scriptLab.js"></script>
</body>
</html>
