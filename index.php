<?php

require 'vendor/autoload.php';


// import and register all business logic files (services) to FlightPHP
require_once __DIR__ . '/rest/services/StudentServices.class.php';
require_once __DIR__ . '/rest/services/ProfessorServices.class.php';


Flight::register('studentServices', "StudentServices");
Flight::register('professorServices', "ProfessorServices");


// import all routes
require_once __DIR__ . '/rest/routes/StudentRoutes.php';
require_once __DIR__ . '/rest/routes/ProfessorsRoutes.php';




Flight::route('GET /api/', function () {
    echo "Hello";
});


Flight::start();




?>