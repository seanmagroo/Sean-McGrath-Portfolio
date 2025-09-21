<?php
include 'db.inc.php';

// Check if all required fields are set 
if (isset($_POST['amendname'], $_POST['amendaddress'], $_POST['amendemail'], $_POST['amendphonenumber'], $_POST['customerID'])) {
    // SQL query to update customer information
    $sql = "UPDATE Customer SET name = ?, address = ?, email = ?, phonenumber = ? WHERE customerid = ?";
    // Prepare the SQL statement
    $stmt = mysqli_prepare($con, $sql);

    // Check SQL statement preparation was successful
    if (!$stmt) {
        // If  fails, display error message
        die('Error: ' . mysqli_error($con));
    }

    // Bind parameters to the SQL statement
    mysqli_stmt_bind_param($stmt, "ssssi", $_POST['amendname'], $_POST['amendaddress'], $_POST['amendemail'], $_POST['amendphonenumber'], $_POST['customerID']);

    // Execute the SQL statement
    if (!mysqli_stmt_execute($stmt)) {
        // If execution fails, display error message 
        die('Error: ' . mysqli_error($con));
    }

    // Check if any rows were affected by the update operation
    if (mysqli_affected_rows($con) > 0) {
        // If rows were affected, display success message
        echo "Customer record updated successfully";
    } else {
        // If no rows were affected, display message
        echo "No records were changed";
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    // If required fields are missing, display error message
    echo "Error: Required fields are missing.";
}

// Close the database connection
mysqli_close($con);
?>
