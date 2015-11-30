<?php
/**
 * Course controller
 *
 * @author Shane Egan
 * @version 2.2
 * @date November 25, 2015
 */

namespace Controllers;

use Core\View;
use Core\Controller;

class Course extends Controller
{

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->course = new \Models\Course();

        // On page load, redirect if not logged in
        if (\Helpers\Session::get('loggedin') == false)
            \Helpers\Url::redirect('Login');
    }

    /**
     * Define Index page title and load template files
     */
    public function index()
    {
        // Get the selected offering year
        $offeringYear = $_POST['courseId'];

        // Set view data
        $data['title'] = 'Course Selection';
        $data['student_name'] = \Helpers\Session::get('Name');
        $data['javascript'] = array('course');
        $data['course_list'] = $this->course->getCourseOfferings($offeringYear);

        // If form has been submitted
        if (isset($_POST['submit'])) {

            $selectedYear = $_POST['yearDropdown'];
            $courses = $_POST['courses'];

            \Helpers\Session::set('OfferingYear', $selectedYear);

            // If an offering year has been selected
            if ($selectedYear) {

                // If at least one course has been selected
                if (count($courses)) {

                    // Store the selected courses in the user's session
                    \Helpers\Session::set('SelectedCourses', $courses);

                    // Redirect to course confirmation page page
                    \Helpers\Url::redirect('Confirmation');

                } else {
                    $error[] = 'You must select at least one course';
                }

            } else {
                $error[] = 'You must select an offering year';
            }

        }

        // Render view
        View::renderTemplate('header', $data);
        View::render('course/selection', $data, $error);
        View::renderTemplate('footer', $data);
    }

    /**
     * Course confirmation handling 
     */
    public function confirmation() {

        // Set view data
        $name = \Helpers\Session::get('Name');
        $offeringYear = \Helpers\Session::get('OfferingYear');
        $data['title'] = "{$name}, please review your course selection for the year {$offeringYear}";
        $data['selected_courses'] = \Helpers\Session::get('SelectedCourses');

        // Iterate through each course offering code
        foreach ($data['selected_courses'] as $offering) {

            // Extract the offering values
            $id = explode("_", $offering)[0];
            $semester = explode("_", $offering)[1];
            $year = explode("_", $offering)[2];

            // Push the offering to an array
            $data['courses'][] = $this->course->getCourseOffering($id, $semester, $year);
        }

        // If the confirm page has been submitted
        if (isset($_POST['submit'])) {

            // Get the current users ID
            $student_id = \Helpers\Session::get('StudentId');

           // Iterate through each course offering code
            foreach ($data['selected_courses'] as $offering) {

                // Extract the offering values
                $id = explode("_", $offering)[0];
                $semester = explode("_", $offering)[1];
                $year = explode("_", $offering)[2];

                $semester_id = substr($year, 2) . substr($semester, 0, 1);

                // Register the student into the courses
                $this->course->insertStudentIntoOffering($student_id, $id, $semester_id);
            }

            // Redirect to current registration
            \Helpers\Url::redirect('RegisteredCourses');
        }

        // Render view
        View::renderTemplate('header', $data);
        View::render('course/confirmation', $data);
        View::renderTemplate('footer', $data);
    }

    /**
     * User's Registered Courses
     */
    public function listing()
    {
        // Set view data
        $student_name = \Helpers\Session::get('Name');
        $student_id = \Helpers\Session::get('StudentId');
        $data['title'] = 'Registered Courses for ' . $student_name;

        // Get a list of courses registered to a student ID
        $data['registered_courses'] = $this->course->getStudentCourses($student_id);

        // Render the view
        View::renderTemplate('header', $data);
        View::render('course/list', $data);
        View::renderTemplate('footer', $data);
    }
}
