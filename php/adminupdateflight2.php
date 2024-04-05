<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbmsdatabases";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if flight number exists in the database
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['flightNo'])) {
    $currentFlightNo = $_GET['flightNo'];
    //echo $currentFlightNo;

    // Retrieve original flight details from the database
    $sql_select = "SELECT * FROM flights WHERE flight_no = '$currentFlightNo'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Store original details in variables
            $originalFlightNo = $row['flight_no'];
            $originalOrigin = $row['origin'];
            $originalDestination = $row['destination'];
            $originalDay = $row['day'];
            $originalDepartureTime = $row['departure_time'];
            $originalArrivalTime = $row['arrival_time'];
            $originalEconomyPrice = $row['economy_price'];
            $originalBusinessPrice = $row['business_price'];
        }
    } else {
        echo "no results";
    }
}

// Handle the form submission for updating flight details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flightNo'])) {
    $currentFlightNo = $_GET['flightNo'];

    // Collect new flight details from the form
    $newFlightNo = $_POST['flightNo'];
    $newOrigin = $_POST['origin'];
    $newDestination = $_POST['destination'];
    $newDay = $_POST['day'];
    $newDepartureTime = $_POST['departureTime'];
    $newArrivalTime = $_POST['arrivalTime'];
    $newEconomyPrice = $_POST['economyPrice'];
    $newBusinessPrice = $_POST['businessPrice'];

    // Update the flight details in the database
    $updateSql = "UPDATE flights SET 
                flight_no = '$newFlightNo',
                origin = '$newOrigin',
                destination = '$newDestination',
                day = '$newDay',
                departure_time = '$newDepartureTime',
                arrival_time = '$newArrivalTime',
                economy_price = '$newEconomyPrice',
                business_price = '$newBusinessPrice'
                WHERE flight_no = '$currentFlightNo'";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Flight details updated successfully!');</script>";
        echo "<script>window.location.href = '../php/adminviewflights.php';</script>";
        exit();
    } else {
        echo "Error updating flight details: " . $conn->error;
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character set and viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title of the page -->
    <title>AAA Airlines - Home</title>

    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="../css/airline.css">
    <link rel="stylesheet" href="../css/admin.css">

    <style>
        .form-control {
            width: 200px; 
            padding-left: 5px;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: none;
        }

        .btn-primary {
            width: 40%;
        }

        .col-md-10.bg-white.p-3 {
            min-height: 500px;
        }

    </style>
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">AAA Airlines</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../html/home.html">Home</a>
                </li>

                <!-- Dropdown "Book" tab with three options -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Book
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="bookflight.html">Book a Flight</a>
                        <a class="dropdown-item" href="#">Manage Bookings</a>
                        <a class="dropdown-item" href="#">My Bookings</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../php/flights.php">Flights</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                
                <!-- Profile icon with dropdown -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img src="../media/profile-icon.png" alt="Profile Icon" class="img-fluid profile-icon">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                      <a class="dropdown-item" href="..\html\signin.html">Login User</a>
                      <a class="dropdown-item" href="..\html\signup.html">Create Account</a>
                      <a class="dropdown-item" href="..\php\adminsignin.php">Admin</a>
                  </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Admin Dashboard -->
    <div class="container-fluid mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="row">
                    <!-- Side Panel -->
                    <div class="col-md-2">
                        <div class="list-group">
                            <!-- Sidebar items -->
                            <!-- View Flights -->
                            <a href="../php/adminviewflights.php" class="list-group-item list-group-item-action">View Flights</a>
                            <!-- Add a Flight -->
                            <a href="../php/adminaddflight.php" class="list-group-item list-group-item-action">Add a Flight</a>
                            <!-- Update a Flight -->
                            <a href="../php/adminupdateflight.php" class="list-group-item list-group-item-action active">Update a Flight</a>
                            <!-- Delete a Flight -->
                            <a href="../php/admindeleteflight.php" class="list-group-item list-group-item-action">Delete a Flight</a>
                            <!-- View Bookings -->
                            <a href="../php/adminviewbookings.php" class="list-group-item list-group-item-action">View Bookings</a>
                        </div>
                    </div>
                    <!-- White background for content -->
                    <div class="col-md-10 bg-white p-3">
                        <!-- Form to update flight -->
                        <div class="container mt-5">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title text-center mb-4">Update Flight</h3>
                                            <form method="POST" action="">
                                                <div class="form-group">
                                                    <label for="flightNo">Flight No:</label>
                                                    <input type="text" class="form-control" id="flightNo" name="flightNo" pattern="^AAA\d{3}$" title="Please enter a valid Flight No starting with AAA and followed by 3 digits" maxlength="6" required placeholder="<?php echo $originalFlightNo; ?>" value="<?php echo $originalFlightNo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="origin">Origin:</label>
                                                    <input type="text" class="form-control" id="origin" name="origin" required placeholder="<?php echo $originalOrigin; ?>" value="<?php echo $originalOrigin; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="destination">Destination:</label>
                                                    <input type="text" class="form-control" id="destination" name="destination" required placeholder="<?php echo $originalDestination; ?>" value="<?php echo $originalDestination; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="day">Day of the Week:</label>
                                                    <select class="form-control" id="day" name="day">
                                                        <option value="Sunday" <?php if($originalDay == 'Sunday') echo 'selected'; ?>>Sunday</option>
                                                        <option value="Monday" <?php if($originalDay == 'Monday') echo 'selected'; ?>>Monday</option>
                                                        <option value="Tuesday" <?php if($originalDay == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                                                        <option value="Wednesday" <?php if($originalDay == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                                                        <option value="Thursday" <?php if($originalDay == 'Thursday') echo 'selected'; ?>>Thursday</option>
                                                        <option value="Friday" <?php if($originalDay == 'Friday') echo 'selected'; ?>>Friday</option>
                                                        <option value="Saturday" <?php if($originalDay == 'Saturday') echo 'selected'; ?>>Saturday</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="departureTime">Departure Time:</label>
                                                    <input type="number" class="form-control" id="departureTime" name="departureTime" min="0" max="23" step="1" required placeholder="<?php echo $originalDepartureTime; ?>" value="<?php echo $originalDepartureTime; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="arrivalTime">Arrival Time:</label>
                                                    <input type="number" class="form-control" id="arrivalTime" name="arrivalTime" min="0" max="23" step="1" required placeholder="<?php echo $originalArrivalTime; ?>" value="<?php echo $originalArrivalTime; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="economyPrice">Economy Price:</label>
                                                    <input type="number" class="form-control" id="economyPrice" name="economyPrice" min="0" required placeholder="<?php echo $originalEconomyPrice; ?>" value="<?php echo $originalEconomyPrice; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="businessPrice">Business Price:</label>
                                                    <input type="number" class="form-control" id="businessPrice" name="businessPrice" min="0" required placeholder="<?php echo $originalBusinessPrice; ?>" value="<?php echo $originalBusinessPrice; ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block mt-5">Update Flight</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Contact Us section -->
    <section class="contact-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Contact Us</h3>
                    <div class="contact-info">
                        <a href="#">Facebook</a>
                        <a href="#">Twitter</a>
                        <a href="#">Instagram</a>
                    </div>
                    <div class="contact-info">
                        <span>Phone: +1234567890</span>
                        <br/>
                        <span>Email: contact@aaaairlines.com</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light text-center p-3">
        &copy; 2023 AAA Airlines
    </footer>

    <!-- Bootstrap JavaScript scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript file -->
    <script src="custom.js"></script>
</body>
</html>
