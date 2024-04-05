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

// Fetch distinct origin cities from the flights table
$originQuery = "SELECT DISTINCT origin FROM flights ORDER BY origin ASC";
$originResult = $conn->query($originQuery);

// Fetch distinct destination cities from the flights table
$destinationQuery = "SELECT DISTINCT destination FROM flights ORDER BY destination ASC";
$destinationResult = $conn->query($destinationQuery);

$originOptions = '';
$destinationOptions = '';

$defaultOrigin = 'Lahore';
$defaultDestination = 'Islamabad';

$originOptions .= '<option value="" disabled selected>Select Origin</option>';
$destinationOptions .= '<option value="" disabled selected>Select Destination</option>';

if ($originResult->num_rows > 0) {
    while ($row = $originResult->fetch_assoc()) {
        $selected = ($row['origin'] === $defaultOrigin) ? 'selected' : '';
        $originOptions .= '<option value="' . $row['origin'] . '" ' . $selected . '>' . $row['origin'] . '</option>';
    }
}

if ($destinationResult->num_rows > 0) {
    while ($row = $destinationResult->fetch_assoc()) {
        $selected = ($row['destination'] === $defaultDestination) ? 'selected' : '';
        $destinationOptions .= '<option value="' . $row['destination'] . '" ' . $selected . '>' . $row['destination'] . '</option>';
    }
}

// Close the database connection
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 50px 50px;
            width: 60%;
        }

        .card-body {
            padding: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #003c7d;
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

    <!--Book a flight-->
    <div class = "container col-md-10 bg-white p-5">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4 mt-2">Book a Flight</h3>
                    <form method="POST" action="../php/bookflight.php" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="origin">Select Origin:</label>
                            <select class="form-control" id="origin" name="origin" required>
                                <?php echo $originOptions; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="destination">Select Destination:</label>
                            <select class="form-control" id="destination" name="destination" required>
                                <?php echo $destinationOptions; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="departureDate">Departure Date:</label>
                            <input type="date" id="departureDate" name="departureDate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="flightClass">Flight Class:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flightClass" id="economyClass" value="Economy" checked required>
                                <label class="form-check-label" for="economyClass">Economy Class</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flightClass" id="businessClass" value="Business" required>
                                <label class="form-check-label" for="businessClass">Business Class</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Search FLight</button>
                    </form>
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

    <script>
    function validateForm() {
        var origin = document.getElementById("origin").value;
        var destination = document.getElementById("destination").value;

        if (origin === destination) {
            alert("Origin and destination cities cannot be the same!");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
    </script>
</body>
</html>
