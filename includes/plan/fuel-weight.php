<?php
function getPercentageOfTotalFuel($fuelUsed) {
  global $flightPlan;

  return ($fuelUsed / $flightPlan->fuel->max_tanks) * 100;
}

$percentages = [
  'taxi'              => getPercentageOfTotalFuel($flightPlan->fuel->taxi),
  'enroute-burn'      => getPercentageOfTotalFuel($flightPlan->fuel->enroute_burn),
  'contingency'       => getPercentageOfTotalFuel($flightPlan->fuel->contingency),
  'alternate-burn'    => getPercentageOfTotalFuel($flightPlan->fuel->alternate_burn),
  'reserve'           => getPercentageOfTotalFuel($flightPlan->fuel->reserve),
  'extra'             => getPercentageOfTotalFuel($flightPlan->fuel->extra),
  'min-takeoff'       => getPercentageOfTotalFuel($flightPlan->fuel->min_takeoff),
];

// Calculate $totalFuel
$totalFuel = $flightPlan->fuel->taxi + 
  $flightPlan->fuel->enroute_burn +
  $flightPlan->fuel->contingency + 
  $flightPlan->fuel->alternate_burn + 
  $flightPlan->fuel->reserve + 
  $flightPlan->fuel->extra;
?>

<section class='mb-4'>
  <div class='d-flex gap-2'>
    <span data-bs-toggle='tooltip' title='<?=$flightPlan->fuel->taxi?> <?=$units?> est. during taxi' class="badge rounded-pill text-bg-warning">Taxi</span>
    <span data-bs-toggle='tooltip' title='<?=$flightPlan->fuel->enroute_burn?> <?=$units?> est. during route' class="badge rounded-pill text-bg-success">Enroute Burn</span>
    <span data-bs-toggle='tooltip' title='<?=$flightPlan->fuel->contingency?> <?=$units?> reserved for contingencies' class="badge rounded-pill text-bg-secondary">Contingency (15 min)</span>
    <span data-bs-toggle='tooltip' title='<?=$flightPlan->fuel->alternate_burn?> <?=$units?> reserved for alternate destination' class="badge rounded-pill text-bg-primary">Alternate Burn</span>
    <span data-bs-toggle='tooltip' title='<?=$flightPlan->fuel->reserve?> <?=$units?> reserved' class="badge rounded-pill text-bg-danger">Reserve</span>
    <span data-bs-toggle='tooltip' title='<?=$flightPlan->fuel->extra?> <?=$units?> reserved' class="badge rounded-pill text-bg-info">Extra</span>
  </div>

  <div>
    <div class="progress mt-2" style="height: 25px;">
      <div class="progress-bar progress-bar-striped bg-warning" style="width: <?=$percentages['taxi']?>%"></div>
      <div class="progress-bar progress-bar-striped bg-success" style="width: <?=$percentages['enroute-burn']?>%"></div>
      <div class="progress-bar progress-bar-striped bg-secondary" style="width: <?=$percentages['contingency']?>%"></div>
      <div class="progress-bar progress-bar-striped bg-primary" style="width: <?=$percentages['alternate-burn']?>%"></div>
      <div class="progress-bar progress-bar-striped bg-danger" style="width: <?=$percentages['reserve']?>%"></div>
      <div class="progress-bar progress-bar-striped bg-info" style="width: <?=$percentages['extra']?>%"></div>
    </div>

    <div class="d-flex position-relative mt-2">
      <h5 class='position-absolute' style="left: <?=$percentages['min-takeoff']?>%;">
        <span class="text-secondary" title='Minimum take-off fuel' data-bs-toggle='tooltip'>
        ↑ <?=$flightPlan->fuel->min_takeoff?> <?=$units?>
        </span>
      </h5>
      <h5 class="position-absolute end-0 text-secondary">
        <span data-bs-toggle='tooltip' class='fw-bold text-success' title='Required fuel' ><?=$totalFuel?> <?=$units?></span> /
        <span data-bs-toggle='tooltip' title='Maximum fuel capacity'><?=$flightPlan->fuel->max_tanks?> <?=$units?></span>
      </h5>
    </div>
  </div>



</section>
