<?php
// Include database configuration file
include "db.inc.php";

// SQL query to select customer information
$sql = "SELECT name, address, email, phonenumber, customerID, DeletedFlag FROM Customer WHERE DeletedFlag = 0;";
// Execute the SQL query
$result = mysqli_query($con, $sql);

// Check query was successful
if (!$result) {
    // If query fails, display error message and terminate execution
    die('Error in querying database' . mysqli_error($con));
}

// Start the select dropdown menu
echo "<br><select name='listbox' id='listbox' onchange='populate()'>";
echo "<option disabled selected>Select Customer</option>"; 

while ($row = mysqli_fetch_array($result)) {
    // Retrieve customer information 
    $name = $row['name'];
    $address = $row['address'];
    $email = $row['email'];
    $phonenumber = $row['phonenumber'];
    $customerID = $row['customerID'];
    // Combine all information
    $allText = "$customerID|$name|$address|$email|$phonenumber";
    // Add an option to the select dropdown menu with the customer's name as the display text and all information as the value
    echo "<option value='$allText'>$name</option>";
}

// Close the select dropdown menu
echo "</select>";

// Close the database connection
mysqli_close($con);
?>
