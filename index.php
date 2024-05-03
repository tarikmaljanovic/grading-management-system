<?php

require 'vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


// import and register all business logic files (services) to FlightPHP
require_once __DIR__ . '/rest/services/StudentServices.class.php';
require_once __DIR__ . '/rest/services/ProfessorServices.class.php';
require_once __DIR__ . '/rest/services/GradeServices.class.php';
require_once __DIR__ . '/rest/services/EnrollmentServices.class.php';
require_once __DIR__ . '/rest/services/CourseServices.class.php';
require_once __DIR__ . '/rest/services/AssignmentServices.class.php';



Flight::register('studentServices', "StudentServices");
Flight::register('professorServices', "ProfessorServices");
Flight::register('gradeServices', "GradeServices");
Flight::register('enrollmentServices', "EnrollmentServices");
Flight::register('courseServices', "CourseServices");
Flight::register('assignmentServices', "AssignmentServices");


// import all routes
require_once __DIR__ . '/rest/routes/StudentRoutes.php';
require_once __DIR__ . '/rest/routes/ProfessorRoutes.php';
require_once __DIR__ . '/rest/routes/GradeRoutes.php';
require_once __DIR__ . '/rest/routes/EnrollmentRoutes.php';
require_once __DIR__ . '/rest/routes/CourseRoutes.php';
require_once __DIR__ . '/rest/routes/AssignmentRoutes.php';


Flight::route('GET /api/', function () {
    echo "Hello";
});


Flight::start();




?>