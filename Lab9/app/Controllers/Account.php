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
                    $error[] = 'Incorrect Student ID / Password';
                }

            } else {
                $error[] = "No account was found with your user ID";
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
     * Handle account registrations and view rendering
     */
    public function register()
    {
        // If the user is already logged in, redirect
        if (\Helpers\Session::get('loggedin'))
            \Helpers\Url::redirect('Courses');

        // If the registration form is submitted
        if (isset($_POST['submit'])) {

            // Instaniate the validator class
            $validator = new Gump();

            // Sanitize post data
            $_POST = $validator->sanitize($_POST);

            // Define custom validation rules
            $validator->validation_rules(array(
                'student_id'    => 'required|numeric|min_len,5',
                'student_name'    => 'required|alpha_space',
                'student_phone'       => 'required|phone_number',
                'student_password'      => 'required|min_len,6',
                'student_password_confirmation' => 'required|min_len,6'
            ));

            // Define validation filters
            $validator->filter_rules(array(
                'student_id'    => 'trim|sanitize_string',
                'student_name'    => 'trim|sanitize_string',
                'student_phone'       => 'trim|sanitize_string',
                'student_password'      => 'trim',
                'student_password_confirmation' => 'trim'
            ));

            // Validate all the data
            $validated_data = $validator->run($_POST);

            // If data is valid
            if ($validated_data) {

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

                $id = $this->account->insertStudent($student_data);

                $data['success'] = "Student created successfully. Please login to continue";

            } else {
                // Set errors
                $error = $validator->get_readable_errors(false);
            }
        }

        $data['title'] = 'New User';

        View::renderTemplate('header', $data, 'account');
        View::render('account/register', $data, $error);
        View::renderTemplate('footer', $data, 'account');
    }
}
