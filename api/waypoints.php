<?php

/**
 * Waypoints quick API point for the client side JavaScript to access a JSON array of
 * all waypoints for your flight plan.
 */

 // Get the flightPlan cookie
$flightPlan = $_COOKIE['flightPlan'];
// Try and load the flight plan from uploads folder
$flightPlan = simplexml_load_file('../uploads/' . $flightPlan);
// If no file exists, redirect to upload.php
if (!$flightPlan) {
  // Return 404
  header("HTTP/1.0 404 Not Found");
}

$waypoints = [];

// Properly loop over $flightPlan->navlog XML array of 'fix' elements
foreach ($flightPlan->navlog->fix as $fix) {
  $waypoints[] = $fix;
}

// Set header to send back JSON
header('Content-Type: application/json');

// Return the flight plan as a JSON array
echo json_encode($waypoints);
die();