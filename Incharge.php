<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Management System</title>
    <link rel="stylesheet" href="styleLab.css">
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
        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li><a href="index.php?page=pcDetails">PC Details</a></li>
                <li><a href="index.php?page=equipmentDetails">Equipment</a></li>
                <li><a href="index.php?page=notificationForm">Notifications</a></li>
            </ul>
        </div>

        <!-- Dynamic Content -->
        <div class="content">
            <?php
            // Dynamically load the requested page
            if (isset($_GET['page'])) {
                $page = htmlspecialchars($_GET['page']);
                $path = "php/" . $page . ".php";
                if (file_exists($path)) {
                    include($path);
                } else {
                    echo "<p>Page not found.</p>";
                }
            } else {
                echo "<p>Welcome to the Lab Management System. Use the sidebar to navigate.</p>";
            }
            ?>
        </div>
    </div>

    <script src="js/scriptLab.js"></script>
</body>
</html>
