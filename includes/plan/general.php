<div class='d-flex flex-wrap flex-column gap-2'>
  <!-- Display the current day, month and year -->
  <header class='text-secondary d-flex justify-content-between'>
    <div>
      <h3 class='fs-5'>
        <span data-bs-toggle='tooltip' title='Airline ICAO Code'><?=$flightPlan->general->icao_airline?></span>
        <span data-bs-toggle='tooltip' title='Flight Number'><?=$flightPlan->general->flight_number?></span>
      </h3>
      <h4 data-bs-toggle='tooltip' class='fw-bold' title='Origin to Destination'><?= $flightPlan->origin->name ?> to <?=$flightPlan->destination->name?><h4>
      <h5 data-bs-toggle='tooltip' title='Current Date' class='d-inline-block'><?= date('l, jS F Y', time()); ?></h5>
    </div>
    <div class='text-end'>
      <h4 data-bs-toggle='tooltip' title='Aircraft - Registration' class='fw-bold'><?=$flightPlan->aircraft->name?> - <?=$flightPlan->aircraft->reg?><h4>
      <h5 data-bs-toggle='tooltip' title='Passenger Count' class='d-inline-block'><strong><?=strtoupper($flightPlan->api_params->pax)?></strong>/<?=$flightPlan->aircraft->max_passengers?> Passengers</h5>
    </div>
  </header>

  <section class='mt-4 d-flex justify-content-between px-3 py-2 bg-secondary bg-opacity-25 rounded'>
    <h4 class='font-monospace mb-0'>
      <span data-bs-toggle='tooltip' title='Distance (nautical miles)'><strong><?=$flightPlan->general->route_distance?></strong> NM</span> @
      <span data-bs-toggle='tooltip' title='Cruise True Air Speed'><strong><?=$flightPlan->general->cruise_tas?></strong> TAS</span> = 
      <span class='fw-bold' data-bs-toggle='tooltip' title='Hours : Minutes'><?=secondsToHumanTime($flightPlan->times->est_time_enroute)?></span>
    </h4>

    <h4 class='font-monospace mb-0'>
      <span>
        <strong data-bs-toggle='tooltip' title='Origin Airport ICAO Code'><?=$flightPlan->origin->icao_code?></strong>/<span data-bs-toggle='tooltip' title='Runway Number'><?=$flightPlan->origin->plan_rwy?></span>
      </span> -
      <span>
        <strong data-bs-toggle='tooltip' title='Destination Airport ICAO Code'><?=$flightPlan->destination->icao_code?></strong>/<span data-bs-toggle='tooltip' title='Runway Number'><?=$flightPlan->destination->plan_rwy?></span>
      </span>
    </h4>
  </section>
</div>

