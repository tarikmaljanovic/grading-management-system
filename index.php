<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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

Flight::route('POST /login', function(){
    $loginData = Flight::request()->data->getData();
    $email = $loginData['email'];
    $password = $loginData['password'];
    
    $student = Flight::studentServices()->getStudentByEmail($email);
    $professor = Flight::professorServices()->getProfessorByEmail($email);
  
    if (!$student && !$professor) {
        Flight::json(["message" => "User not found"], 404);
        return;
    }
    
    $user = null;
    $role = null;
    
    if ($student) {
        if ($password == $student['password']) {
            unset($student['password']); 
            $user = $student;
            $role = 'student';
        } else {
            Flight::json(["message" => "Wrong credentials or this user does not exist"], 500);
            return;
        }
    } else if ($professor) {
        if($password == $professor['password']) {
            unset($professor['password']); 
            $user = $professor;
            $role = 'professor';
        } else {
            Flight::json(["message" => "Wrong credentials or this user does not exist"], 500);
            return;
        }
    }
    
    if ($role === 'student') {
        Flight::set('studentId', $user['id']);
    } else if ($role === 'professor') {
        Flight::set('professorId', $user['id']);
    }

    $token = generateToken($user['id'], $role);

    Flight::json(['token' => $token, 'role' => $role]);
});

function generateToken($userId, $role) {
    $issuedAt = time();
    $expirationTime = $issuedAt + 3600;  
    $payload = array(
        'user_id' => $userId,
        'role' => $role,
        'iat' => $issuedAt,
        'exp' => $expirationTime
    );
    $token = JWT::encode($payload, 'secret_key_20202','HS256');
    return $token;
}


Flight::start();




?>