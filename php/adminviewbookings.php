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
                            <a href="../php/adminviewflights.php" class="list-group-item list-group-item-action">View Flights</a>
                            <!-- Add a Flight -->
                            <a href="../php/adminaddflight.php" class="list-group-item list-group-item-action">Add a Flight</a>
                            <!-- Update a Flight -->
                            <a href="../php/adminupdateflight.php" class="list-group-item list-group-item-action">Update a Flight</a>
                            <!-- Delete a Flight -->
                            <a href="../php/admindeleteflight.php" class="list-group-item list-group-item-action">Delete a Flight</a>
                            <!-- View Bookings -->
                            <a href="../php/adminviewbookings.php" class="list-group-item list-group-item-action active">View Bookings</a>
                        </div>
                    </div>
                    <!-- White background for content -->
                    <div class="col-md-10 bg-white p-3">
                        <!-- Form to select filters -->
                        <form method="GET">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="sortSelect">Sort By:</label>
                                    <select class="form-control" id="filterSelect" name="selectedFilter">
                                        <option value="ticket_no">Ticket Number</option>
                                        <option value="booking_reference">Booking Reference</option>
                                        <option value="first_name">First Name</option>
                                        <option value="last_name">Last Name</option>
                                        <option value="flight_no">Flight Number</option>
                                        <option value="origin">Origin</option>
                                        <option value="destination">Destination</option>
                                        <option value="flight_date">Flight Date</option>
                                        <option value="fight_class">Flight Class</option>
                                        <option value="phone_number">Phone Number</option>
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

                        // Display booking info
                        if (isset($_GET['selectedFilter'])) {
                            $selectedFilter = $_GET['selectedFilter'];

                            // Query to retrieve attributes from multiple tables using JOIN
                            $query = "SELECT p.ticket_no, b.booking_reference, p.first_name, p.last_name, b.flight_no, f.origin, f.destination, b.flight_date, b.fight_class, p.phone_number
                                    FROM passenger p
                                    JOIN booking b ON p.booking_reference = b.booking_reference
                                    JOIN flights f ON b.flight_no = f.flight_no
                                    ORDER BY $selectedFilter ASC";

                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                            echo "<div class='table-responsive mt-4'>
                            <table class='table table-striped table-bordered'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>Ticket No</th>
                                        <th>Booking Reference</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Flight No</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th style='width: 150px;'>Flight Date</th>
                                        <th>Flight Class</th>
                                        <th>Phone Number</th>
                                    </tr>
                                </thead>
                                <tbody>";

                            while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["ticket_no"] . "</td>
                                <td>" . $row["booking_reference"] . "</td>
                                <td>" . $row["first_name"] . "</td>
                                <td>" . $row["last_name"] . "</td>
                                <td>" . $row["flight_no"] . "</td>
                                <td>" . $row["origin"] . "</td>
                                <td>" . $row["destination"] . "</td>
                                <td>" . $row["flight_date"] . "</td>
                                <td>" . $row["fight_class"] . "</td>
                                <td>" . $row["phone_number"] . "</td>
                            </tr>";
                            }
                                echo "</tbody></table></div>";
                            } else {
                                echo "0 results";
                            }
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
