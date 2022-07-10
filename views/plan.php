<?php

// Get the flightPlan cookie
if (isset($_GET['plan_name'])) {
	$filename = $_GET['plan_name'];
	setcookie("flightPlan", $filename);
} else {
	$filename = $_COOKIE['flightPlan']; 
}

// Try and load the flight plan from uploads folder
$flightPlan = simplexml_load_file('uploads/' . $filename);
// If no file exists, redirect to upload.php
if (!$flightPlan)  {
  header("Location: /");
}

// Helper variables
$units = $flightPlan->params->units;

function secondsToHumanTime($seconds)
{
  $hours = floor($seconds / 3600);
  $minutes = floor(($seconds - $hours * 3600) / 60);
  return sprintf('%02d:%02d', $hours, $minutes);
}

?>

<main class='container mt-5'>
  <?php require_once('includes/plan/general.php'); ?>

  <div class="accordion mt-4" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Fuel
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
        <div class="accordion-body py-4">
          <?php require_once('includes/plan/fuel-weight.php'); ?>                
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Route
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
        <div class="accordion-body py-4">
          <?php require_once('includes/plan/route.php'); ?>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
          Map
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree">
        <div class="accordion-body py-4">
          <?php require_once('includes/plan/map.php'); ?>
        </div>
      </div>
    </div>
  </div>
</main>
