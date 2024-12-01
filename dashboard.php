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
                <li onclick="showDashboardDetails()">Dashboard</li>
                <li onclick="showPCDetails()">PC</li>
                <li onclick="showEquipmentDetails()">Equipment</li>
                <li onclick="showLabAvailabilityDetails()">Lab Availability</li>
                <li onclick="showNotificationForm()">Notifications</li>
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

</body>
</html>
