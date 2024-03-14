<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add PWD Member</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-image: url('https://www.willerbywebportal.com/Content/images/whh_bg_01.jpg');
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
        }

        .form-container,
        .history-container {
            width: 48%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            margin-right: 20px;
        }

        h2 {
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 24px;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 22px); /* Adjust for padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f7f7f7;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #ff7f50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ff6347;
        }

        .history-content {
            max-height: 300px;
            overflow-y: auto;
        }

        .date-added {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .form-container,
            .history-container {
                width: 100%;
                margin-bottom: 20px;
            }

            .form-container {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Form Section -->
        <div class="form-container">
            <h2><i class="fas fa-user-plus" style="color: #ff7f50;"></i> Add PWD Member</h2>
            <form id="member-form" action="process_add_member.php" method="post">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <label for="pwd_id">PWD ID:</label>
                <input type="text" id="pwd_id" name="pwd_id" required>
                <label for="rfid_number">RFID Number:</label>
                <input type="text" id="rfid_number" name="rfid_number" required>
                <label for="disability">Disability:</label>
                <input type="text" id="disability" name="disability" required>
                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" required>
                <label for="barangay">Barangay:</label>
                <input type="text" id="barangay" name="barangay" required>
                <input type="submit" value="Submit">
            </form>
        </div>

        <!-- History Section -->
        <div class="history-container">
            <h2><i class="fas fa-history" style="color: #ff7f50;"></i> History</h2>
            <div class="history-content" id="history-content">
                <!-- History content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- JavaScript code -->
    <script>
        // Load history content dynamically
        document.addEventListener("DOMContentLoaded", function() {
            var historyContent = document.getElementById("history-content");
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    historyContent.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "new_added_member.csv", true);
            xhttp.send();
        });
    </script>
</body>
</html>
