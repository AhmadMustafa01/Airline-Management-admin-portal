<?php include 'bookingfunctions.php'; ?>

<!-- Processing booking requests -->
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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['flight_no']) && isset($_GET['flight_date']) && isset($_GET['fight_class'])) {
    $flight_no = $_GET['flight_no'];
    $flight_date = $_GET['flight_date'];
    $flight_class = $_GET['fight_class'];

    //echo "Flight No: " . $flight_no . "<br>";
    //echo "Flight Date: " . $flight_date . "<br>";
    //echo "Flight Class: " . $flight_class . "<br>";

    // Generate a unique booking reference
    $booking_reference = generateBookingReference($conn);
    //echo "Booking Reference: " . $booking_reference;

    // SQL query to insert data into the booking table
    $sql_insert = "INSERT INTO booking (booking_reference, flight_no, flight_date, fight_class) 
            VALUES ('$booking_reference', '$flight_no', '$flight_date', '$flight_class')";

    if ($conn->query($sql_insert) === TRUE) {
        //echo "New record created successfully";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
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

    <!--Passenger details-->
    <div class = "container col-md-10 bg-white p-5">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4 mt-2">Passenger Details</h3>
                    <form method="POST" action="../php/payment.php">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label>Gender:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" pattern="[0-9]{11}" required>
                            <small id="phoneNumberHelp" class="form-text text-muted">Please enter 11 digits.</small>
                        </div>
                        <input type="hidden" name="bookingReference" value="<?php echo $booking_reference; ?>">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
</body>
</html>
