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
        $originalFlightNo = $_GET['flightNo'];

        // Check if the Flight No exists in the database
        $sql_check = "SELECT flight_no FROM flights WHERE flight_no = '$originalFlightNo'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            // Flight No exists, redirect to adminupdateflight2.php
            header("Location: ../php/adminupdateflight2.php?flightNo=$originalFlightNo");
            exit();
        } else {
            // Flight No doesn't exist
            echo "<script>alert('Flight No does not exist in the database');</script>";
        }
    }
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
            width: 50%;
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
                            <a href="../php/adminupdateflight.php" class="list-group-item list-group-item-action active">Update a Flight</a>
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
                                <div class="col-md-6">
                                    <div class="card mt-5">
                                        <div class="card-body">
                                            <h3 class="card-title text-center mb-4">Update a Flight</h3>
                                            <form method="GET" action="">
                                                <div class="form-group">
                                                    <label for="flightNo">Enter Flight No:</label>
                                                    <input type="text" class="form-control" id="flightNo" name="flightNo" pattern="^AAA\d{3}$" title="Please enter a valid Flight No starting with AAA and followed by 3 digits" maxlength="6" required>
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
