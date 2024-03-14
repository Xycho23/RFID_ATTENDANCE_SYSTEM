<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFID Attendance System</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Moment.js for date and time -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- SheetJS for Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            max-width: 90%;
            overflow: auto;
            margin-top: 20px;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 40px;
            animation: fadeInUp 1s ease;
        }

        #rfidInput {
            padding: 20px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            font-size: 24px;
            background-color: #f9f9f9;
            width: 400px;
            text-align: center;
        }

        #historyTab {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
            display: none;
            width: 100%;
            overflow-x: auto;
            animation: fadeInUp 1s ease;
        }

        #historyTab h3 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        #historyTable {
            border-collapse: collapse;
            width: 100%;
        }

        #historyTable th,
        #historyTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #historyTable th {
            background-color: #f2f2f2;
        }

        .rfid-icon {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .save-buttons {
            margin-top: 20px;
            animation: fadeInUp 1s ease;
        }

        .save-buttons input,
        .save-buttons button {
            padding: 20px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            font-size: 24px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .save-buttons input[type="text"] {
            width: 400px;
        }

        .save-buttons button:hover {
            background-color: #45a049;
        }

        .return-button {
            margin-top: 20px;
        }

        .return-button a {
            padding: 20px 40px;
            background-color: #FFA500;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 24px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .return-button a:hover {
            background-color: #FF8C00;
        }

        #clock {
            font-size: 100px;
            margin-bottom: 40px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="clock"></div>

        <div class="input-container">
            <div id="rfidIcon" class="rfid-icon"><i class="fas fa-rss"></i></div>
            <input type="text" id="rfidInput" placeholder="Tap RFID Card">
        </div>

        <div id="historyTab">
            <h3><i class="fas fa-history"></i> Attendance History</h3>
            <table id="historyTable">
                <thead>
                    <tr>
                        <th>RFID Number</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>PWD ID</th>
                        <th>Contact Number</th>
                        <th>Purok</th>
                    </tr>
                </thead>
                <tbody id="historyList"></tbody>
            </table>
        </div>

        <div class="save-buttons">
            <input type="text" id="excelFileName" placeholder="Excel Filename">
            <button onclick="saveAttendanceAsExcel()"><i class="fas fa-file-excel"></i> Save as Excel</button>
        </div>

        <div class="return-button">
            <a href="dashboard.php"><i class="fas fa-arrow-left"></i> Return to Dashboard</a>
        </div>
    </div>

    <script>
        // Declare an object to store attendance data
        var attendanceData = {};

        // Function to handle RFID scanning
        function scanRFID() {
            var rfidData = document.getElementById('rfidInput').value.trim();

            // Check if RFID data is not empty
            if (rfidData !== '') {
                // Check if data for this RFID already exists
                if (!attendanceData[rfidData]) {
                    console.log('Fetching CSV file...');
                    fetch('attendance.csv')
                        .then(response => {
                            console.log('CSV file fetched successfully');
                            return response.text();
                        })
                        .then(data => {
                            console.log('CSV data:', data);
                            // Split the CSV data into rows
                            var rows = data.split('\n');
                            // Loop through each row to find the matching RFID data
                            for (var i = 0; i < rows.length; i++) {
                                var rowData = rows[i].split(',');
                                if (rowData[0].trim() === rfidData) {
                                    // Matching record found
                                    // Store attendance data in the object
                                    attendanceData[rfidData] = rowData.slice(1); // Exclude the RFID number
                                    // Update the history table with the stored attendance data
                                    updateHistoryTable();
                                    // Show the history tab
                                    document.getElementById('historyTab').style.display = 'block';
                                    return;
                                }
                            }
                            // If no matching record found
                            console.log('No matching record found for RFID data:', rfidData);
                        })
                        .catch(error => console.error('Error fetching CSV file:', error));
                } else {
                    console.log('Attendance data already exists for RFID:', rfidData);
                }

                // Clear the RFID input field after processing
                document.getElementById('rfidInput').value = '';
            }
        }

        // Function to update the history table with attendance data
        function updateHistoryTable() {
            var historyTableBody = document.getElementById('historyList');
            // Clear the existing table content
            historyTableBody.innerHTML = '';
            // Loop through each RFID ID in the attendance data object
            for (var rfid in attendanceData) {
                if (attendanceData.hasOwnProperty(rfid)) {
                    var newRow = historyTableBody.insertRow();
                    // Insert RFID data into the first cell
                    var rfidCell = newRow.insertCell();
                    rfidCell.textContent = rfid;
                    // Insert attendance data into subsequent cells
                    attendanceData[rfid].forEach(field => {
                        var cell = newRow.insertCell();
                        cell.textContent = field.trim();
                    });
                }
            }
        }

        // Function to handle saving attendance as Excel
        function saveAttendanceAsExcel() {
            var htmlTable = document.getElementById('historyTable');
            var wb = XLSX.utils.table_to_book(htmlTable, { sheet: "Attendance" });
            var fileName = document.getElementById('excelFileName').value.trim() || 'attendance_' + moment().format('YYYYMMDD_HHmmss') + '.xlsx'; // Custom file name with timestamp
            XLSX.writeFile(wb, fileName);
        }

        // Automatically trigger RFID scanning when input field changes
        document.getElementById('rfidInput').addEventListener('change', scanRFID);

        // Function to update clock every second
        function updateClock() {
            var now = moment().format('HH:mm:ss');
            document.getElementById('clock').textContent = now;
        }

        // Update the clock initially and then every second
        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>
</html>
