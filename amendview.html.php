<!DOCTYPE html>
<html>
<head>
    <title>Amend/View a Person</title>
    <link rel="stylesheet" type="text/css" href="amendview.css">
</head>
<body>
    
    <!-- Header -->
    <header>
        <img src="garage-logo-png-8.png" class="logo" alt="Garage Logo">
    </header>

    <!-- Navigation -->
    <nav>
        <ul>
            <li><a href="homepage.html">Homepage</a></li>
            <li><a href="AddCustomer.html">Add a Customer</a></li>
            <li><a href="DeleteCustomer.html.php">Delete a Customer</a></li>
            <li><a href="cancelbooking.html.php">Cancel a Booking</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main>
        <h1>Amend/View a Person</h1>
        <h4>Please select a person and then click the amend button if you wish to update</h4>

        <?php include 'listbox.php'; ?>

        <p id="display"></p>
        <input type="button" value="Amend Details" id="amendViewbutton" onclick="toggleEdit()">

        <!-- Form for amending customer details -->
        <form name="myForm" action="amendview.php" onsubmit="return confirmCheck()" method="post">
            <div class="customer-info-container">
                <label for="customerID">Customer Id</label>
                <input type="text" name="customerID" id="customerID" readonly>
            </div>
            <div class="customer-info-container">
                <label for="amendname">Name</label>
                <input type="text" name="amendname" id="amendname" disabled>
            </div>
            <div class="customer-info-container">
                <label for="amendaddress">Address</label>
                <input type="text" name="amendaddress" id="amendaddress" disabled>
            </div>
            <div class="customer-info-container">
                <label for="amendemail">Email</label>
                <input type="text" name="amendemail" id="amendemail" disabled>
            </div>
            <div class="customer-info-container">
                <label for="amendphonenumber">Phone Number</label>
                <input type="text" name="amendphonenumber" id="amendphonenumber" disabled>
            </div>

            <!-- Button group for saving changes and resetting -->
            <div class="button-group">
                <input type="submit" value="Save Changes" class="confirm">
                <input type="reset" value="Reset" class="reset">
            </div>
        </form>

        <!-- Form for returning to the previous screen -->
        <form action="AmendView.html.php" method="post">
            <input type="submit" value="Return to Previous Screen"> 
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Dorys Motors. All rights reserved.</p>
    </footer>

<script>
    // Function to populate input fields with selected customer details
    function populate() {
        var selectedCustomer = document.getElementById("listbox").value.split('|');
        document.getElementById("customerID").value = selectedCustomer[0];
        document.getElementById("amendname").value = selectedCustomer[1];
        document.getElementById("amendaddress").value = selectedCustomer[2];
        document.getElementById("amendemail").value = selectedCustomer[3];
        document.getElementById("amendphonenumber").value = selectedCustomer[4];
    }

    // Function to toggle edit mode for customer details
    function toggleEdit() {
        var inputs = document.querySelectorAll('input[type="text"]');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = !inputs[i].disabled;
        }
    }
</script>

</body>
</html>
