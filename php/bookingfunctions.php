<?php

// Function to generate a random 3-digit number from 100 to 999
function generateRandomNumber() {
    return mt_rand(100, 999);
}

// Check if the generated booking reference exists in the database
function isUniqueReference($reference, $conn) {
    $sql = "SELECT * FROM booking WHERE booking_reference = '$reference'";
    $result = $conn->query($sql);

    return $result->num_rows === 0;
}

// Generate a unique booking reference
function generateBookingReference($conn) {
    $uniqueReference = generateRandomNumber();
    
    // Check if the generated reference already exists, generate until unique
    while (!isUniqueReference($uniqueReference, $conn)) {
        $uniqueReference = generateRandomNumber();
    }

    return $uniqueReference;
}

?>
