<?php
// Sanitize input using filter_input for POST data
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// Check if inputs are valid
if ($name && $email && $message) {
    // Proceed with your database insertion or other logic
    $conn = new mysqli('localhost', 'root', '', 'max_handyman');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }

    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message); // Bind the sanitized inputs

    if ($stmt->execute()) {
        echo "Message sent successfully!";

    } else {
        echo "Error: " . $stmt->error;

    }

    $stmt->close();

    $conn->close();

} else {
    echo "Invalid input or missing fields.";

}

?>
<script src="assets/js/form-validation.js"></script>

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

