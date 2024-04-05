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

if (isset($_POST['creditCardNumber'])) {
    $creditCardNumber = $_POST['creditCardNumber'];

    // Check if the credit card number exists in the payment table
    $sqlCheckCard = "SELECT balance FROM payment WHERE credit_card_no = '$creditCardNumber'";
    $resultCheckCard = $conn->query($sqlCheckCard);

    if ($resultCheckCard && $resultCheckCard->num_rows > 0) {
        $row = $resultCheckCard->fetch_assoc();
        $balance = $row['balance'];

        // Check if the balance is sufficient for the total price
        if ($balance >= $totalPrice) {
            // Deduct the amount from the balance
            $newBalance = $balance - $totalPrice;
            $sqlUpdateBalance = "UPDATE payment SET balance = '$newBalance' WHERE credit_card_no = '$creditCardNumber'";
            $resultUpdate = $conn->query($sqlUpdateBalance);

            if ($resultUpdate) {
                echo "<script>alert('Payment successful.');</script>";
                echo "<script>window.location.href = 'ticket.php';</script>";
            } else {
                echo "Failed to update balance.";
            }
        } else {
            echo "<script>alert('Insufficient balance.');</script>";
            echo "<script>window.location.href = 'payment.php';</script>";
        }
    } else {
        echo "<script>alert('Credit card number not found.');</script>";
        echo "<script>window.location.href = 'payment.php';</script>";
    }
}

$conn->close();

?>