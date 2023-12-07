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
    $userpassword = $_POST["userpassword"];

    // Retrieve hashed password from the coffeesignup table based on the provided email
    $sql = "SELECT user_id, userpassword FROM coffeesignup WHERE LOWER(emailaddress) = LOWER('$emailaddress')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPasswordFromDB = $row["userpassword"];

        echo "SQL Query: $sql<br>";
        echo "Retrieved Hashed Password from Database: $hashedPasswordFromDB<br>";

        // Verify the password using password_verify
        if (password_verify($userpassword, $hashedPasswordFromDB)) {
            echo "Login successful";
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }
}

// Close the connection
$conn->close();

?>
