<?php
// Retrieve form data
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$pwd_id = $_POST['pwd_id'];
$rfid_number = $_POST['rfid_number'];
$disability = $_POST['disability'];
$contact_number = $_POST['contact_number'];
$barangay = $_POST['barangay'];

// Create an array with the member data
$new_member_data = array(
    array($last_name, $first_name, $age, $gender, $pwd_id, $rfid_number, $disability, $contact_number, $barangay)
);

// Write the member data to a CSV file
$file = fopen('new_added_member.csv', 'w');
foreach ($new_member_data as $member) {
    fputcsv($file, $member);
}
fclose($file);

// Redirect back to the add member page with success message
header("Location: add_member.php?success=true");
exit();
?>
