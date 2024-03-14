<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $profile_status = "Your profile status"; // Change this to the actual profile status of the logged-in user
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWD Interface Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Import your custom CSS file here -->
    <style>
        /* Add your custom styles here */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 36px;
            font-weight: bold;
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .menu-item {
            width: 200px;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            background-color: #f0f0f0;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-color: rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            border-radius: 50%;
            z-index: -1;
            transform: scale(0);
        }

        .menu-item:hover::before {
            transform: scale(2);
        }

        .menu-item i {
            font-size: 48px;
            margin-bottom: 10px;
            color: #3b7ddd;
        }

        .menu-item a {
            color: #3b7ddd;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            font-weight: bold;
            font-size: 18px;
            font-family: 'Arial', sans-serif;
        }

        /* Profile and Logout styles */
        .admin-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .admin-panel a {
            color: #3b7ddd;
            text-decoration: none;
            font-weight: bold;
            margin-left: 20px;
            font-size: 18px;
            font-family: 'Arial', sans-serif;
            transition: color 0.3s ease;
        }

        .admin-panel a:hover {
            color: #333;
        }

        .admin-panel i {
            font-size: 24px;
            margin-right: 10px;
            color: #3b7ddd;
        }

        .username {
            color: #3b7ddd;
            font-weight: bold;
            font-size: 18px;
            font-family: 'Arial', sans-serif;
            margin-right: 10px;
            transition: color 0.3s ease;
        }

        .username:hover {
            color: #333;
        }

        /* Profile Status */
        .profile-status {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php 
    // Check if user is logged in
    if (isset($_SESSION['username'])) {
        echo '<div class="admin-panel">';
        echo '<div>';
        echo '<span class="username">Welcome, ' . htmlspecialchars($username) . '!</span>';
        echo '<div class="profile-status">' . $profile_status . '</div>';
        echo '</div>';
        echo '<a href="MAIN_MENU.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>';
        echo '</div>';
    }
    ?>
    <div class="container">
        <h1>PWD Interface Dashboard</h1>
        <div class="menu">
            <div class="menu-item">
                <i class="fas fa-user-plus"></i>
                <div>Add PWD Member</div>
                <a href="add_member.php">Add PWD Member</a>
            </div>
            <div class="menu-item">
                <i class="far fa-calendar-check"></i>
                <div>Make an Attendance</div>
                <a href="make_attendance.php">Make an Attendance</a>
            </div>
            <div class="menu-item">
                <i class="fas fa-file-alt"></i>
                <div>Attendance Report</div>
                <a href="attendance_report.php">Attendance Report</a>
            </div>
        </div>
    </div>

    <!-- About Modal -->
    <div id="aboutModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>About</h2>
            <p>This is the PWD Interface Dashboard. It allows you to manage PWD members, make attendance, and generate attendance reports.</p>
        </div>
    </div>

    <script>
        // Open the modal
        function openModal() {
            document.getElementById("aboutModal").style.display = "block";
        }

        // Close the modal
        function closeModal() {
            document.getElementById("aboutModal").style.display = "none";
        }
    </script>
</body>
</html>
