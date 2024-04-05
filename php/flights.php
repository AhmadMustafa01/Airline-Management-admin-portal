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
                      <a class="dropdown-item" href="..\html\admin.html">Admin</a>
                  </div>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Flight Schedule section -->
    <section class="flight-schedule">
    <div class="container mt-5">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";

            // Create connection
            $conn = new mysqli($servername, $username, $password);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                //echo "Connected successfully";
            }

            // Create database
            $sql_create_db = "CREATE DATABASE IF NOT EXISTS dbmsdatabases";

            if ($conn->query($sql_create_db) === TRUE) {
                $conn->select_db("dbmsdatabases");
                //echo "Database created successfully";
            } else {
                echo "Error creating database: " . $conn->error;
            }

            // Set the timezone to Pakistan (PKT, UTC+5)
            date_default_timezone_set('Asia/Karachi');

            // Get the current day (in the format of Thursday, Monday, etc.)
            $current_day = date("l");
            // $current_day = "Monday";

            // Fetching data from the 'flights' table for the current day
            $sql_display = "SELECT * FROM flights WHERE DAY = '$current_day' ORDER BY departure_time ASC, arrival_time ASC";
            $result = $conn->query($sql_display);

            echo "<h3 class='mb-4 text-center'>" . date("l: j F Y") . "<br/>" . "Local Time: " . date("g:ia") . "</h3>";
            echo "<div class='table-responsive'>
                    <table class='table table-striped table-bordered'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Flight No</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th style='width: 150px;'>Departure Time</th>
                                <th>Arrival Time</th>
                                <th>Flight Status</th>
                            </tr>
                        </thead>
                        <tbody>";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Get the current hour in 24-hour format
                    $current_hour = date("H");
                    // $current_hour = 12;

                    // Departure and arrival times from the database (assuming they're in the 24-hour format)
                    $departure_hour = $row["departure_time"];
                    $arrival_hour = $row["arrival_time"];

                    // Format departure and arrival times into AM/PM
                    $departure_time = ($departure_hour >= 12) ? ($departure_hour == 12 ? $departure_hour : $departure_hour - 12) . "pm" : ($departure_hour == 0 ? 12 : $departure_hour) . "am";
                    $arrival_time = ($arrival_hour >= 12) ? ($arrival_hour == 12 ? $arrival_hour : $arrival_hour - 12) . "pm" : ($arrival_hour == 0 ? 12 : $arrival_hour) . "am";

                    // Initialize the flight status variable
                    $flight_status = '';

                    // Determine flight status based on current hour and departure/arrival hours
                    if ($current_hour < $departure_hour) {
                        $flight_status = "On Time"; // More than 1 hour away from departure time
                    } elseif ($current_hour >= $arrival_hour) {
                        $flight_status = "Landed"; // After the arrival time of the flight
                    } elseif ($current_hour >= $departure_hour && $current_hour < $arrival_hour) {
                        $flight_status = "Departed"; // Between departure and arrival time
                    }

                    // Output the flight status along with other flight details
                    echo "<tr>
                            <td>" . $row["flight_no"] . "</td>
                            <td>" . $row["origin"] . "</td>
                            <td>" . $row["destination"] . "</td>
                            <td>$departure_time</td>
                            <td>$arrival_time</td>
                            <td>$flight_status</td>
                        </tr>";
                }
            } else {
                echo "<tr>
                        <td colspan='6'>0 results</td>
                    </tr>";
            }

            echo "</tbody></table></div>";

            $conn->close();
        ?>
    </div>
    </section>


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
