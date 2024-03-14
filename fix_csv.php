<?php
// Function to fix the CSV file
function fixCSVFile($filename) {
    // Read the entire CSV file into an array
    $lines = file($filename);

    // Remove any empty lines and trim whitespace from each line
    $lines = array_filter(array_map('trim', $lines));

    // Write the cleaned lines back to the CSV file
    file_put_contents($filename, implode("\n", $lines));
}

// Example usage: Fix the "attendance.csv" file
fixCSVFile("attendance.csv");
?>
