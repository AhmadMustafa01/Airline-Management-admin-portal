<?php
//session_start(); // Start the session if not started already

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbmsdatabases";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST data is available
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $phoneNumber = $_POST['phoneNumber'];
    $bookingReference = $_POST['bookingReference'];
    $totalPrice = $_POST['totalPrice']; // Retrieve total price from the form

    // Check if the booking reference already exists in the passenger table
    $checkQuery = "SELECT * FROM passenger WHERE booking_reference = '$bookingReference'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows === 0) {
        // Insert values into the passenger table
        $insertQuery = "INSERT INTO passenger (booking_reference, first_name, last_name, gender, phone_number) 
                        VALUES ('$bookingReference', '$firstName', '$lastName', '$gender', '$phoneNumber')";

        if ($conn->query($insertQuery) === TRUE) {
            //echo "Passenger details inserted successfully!";
        } else {
            echo "Error inserting passenger details: " . $conn->error;
        }
    } else {
        //echo "Passenger with the same booking reference already exists.";
    }

    // Query to retrieve ticket details based on the provided POST data
    $query = "SELECT b.booking_reference, b.flight_no, f.origin, f.destination, f.departure_time, f.arrival_time, p.first_name, p.last_name, b.flight_date, b.fight_class, p.ticket_no
    FROM booking b
    JOIN flights f ON b.flight_no = f.flight_no
    JOIN passenger p ON b.booking_reference = p.booking_reference
    WHERE p.booking_reference = '$bookingReference'"; // Modify this query to fetch specific ticket details

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Assign retrieved data to variables
            $ticketNumber = $row['ticket_no'];
            $dateIssued = date("d/m/Y"); // Get current date as date issued in dd/mm/yyyy format
            $passengerName = $row['first_name'] . ' ' . $row['last_name'];
            $flightNumber = $row['flight_no'];
            $flightDate = $row['flight_date'];
            $flightClass = $row['fight_class'];
            $originCity = $row['origin'];
            $destinationCity = $row['destination'];
            $departureHour = $row['departure_time'];
            $arrivalHour = $row['arrival_time'];
            $bookingReference = $row['booking_reference'];
        }

        // Format departure and arrival times into AM/PM
        $departureTime = ($departureHour >= 12) ? ($departureHour == 12 ? $departureHour : $departureHour - 12) . "pm" : ($departureHour == 0 ? 12 : $departureHour) . "am";
        $arrivalTime = ($arrivalHour >= 12) ? ($arrivalHour == 12 ? $arrivalHour : $arrivalHour - 12) . "pm" : ($arrivalHour == 0 ? 12 : $arrivalHour) . "am";
    } else {
        echo "No results found";
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

    <style>
        .col-md-10.bg-white {
            min-height: 600px;
        }

        .card {
            border: 1px solid #9f9f9f;
            width: 70%;
            margin: auto 0;
        }

        .darker-hr {
            border: 1px solid;
            opacity: 0.2;
        }

        .custom-col {
            text-align: left;
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

    <!--Ticket Section-->
    <div class = "container col-md-10 bg-white p-5">
        <div class="row">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Ticket No: <span id="ticketNumber"><?php echo $ticketNumber; ?></span></h4>
                <div class="row">
                    <div class="col-sm-6">
                        <h5><i>AAA Airlines</i></h5>
                    </div>
                    <div class="col-sm-3">
                        <h5>Date Issued:</h5>
                    </div>
                    <div class="col-sm-3 custom-col">
                        <span id="dateIssued"><?php echo $dateIssued; ?></span>
                    </div>
                </div>
                <br/>
                <p class="card-text">
                    <div class="row">
                        <div class="col-sm-3"><b>Passenger:</b></div>
                        <div class="col-sm-6"><span id="passengerName"><?php echo $passengerName; ?></span></div>
                    </div>
                </p>
                <hr class="darker-hr">
                <p class="card-text">
                    <div class="row">
                        <div class="col-sm-3"><b>Flight No:</b></div>
                        <div class="col-sm-6"><span id="flightNumber"><?php echo $flightNumber; ?></span></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><b>Flight Date:</b></div>
                        <div class="col-sm-6"><span id="flightDate"><?php echo $flightDate; ?></span></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><b>Flight class:</b></div>
                        <div class="col-sm-6"><span id="flightClass"><?php echo $flightClass; ?></span></div>
                    </div>
                </p>
                <hr class="darker-hr">
                <p class="card-text">
                    <div class="row">
                        <div class="col-sm-3"><b>Origin:</b></div>
                        <div class="col-sm-3"><span id="originCity"><?php echo $originCity; ?></span></div>
                        <div class="col-sm-3"><span id="departureTime"><?php echo $departureTime; ?></span></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><b>Destination:</b></div>
                        <div class="col-sm-3"><span id="destinationCity"><?php echo $destinationCity; ?></span></div>
                        <div class="col-sm-3"><span id="arrivalTime"><?php echo $arrivalTime; ?></span></div>
                    </div>
                </p>
                <hr class="darker-hr">
                <p class="card-text">
                    <div class="row">
                        <div class="col-sm-4"><b>Booking Reference:</b></div>
                        <div class="col-sm-3"><span id="bookingReference"><?php echo $bookingReference; ?></span></div>
                    </div>
                </p>
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
