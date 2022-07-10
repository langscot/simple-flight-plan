<?php

// Get current URI
$uri = $_SERVER['REQUEST_URI'];

// List of valid routes
$routes = [
  '/' => './views/upload.php',
  '/plan' => './views/plan.php'
];

// Match routes and require file
if (array_key_exists($uri, $routes)) {
  require_once($routes[$uri]);
} else {
  require_once('./views/404.php');
}