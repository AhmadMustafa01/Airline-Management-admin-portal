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
            width: 30%;
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
                            <a href="../php/adminaddflight.php" class="list-group-item list-group-item-action active">Add a Flight</a>
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
                        <!-- Form to add a new flight -->
                        <div class="container mt-5">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title text-center mb-4">Add New Flight</h3>
                                            <form method="POST" action="">
                                                <div class="form-group">
                                                    <label for="flightNo">Flight No:</label>
                                                    <input type="text" class="form-control" id="flightNo" name="flightNo" pattern="^AAA\d{3}$" title="Please enter a valid Flight No starting with AAA and followed by 3 digits" maxlength="6" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="origin">Origin:</label>
                                                    <input type="text" class="form-control" id="origin" name="origin" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="destination">Destination:</label>
                                                    <input type="text" class="form-control" id="destination" name="destination" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="day">Day of the Week:</label>
                                                    <select class="form-control" id="day" name="day">
                                                        <option value="Sunday">Sunday</option>
                                                        <option value="Monday">Monday</option>
                                                        <option value="Tuesday">Tuesday</option>
                                                        <option value="Wednesday">Wednesday</option>
                                                        <option value="Thursday">Thursday</option>
                                                        <option value="Friday">Friday</option>
                                                        <option value="Saturday">Saturday</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="departureTime">Departure Time:</label>
                                                    <input type="number" class="form-control" id="departureTime" name="departureTime" min="0" max="23" step="1" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="arrivalTime">Arrival Time:</label>
                                                    <input type="number" class="form-control" id="arrivalTime" name="arrivalTime" min="0" max="23" step="1" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="economyPrice">Economy Price:</label>
                                                    <input type="number" class="form-control" id="economyPrice" name="economyPrice" min="0" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="businessPrice">Business Price:</label>
                                                    <input type="number" class="form-control" id="businessPrice" name="businessPrice" min="0" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block mt-5">Add Flight</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $flightNo = $_POST['flightNo'];
                        
                            // Check if the Flight No exists in the database
                            $sql_check = "SELECT flight_no FROM flights WHERE flight_no = '$flightNo'";
                            $result_check = $conn->query($sql_check);
                        
                            if ($result_check->num_rows > 0) {
                                echo "<script>alert('Flight No already exists in the database');</script>";
                            } else {
                                // Flight No is available, insert data into the database
                                $origin = $_POST['origin'];
                                $destination = $_POST['destination'];
                                $day = $_POST['day'];
                                $departureTime = $_POST['departureTime'];
                                $arrivalTime = $_POST['arrivalTime'];
                                $economyPrice = $_POST['economyPrice'];
                                $businessPrice = $_POST['businessPrice'];
                        
                                $sql_insert = "INSERT INTO flights (flight_no, origin, destination, day, departure_time, arrival_time, economy_price, business_price) VALUES ('$flightNo', '$origin', '$destination', '$day', $departureTime, $arrivalTime, $economyPrice, $businessPrice)";
                        
                                if ($conn->query($sql_insert) === TRUE) {
                                    echo "<script>alert('Flight added successfully!')</script>";
                                } else {
                                    echo "Error: " . $sql_insert . "<br>" . $conn->error;
                                }
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
