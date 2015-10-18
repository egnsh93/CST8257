<?php

/* Load required class files */
require_once(dirname(__FILE__) . "/../../inc/Entities/Course.php");
require_once(dirname(__FILE__) . "/CourseRepositoryInterface.php");

class CourseRepository implements CourseRepositoryInterface {

	/**
	 * Parses a text file line by line and extracts
	 * individual course data.
	 * @return array
	 */
	public static function GetAll()
	{
		// Define an array to store the parsed courses in
		$courses = array();

		// Define the file to parse
		$file_handle = fopen(dirname(__FILE__) . "/CourseList.txt", "r");

		// Open a file stream and parse each line into a course object
		while (!feof($file_handle) ) {
			$line = fgets($file_handle);

			// Extract the course code
			preg_match("/^[A-Z]{3}[0-9]{4}[A-Z]{0,1}/", $line, $id);

			// Extract the course name
			preg_match("/\s.+(?=\s\d)/", $line, $name);

			// Extract the course weekly hours
			preg_match("/\d{1,2}(?=(\s\bhrs\b))/", $line, $hours);

			// Instantiate a new course object with the parsed values
			$course = new Course($id[0], trim($name[0]), $hours[0]);

			// Push the course object to the array
			array_push($courses, $course);
		}

		fclose($file_handle);

		return $courses;
	}

	public static function GetById($id) {
		// First, get all courses
		$courses = self::GetAll();

		// Then look for a specific course by Id
		foreach ($courses as $course) {
			if ($course->getId() == $id) {
				return $course;
			}
		}
		return false;
	}
}

?>