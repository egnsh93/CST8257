<?php
/**
 * Account controller
 *
 * @author Shane Egan
 * @version 2.2
 * @date November 25, 2015
 */

namespace Controllers;

use Core\View;
use Core\Controller;
use Helpers\Gump as Gump;

class Account extends Controller
{
    private $account;

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->account = new \Models\Account();
    }

    /**
     * Handle account logins, password hashing, and view rendering
     */
    public function login()
    {
        // If the user is already logged in, redirect
        if (\Helpers\Session::get('loggedin'))
            \Helpers\Url::redirect('Courses');

        // If the login form is submitted
        if (isset($_POST['submit'])) {

            $validator = new GUMP();

            // Sanitize the submission
            $_POST = $validator->sanitize($_POST);

            // Set the data
            $input_data = array(
                'student_id'   => $_POST['student_id'],
                'student_password' => $_POST['student_password']
            );

            // Define custom validation rules
            $rules = array(
                'student_id'   => 'required|numeric',
                'student_password' => 'required'
            );

            // Validate the data
            $validated = $validator->validate($_POST, $rules);

            // If login inputs are valid
            if ($validated === true) {

                // Retrieve user hash from database
                $currentUser = $this->account->getStudentHash($_POST['student_id']);

                // If user exists
                if ($currentUser) {
                    
                    // Compare hash against the provided password
                    if (\Helpers\Password::verify($_POST['student_password'], $currentUser[0]->Password)) {

                        // Passwords match, create a session with user info
                        \Helpers\Session::set('StudentId', $currentUser[0]->StudentId );
                        \Helpers\Session::set('Name', $currentUser[0]->Name);
                        \Helpers\Session::set('loggedin', true);

                        // Redirect to course selection page
                        \Helpers\Url::redirect('Courses');

                    } else {
                        $error['invalid'] = 'Incorrect Student ID / Password';
                    }

                } else {
                    $error['not_found'] = "No account was found with your user ID";
                }

            } else {
                // Set errors
                $error = $validator->get_errors_array();
            }
        }

        // Set the page title
        $data['title'] = 'Login';

        // Render the view and pass in controller data
        View::renderTemplate('header', $data, 'account');
        View::render('account/login', $data, $error);
        View::renderTemplate('footer', $data, 'account');
    }

    /**
     * Handle account logout, session destory
     */
    public function logout()
    {
        \Helpers\Session::destroy();
        \Helpers\Url::redirect('Home');
    }

    /**
     * Handle account registrations and view rendering
     */
    public function register()
    {
        // If the user is already logged in, redirect
        if (\Helpers\Session::get('loggedin'))
            \Helpers\Url::redirect('Courses');

        // If the registration form is submitted
        if (isset($_POST['submit'])) {

            // Check if the student exists
            $studentExists = $this->account->studentExists($_POST['student_id']);

            // If user does not exists
            if (!$studentExists) {

                $validator = new GUMP();

                // Sanitize the submission
                $_POST = $validator->sanitize($_POST);

                // Set the data
                $input_data = array(
                    'student_id'    => $_POST['student_id'],
                    'student_name'    => $_POST['student_name'],
                    'student_phone'       => $_POST['student_phone'],
                    'student_password'      => $_POST['student_password'],
                    'student_password_confirmation' => $_POST['student_password_confirmation']
                );

                // Define custom validation rules
                $rules = array(
                    'student_id'    => 'required|numeric|min_len,5',
                    'student_name'    => 'required|alpha_space',
                    'student_phone'       => 'required|phone_number',
                    'student_password'      => 'required|regex,/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
                    'student_password_confirmation' => 'required|contains,' . $_POST['student_password']
                );

                // Define validation filters
                $filters = array(
                    'student_id'    => 'trim|sanitize_string',
                    'student_name'    => 'trim|sanitize_string',
                    'student_phone'       => 'trim|sanitize_string',
                    'student_password'      => 'trim',
                    'student_password_confirmation' => 'trim'
                );

                // Validate the data
                $_POST = $validator->filter($_POST, $filters);
                $validated = $validator->validate($_POST, $rules);

                // If data is valid
                if ($validated === true) {

                    // Create password hash
                    $password = $_POST['student_password'];
                    $hash = \Helpers\Password::make($password);

                    // Insert student into DB
                    $student_data = array(
                        'StudentId' => $_POST['student_id'],
                        'Name' => $_POST['student_name'],
                        'Phone' => $_POST['student_phone'],
                        'Password' => $hash,
                    );

                    // Insert the student into the database
                    $this->account->insertStudent($student_data);

                    // Get the newly created user hash
                    $currentUser = $this->account->getStudentHash($_POST['student_id']);

                    // Create a session with user info
                    \Helpers\Session::set('StudentId', $currentUser[0]->StudentId );
                    \Helpers\Session::set('Name', $currentUser[0]->Name);
                    \Helpers\Session::set('loggedin', true);

                    // Redirect to course selection page
                    \Helpers\Url::redirect('Courses');

                } else {
                    // Set errors
                    $error = $validator->get_errors_array();
                }
                
            } else {
                // Set additional error
                $error['exists'] = 'ID already exists';
            }
        }

        $data['title'] = 'New User';

        View::renderTemplate('header', $data, 'account');
        View::render('account/register', $data, $error);
        View::renderTemplate('footer', $data, 'account');
    }
}
