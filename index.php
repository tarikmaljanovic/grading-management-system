<?php

require 'vendor/autoload.php';


// import and register all business logic files (services) to FlightPHP
require_once __DIR__ . '/rest/services/StudentServices.class.php';
require_once __DIR__ . '/rest/services/ProfessorServices.class.php';
require_once __DIR__ . '/rest/services/GradesServices.class.php';
require_once __DIR__ . '/rest/services/EnrollmentsServices.class.php';
require_once __DIR__ . '/rest/services/CoursesServices.class.php';
require_once __DIR__ . '/rest/services/AssignmentsServices.class.php';


Flight::register('studentServices', "StudentServices");
Flight::register('professorServices', "ProfessorServices");
Flight::register('gradeServices', "GradesServices");
Flight::register('enrollmentServices', "EnrollmentsServices");
Flight::register('courseServices', "CoursesServices");
Flight::register('assignmentServices', "AssignmentsServices");


// import all routes
require_once __DIR__ . '/rest/routes/StudentRoutes.php';
require_once __DIR__ . '/rest/routes/ProfessorsRoutes.php';
require_once __DIR__ . '/rest/routes/GradesRoutes.php';
require_once __DIR__ . '/rest/routes/EnrollmentsRoutes.php';
require_once __DIR__ . '/rest/routes/CoursesRoutes.php';
require_once __DIR__ . '/rest/routes/AssignmentsRoutes.php';


Flight::route('GET /api/', function () {
    echo "Hello";
});


Flight::start();




?>