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
    <link rel="stylesheet" href="../css/login.css">
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
                        <a class="dropdown-item" href="../php/bookflight.php">Book a Flight</a>
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

    <!--Admin Login Form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="../media/plane.png" alt="User Icon" class="img-fluid mb-4" style="width: 20%;">
                        <h5 class="card-title">Admin Login</h5>
                        <form id="adminLoginForm">
                            <div class="form-group">
                                <input type="password" class="form-control" id="passwordInput" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add an event listener for form submission
        document.getElementById('adminLoginForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            // Get the entered password
            const password = document.getElementById('passwordInput').value;

            // Check if the entered password is 'admin123'
            if (password === 'admin123') {
                // Redirect to the admin dashboard page if the password is correct
                window.location.href = 'adminviewflights.php';
            } else {
                // Inform the user about the incorrect password (you can customize this message)
                alert('Incorrect password. Please try again.');
            }
        });
    </script>


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
