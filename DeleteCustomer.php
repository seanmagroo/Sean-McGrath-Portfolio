<?php
include 'db.inc.php';

if (isset($_POST['customerID'])) {
    $customerID = $_POST['customerID'];

    // Update the Booking table to mark all associated bookings as deleted
    $sql = "UPDATE Booking SET DeletedFlag = 1 WHERE CustomerID = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $customerID);
    mysqli_stmt_execute($stmt);

    // Now update the Customer table to mark the customer as deleted
    $sql = "UPDATE Customer SET DeletedFlag = 1 WHERE customerid = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $customerID);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($con) > 0) {
        echo "Customer and associated bookings marked as deleted successfully.";
    } else {
        echo "No customer or bookings were deleted.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error: Required fields are missing.";
}

mysqli_close($con);
?>
