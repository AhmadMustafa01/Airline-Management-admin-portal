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
            width: 120px; 
            padding-left: 5px;
        }

        .form-control.two {
            width: 170px;
            padding-left: 5px;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: none;
        }

        .col-md-10.bg-white.p-3 {
            min-height: 600px;
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
                            <a href="../php/adminviewflights.php" class="list-group-item list-group-item-action active">View Flights</a>
                            <!-- Add a Flight -->
                            <a href="../php/adminaddflight.php" class="list-group-item list-group-item-action">Add a Flight</a>
                            <!-- Update a Flight -->
                            <a href="../php/adminupdateflight.php" class="list-group-item list-group-item-action">Update a Flight</a>
                            <!-- Delete a Flight -->
                            <a href="../php/admindeleteflight.php" class="list-group-item list-group-item-action">Delete a Flight</a>
                            <!-- View Bookings -->
                            <a href="../php/adminviewbookings.php" class="list-group-item list-group-item-action">View Bookings</a>
                        </div>
                    </div>
                    <!-- White background for content -->
                    <div class="col-md-10 bg-white p-3">
                        <!-- Form to select a day and sort by -->
                        <form method="GET">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="daySelect">Select Day:</label>
                                    <select class="form-control" id="daySelect" name="selectedDay">
                                        <option value="all" <?php if(isset($_GET['selectedDay']) && $_GET['selectedDay'] === 'all') echo 'selected'; ?>>All Flights</option>
                                        <option value="sunday" <?php if(isset($_GET['selectedDay']) && $_GET['selectedDay'] === 'sunday') echo 'selected'; ?>>Sunday</option>
                                        <option value="monday" <?php if(isset($_GET['selectedDay']) && $_GET['selectedDay'] === 'monday') echo 'selected'; ?>>Monday</option>
                                        <option value="tuesday" <?php if(isset($_GET['selectedDay']) && $_GET['selectedDay'] === 'tuesday') echo 'selected'; ?>>Tuesday</option>
                                        <option value="wednesday" <?php if(isset($_GET['selectedDay']) && $_GET['selectedDay'] === 'wednesday') echo 'selected'; ?>>Wednesday</option>
                                        <option value="thursday" <?php if(isset($_GET['selectedDay']) && $_GET['selectedDay'] === 'thursday') echo 'selected'; ?>>Thursday</option>
                                        <option value="friday" <?php if(isset($_GET['selectedDay']) && $_GET['selectedDay'] === 'friday') echo 'selected'; ?>>Friday</option>
                                        <option value="saturday" <?php if(isset($_GET['selectedDay']) && $_GET['selectedDay'] === 'saturday') echo 'selected'; ?>>Saturday</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="sortSelect">Sort by:</label>
                                    <select class="form-control two" id="sortSelect" name="sortBy">
                                        <option value="flight_no" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === 'flight_no') echo 'selected'; ?>>Flight No</option>
                                        <option value="origin" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === 'origin') echo 'selected'; ?>>Origin</option>
                                        <option value="destination" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === 'destination') echo 'selected'; ?>>Destination</option>
                                        <option value="departure_time" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === 'departure_time') echo 'selected'; ?>>Departure Time</option>
                                        <option value="arrival_time" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === 'arrival_time') echo 'selected'; ?>>Arrival Time</option>
                                        <option value="economy_price" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === 'economy_price') echo 'selected'; ?>>Economy Price</option>
                                        <option value="business_price" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === 'business_price') echo 'selected'; ?>>Business Price</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>

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

                        // Display flights table
                        if (isset($_GET['selectedDay'])) {
                            $selectedDay = $_GET['selectedDay'];

                            // Set default sorting criteria
                            $sortCriteria = 'flight_no'; // Default sort by Flight No

                            // Check if a sort criteria is selected
                            if (isset($_GET['sortBy'])) {
                                $sortCriteria = $_GET['sortBy'];
                            }

                            // Fetch flights based on the selected day or fetch all flights if 'all' is selected
                            $sql_display = ($selectedDay !== 'all') ? "SELECT * FROM flights WHERE DAY = '$selectedDay' ORDER BY $sortCriteria ASC" : "SELECT * FROM flights ORDER BY $sortCriteria ASC";

                            // Execute the modified query and display the results
                            $result = $conn->query($sql_display);

                            // Set the timezone to Pakistan (PKT, UTC+5)
                            date_default_timezone_set('Asia/Karachi');

                            echo "<div class='table-responsive mt-4'>
                                    <table class='table table-striped table-bordered'>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Flight No</th>
                                                <th>Origin</th>
                                                <th>Destination</th>
                                                <th style='width: 150px;'>Departure Time</th>
                                                <th>Arrival Time</th>
                                                <th>Flight Status</th>
                                                <th>Economy</th>
                                                <th>Business</th>
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

                                    // Append "Rs" after each price value for Economy and Business
                                    $economy_price = "Rs " . $row["economy_price"];
                                    $business_price = "Rs " . $row["business_price"];

                                    // Output the flight status along with other flight details
                                    echo "<tr>
                                            <td>" . $row["flight_no"] . "</td>
                                            <td>" . $row["origin"] . "</td>
                                            <td>" . $row["destination"] . "</td>
                                            <td>$departure_time</td>
                                            <td>$arrival_time</td>
                                            <td>$flight_status</td>
                                            <td>$economy_price</td>
                                            <td>$business_price</td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr>
                                        <td colspan='6'>0 results</td>
                                    </tr>";
                            }

                            echo "</tbody></table></div>";
                        }

                        $conn->close();
                        ?>
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
