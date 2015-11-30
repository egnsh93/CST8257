<?php 
namespace Models;

use Core\Model;

class Course extends Model 
{    
    public function __construct() {
        parent::__construct();
    }

    public function getCourseOffering($id, $semester, $year) {
		return $this->db->select("
			SELECT course.CourseCode, course.Title, course.WeeklyHours, semester.Term 
			FROM course 
			INNER JOIN courseoffer ON course.CourseCode = courseoffer.CourseCode
			INNER JOIN semester ON courseoffer.SemesterCode = semester.SemesterCode
			WHERE course.CourseCode = :id AND semester.YearNum = :offeringYear AND semester.Term = :semester",
			array(
				':id' => $id,
				':semester' => $semester,
				':offeringYear' => $year
			));
    }

    public function getCourseOfferings($offeringYear) {
		return $this->db->select("
			SELECT course.CourseCode, course.Title, course.WeeklyHours, semester.YearNum, semester.Term
			FROM course 
			INNER JOIN courseoffer ON course.CourseCode = courseoffer.CourseCode
			INNER JOIN semester ON courseoffer.SemesterCode = semester.SemesterCode
			WHERE semester.YearNum = :offeringYear",
			array(
				':offeringYear' => $offeringYear
			));
    }

    public function insertStudentIntoOffering($student_id, $course_id, $semester_id) {
		return $this->db->insert("studentcourseregistration", [
			'StudentId' => $student_id,
			'CourseCode' => $course_id,
			'SemesterCode' => $semester_id
		]);
    }

    public function getStudentCourses($student_id) {
		return $this->db->select("
			SELECT course.CourseCode, course.Title, course.WeeklyHours, studentcourseregistration.SemesterCode
			FROM course 
			INNER JOIN studentcourseregistration ON course.CourseCode = studentcourseregistration.CourseCode
			WHERE studentcourseregistration.StudentId = :student_id",
			array(
				':student_id' => $student_id
			));
    }
}