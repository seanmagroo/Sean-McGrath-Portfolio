<!DOCTYPE html>
<html>
<head>
    <title>Cancel Booking</title>
    <link rel="stylesheet" type="text/css" href="cancel.css">
</head>
<body>
    <!-- Header -->
    <header>
        <img src="garage-logo-png-8.png" class="logo" alt="Logo">
    </header>

    <!-- Navigation -->
    <nav>
        <ul>
            <li><a href="homepage.html">Homepage</a></li>
            <li><a href="AddCustomer.html">Add a Customer</a></li>
            <li><a href="DeleteCustomer.html.php">Delete a Customer</a></li>
            <li><a href="amendview.html.php">Amend/View a Person</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main>
        <h1>Cancel Booking</h1>
        <?php
        // Get today's date in YYYY-MM-DD format
        $today = date('Y-m-d');
        // Check if the date has been set via POST, otherwise use today
        $selectedDate = isset($_POST['date']) ? $_POST['date'] : $today;
        ?>
        <form action="cancelbooking.html.php" method="post">
            <div class="input-group">
                <label for="date">Select Date:</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($selectedDate); ?>" required>
                <button type="submit">Show Bookings</button>
            </div>
        </form>

        <?php if (isset($_POST['date'])): ?>
            <?php
            // Include database connection
            include 'db.inc.php';

            $slots = [];
            $startTime = new DateTime('09:00');
            $endTime = new DateTime('17:00');
            $interval = new DateInterval('PT30M'); // 30 minutes

            while ($startTime < $endTime) {
                $endInterval = clone $startTime;
                $endInterval->add($interval);
                $slots[] = [
                    'start' => $startTime->format('H:i'),
                    'end' => $endInterval->format('H:i')
                ];
                $startTime->add($interval);
            }
            ?>

            <form action="cancelbooking.php" method="post">
                <input type="hidden" name="date" value="<?php echo htmlspecialchars($selectedDate); ?>">
                <table>
                    <thead>
                        <tr>
                            <th>Time Slot</th>
                            <th>Customer</th>
                            <th>Cancel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($slots as $slot): ?>
                            <?php
                            $query = "SELECT B.BookingID, C.Name
                                      FROM Booking B
                                      JOIN Customer C ON B.CustomerID = C.CustomerID
                                      WHERE B.BookingDate = ? AND B.StartTime = ? AND B.DeletedFlag = 0";
                            $stmt = $con->prepare($query);
                            $stmt->bind_param('ss', $selectedDate, $slot['start']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $customerName = $row ? $row['Name'] : 'Not Allocated';
                            $bookingID = $row ? $row['BookingID'] : '';
                            ?>

                            <tr>
                                <td><?php echo $slot['start'] . ' - ' . $slot['end']; ?></td>
                                <td><?php echo htmlspecialchars($customerName); ?></td>
                                <td>
                                    <?php if ($row): ?>
                                        <input type="checkbox" name="cancel_booking[]" value="<?php echo htmlspecialchars($bookingID); ?>">
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" name="cancel">Cancel Selected Bookings</button>
            </form>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Dorys Motors. All rights reserved.</p>
    </footer>
</body>
</html>
