// Fetch waypoints
async function fetchWaypoints() {
  return fetch('/api/waypoints.php')
    .then(res => res.json())
    .catch(err => {
      console.log(err);
      alert("Error fetching waypoints for this flight plan. We suggest you upload a new flight plan.");
    })
}

const map = L.map('map', {
  fullscreenControl: {
    pseudoFullscreen: false // if true, fullscreen to page width and height
}
}).setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Wait for page to be ready
document.addEventListener('DOMContentLoaded', async () => {
  // Fetch waypoints
  const waypoints = await fetchWaypoints();

  // Plot each waypoint on the map and draw a line between them
  waypoints.forEach(waypoint => {
    L.marker([waypoint.pos_lat, waypoint.pos_long]).addTo(map)
      .bindPopup(waypoint.name)
      .openPopup();

    // Show text above each waypoint
    L.marker([waypoint.pos_lat, waypoint.pos_long], {
      icon: L.divIcon({
        html: `<span class="badge fs-6 rounded-pill text-bg-primary">${waypoint.name}</span>`
      })
    }).addTo(map);

  });

  // Draw a line between each waypoint
  for (let i = 0; i < waypoints.length - 1; i++) {
    L.polyline([
      [waypoints[i].pos_lat, waypoints[i].pos_long],
      [waypoints[i + 1].pos_lat, waypoints[i + 1].pos_long]
    ]).addTo(map);
  }
});