<?php


require_once __DIR__ . '/BaseDao.class.php';

class ProfessorsDao extends BaseDao {
    public function __construct(){
        parent::__construct('professors');
    }

    public function getProfessorByEmail($email){
        return $this->query_unique("SELECT * FROM professors WHERE email = :email ", ['email' => $email]);
      }
    
}