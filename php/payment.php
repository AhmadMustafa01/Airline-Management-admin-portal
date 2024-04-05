<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbmsdatabases";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$totalPrice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Calculate and display total price

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $phoneNumber = $_POST['phoneNumber'];
    $bookingReference = $_POST['bookingReference'];

    // echo "First Name: " . $firstName . "<br>";
    // echo "Last Name: " . $lastName . "<br>";
    // echo "Gender: " . $gender . "<br>";
    // echo "Phone Number: " . $phoneNumber . "<br>";
    // echo "Booking Reference: " . $bookingReference . "<br>";

    // Retrieve the flight_no and flight_class from the booking table based on booking_reference
    $sqlBooking = "SELECT flight_no, fight_class FROM booking WHERE booking_reference = '$bookingReference'";
    $resultBooking = $conn->query($sqlBooking);

    if ($resultBooking !== false && $resultBooking->num_rows > 0) {
        $rowBooking = $resultBooking->fetch_assoc();
        $flightNo = $rowBooking['flight_no'];
        $flightClass = $rowBooking['fight_class'];
        // echo "Flight No: " . $flightNo . "<br>";
        // echo "Flight Class: " . $flightClass . "<br>";

        // Fetch the price based on the class for the given flight number
        if ($flightClass === 'Economy') {
            $priceColumn = 'economy_price';
        } elseif ($flightClass === 'Business') {
            $priceColumn = 'business_price';
        }

        // Retrieve the price from the flights table based on flight_no and flight_class
        $sqlPrice = "SELECT $priceColumn AS price FROM flights WHERE flight_no = '$flightNo'";
        $resultPrice = $conn->query($sqlPrice);

        if ($resultPrice !== false && $resultPrice->num_rows > 0) {
            $rowPrice = $resultPrice->fetch_assoc();
            $totalPrice = $rowPrice['price']; // Set the total price
        } else {
            $totalPrice = "Price information not found for the selected flight.";
        }
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 50px 50px;
            width: 40%;
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

    <!--Payment section-->
    <div class = "container col-md-10 bg-white p-5">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-5 mt-2">Payment</h3>
                    <form method="POST" action="../php/ticket.php">
                        <?php if (!empty($totalPrice)) { ?>
                            <h5>Total Amount: Rs <?php echo $totalPrice; ?></h5>
                            <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
                        <?php } ?>
                        <div class="form-group mt-4">
                            <label for="creditCardNumber">Enter Credit Card Number:</label>
                            <input type="text" class="form-control" id="creditCardNumber" name="creditCardNumber" pattern="\d{5}" title="Please enter a 5-digit number" required>
                        </div>
                        <input type = "hidden" name = "firstName" value = "<?php echo $firstName; ?>">
                        <input type = "hidden" name = "lastName" value = "<?php echo $lastName; ?>">
                        <input type = "hidden" name = "gender" value = "<?php echo $gender; ?>">
                        <input type = "hidden" name = "phoneNumber" value = "<?php echo $phoneNumber; ?>">
                        <input type = "hidden" name = "bookingReference" value = "<?php echo $bookingReference; ?>">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    
    ?>
    
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
