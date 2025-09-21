<?php
// Include database connection
include 'db.inc.php';

if (isset($_POST['cancel'])) {
    $selectedDate = $_POST['date'];
    $cancelBookings = isset($_POST['cancel_booking']) ? $_POST['cancel_booking'] : [];

    if (empty($cancelBookings)) {
        echo "No bookings selected for cancellation.";
        exit;
    }

    // Check if any selected bookings have already started
    $now = new DateTime();
    foreach ($cancelBookings as $bookingID) {
        $query = "SELECT StartTime FROM Booking WHERE BookingID = ? AND BookingDate = ? AND DeletedFlag = 0";
        $stmt = $con->prepare($query);
        $stmt->bind_param('is', $bookingID, $selectedDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();

        if ($booking) {
            $bookingStartTime = new DateTime($booking['StartTime']);
            if ($bookingStartTime < $now) {
                echo "Cannot cancel booking with ID $bookingID as it has already started.";
                exit;
            }
        }
    }

    // Proceed with cancellation
    $query = "UPDATE Booking SET DeletedFlag = 1 WHERE BookingID = ? AND BookingDate = ?";
    $stmt = $con->prepare($query);

    foreach ($cancelBookings as $bookingID) {
        $stmt->bind_param('is', $bookingID, $selectedDate);
        $stmt->execute();
    }

    echo "Selected bookings have been successfully cancelled.";
}

$con->close();
?>
