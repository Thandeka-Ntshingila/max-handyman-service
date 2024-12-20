<?php
// Sanitize and validate inputs using filter_input
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING); // Assuming the format is 'YYYY-MM-DD'
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT); 
$service_type = filter_input(INPUT_POST, 'service_type', FILTER_SANITIZE_STRING);

// Check if inputs are valid
if ($name && $email && $date && $phone && $service_type) {
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Validate the date format (optional)
    if (!strtotime($date)) {
        echo "Invalid date format!";
        exit;

    }

    // Create a database connection
    $conn = new mysqli('localhost', 'root', '', 'handyman_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }

    // Prepare an SQL statement to insert the appointment data
    $stmt = $conn->prepare("INSERT INTO appointments (name, email, date, phone, service_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $date, $phone, $service_type); // Bind sanitized inputs



    // Execute the query and check if it was successful

    if ($stmt->execute()) {
        echo "Appointment booked successfully!";

    } else {
        echo "Error: " . $stmt->error;

    }
   
    // Close the statement and the connection
    $stmt->close();

    $conn->close();

} else {
    echo "All fields are required!";

}
?>
/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

