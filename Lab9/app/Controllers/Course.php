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
        $data['title'] = 'Course Selection';
        $data['student_name'] = \Helpers\Session::get('Name');
        $data['course_list'] = $this->course->getCourseOfferings();

        View::renderTemplate('header', $data);
        View::render('course/selection', $data);
        View::renderTemplate('footer', $data);
    }

    /**
     * Define about page title and load template files
     */
    public function getById()
    {
        $data['title'] = 'User\'s Courses';

        $data['welcome_message'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquet nunc nec lectus convallis aliquam. Fusce suscipit pretium ipsum. Sed sollicitudin non nulla eget pharetra. Curabitur ut lectus diam. Proin sed maximus nibh, in maximus turpis. Sed laoreet euismod consequat. Phasellus vel imperdiet ligula. Praesent ultricies magna eget enim gravida sagittis.
<br><br>Phasellus id condimentum dolor, venenatis tempus justo. Donec vel porttitor neque, eget iaculis erat. Curabitur odio erat, suscipit id urna et, porta gravida justo. Phasellus facilisis pellentesque dolor id euismod. Mauris tincidunt felis vel dictum viverra. Donec non urna a leo cursus porta. Morbi magna tortor, cursus nec diam sed, egestas ornare nibh. In malesuada consequat eros eu rutrum. Nulla ante purus, feugiat scelerisque eleifend pulvinar, venenatis a tellus. In sit amet ullamcorper eros. Nulla vitae elit quis neque tincidunt aliquam. Aliquam a ex iaculis, accumsan ligula sit amet, finibus nisl.';

        View::renderTemplate('header', $data);
        View::render('course/list', $data);
        View::renderTemplate('footer', $data);
    }
}
