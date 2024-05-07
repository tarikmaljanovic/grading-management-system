<?php

require_once 'BaseServices.class.php';
require_once __DIR__ . "/../dao/AssignmentsDao.class.php";

class AssignmentServices extends BaseServices {

    public function __construct()
    {
        parent::__construct(new AssignmentsDao);
    }

    function someCustomFunction()
    {
        return $this->dao->getUserByFirstNameAndLastName();
    }

    public function getAssignmetnGradesService($courseId, $assignmetnId) {
        return $this->dao->getAssignmentGrades($courseId, $assignmetnId);
    }

    public function getGradesForStudentAssignmetn($courseId, $assignmetnId, $studentId) {
        return $this->dao->getAssignmentGradesForStudent($courseId, $assignmetnId, $studentId);
    }


}




?>