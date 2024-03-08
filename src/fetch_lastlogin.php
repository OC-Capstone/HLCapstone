<?php
if (isset($_COOKIE['last_login'])) {
    $last_login = DateTime::createFromFormat('Y-m-d H:i:s', $_COOKIE['last_login']);
    if ($last_login instanceof DateTime) {
        $now = new DateTime(); // Current date and time
        $interval = $last_login->diff($now); // Difference between dates
        $days = $interval->days; // Number of days

        echo "It has been " . $days . " days since your last login.";
    } else {
        echo "Failed to parse last login date!";
    }
} else {
    echo "No last login information found.";
}
?>