<!DOCTYPE html>
<html>
<head>
    <title>Delete Customer</title>
    <link rel="stylesheet" href="DeleteCustomer.css">
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
            <li><a href="amendview.html.php">Amend/View a Person</a></li>
            <li><a href="cancelbooking.html.php">Cancel Booking</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="customer-info-container"> 
        <div class="customer-info-heading">
            <h2>Customer Information</h2>
        </div>

        <!-- Include listbox to select customer -->
        <?php include 'listbox.php'; ?>

        <!-- JavaScript functions for populating and confirming deletion -->
        <script>
           function populate() {
               var sel = document.getElementById("listbox");
               var result = sel.options[sel.selectedIndex].value;
               var personDetails = result.split(',');
               var customerId = personDetails[0]; // get customerID from result

               document.getElementById("display").innerHTML = "The details of the selected customer are: " + result;
               
               // Set the value 
               document.getElementById("customerID").value = customerId;
           }

           function confirmDelete() {
               return confirm('Are you sure you want to delete this customer?');
           }
        </script>

        <!-- Customer details -->
        <p id="display"></p>

        <!-- Form for submitting deletion -->
        <form name="myForm" action="DeleteCustomer.php" onsubmit="return confirmDelete()" method="post">
            <input type="hidden" name="customerID" id="customerID">
            <input type="submit" value="Delete Customer">
        </form>

        <!-- Form for the previous screen -->
        <form action="DeleteCustomer.html.php" method="post">
            <input type="submit" value="Return to Previous Screen"> 
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Dorys Motors. All rights reserved.</p>
    </footer>

</body>
</html>
