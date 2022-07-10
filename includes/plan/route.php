<?php

$waypoints = [];
$stageInfo = [
  'CLB' => 'Climb',
  'CRZ' => 'Cruise',
  'DSC' => 'Descent'
];

// Properly loop over $flightPlan->navlog XML array of 'fix' elements
foreach ($flightPlan->navlog->fix as $fix) {
  $waypoints[] = $fix;
}
?>

<section class='mb-4'>
  <ul class="d-flex gap-2 flex-wrap list-unstyled rounded">
    <!-- Loop over $waypoints and add a list item for each -->
    <?php foreach ($waypoints as $waypoint) { ?>
      <li class='border rounded px-2 py-1 font-monospace' style="min-width: 150px;">
        <h5 title='Waypoint name' data-bs-toggle='tooltip' class='fw-bold fs-5'>
          <span ><?= $waypoint->name ?></span>
        </h5>
        
        <h5 title='<?=$stageInfo[strval($waypoint->stage)]?> Stage' data-bs-toggle='tooltip' class='text-secondary mb-0'>
          <?=$waypoint->stage?>
        </h5>

        <h5 title='Altitude at waypoint' data-bs-toggle='tooltip' class='text-secondary mb-0'>
          <?=$waypoint->altitude_feet?> ft
        </h5>

        <h5 title='Indicated air speed at waypoint' data-bs-toggle='tooltip' class='text-secondary mb-0'>
          <?=$waypoint->ind_airspeed?> IAS
        </h5>

        <h5 title='Time' data-bs-toggle='tooltip' class='text-secondary mb-0'>
          <?=secondsToHumanTime($waypoint->time_leg)?>
        </h5>


      </li>
    <?php } ?>
  </ul>
</section>
