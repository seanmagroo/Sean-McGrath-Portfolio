<?php
// Database connection
include 'db.inc.php';

// Check form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"]; 

    // Retrieve the highest CustomerID
    $query_max_id = "SELECT MAX(CustomerID) AS max_id FROM Customer";
    $result_max_id = mysqli_query($con, $query_max_id);
    $row = mysqli_fetch_assoc($result_max_id);
    $new_customer_id = $row['max_id'] + 1;

    // Insert new customer and incremented CustomerID
    $query_insert = "INSERT INTO Customer (CustomerID, Name, Address, Email, PhoneNumber) VALUES ('$new_customer_id', '$name', '$address', '$email', '$telephone')";

    // Execute the query and handle success or error
    if (mysqli_query($con, $query_insert)) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record: " . mysqli_error($con);
    }
} else {
    // If form is not submitted
    echo "Form not submitted";
}
?>
