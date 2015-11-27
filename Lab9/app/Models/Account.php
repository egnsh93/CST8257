<?php 
namespace Models;

use Core\Model;

class Account extends Model 
{    
    public function __construct() {
        parent::__construct();
    }

    public function getStudentHash($id) {
		return $this->db->select("SELECT StudentId, Name, Password FROM " . "student WHERE StudentId = :id",
			array(
				':id' => $id
			));
    }

	public function insertStudent($student) {
		$this->db->insert("student", $student);
		return $this->db->lastInsertId('StudentId');
	}
}