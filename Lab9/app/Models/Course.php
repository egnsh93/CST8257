<?php 
namespace Models;

use Core\Model;

class Course extends Model 
{    
    public function __construct() {
        parent::__construct();
    }

    public function getCourseOfferings() {
		return $this->db->select("
			SELECT course.CourseCode, course.Title, course.WeeklyHours, semester.Term 
			FROM course 
			INNER JOIN courseoffer ON course.CourseCode = courseoffer.CourseCode
			INNER JOIN semester ON courseoffer.SemesterCode = semester.SemesterCode");
    }
}