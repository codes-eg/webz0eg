<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Localhost Database
$servername = "localhost";
$username = "root";
$password = ""; // Empty
$database = "coffeeusers";

// Check connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailaddress = $_POST["emailaddress"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $userpassword = password_hash($_POST["userpassword"], PASSWORD_BCRYPT); // Hash the password

    // Check if the email already exists
    $checkEmailQuery = "SELECT user_id FROM coffeesignup WHERE LOWER(emailaddress) = LOWER('$emailaddress')";
    $checkEmailResult = $conn->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        echo "Email already exists. Please use a different email address.";
    } else {
        // Insert into coffeesignup
        $sqlSignup = "INSERT INTO coffeesignup (emailaddress, firstname, lastname, username, userpassword)
                      VALUES ('$emailaddress', '$firstname', '$lastname', '$username', '$userpassword')";

        if ($conn->query($sqlSignup) === TRUE) {
            echo "Signup successful";
        } else {
            echo "Error inserting into coffeesignup: " . $conn->error;
        }
    }
} else {
    echo "Invalid request method";
}

// Close the connection
$conn->close();

?>
