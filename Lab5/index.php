<?php
// Include required classes
include_once("inc/Entities/Course.php");
include_once("inc/Entities/Student.php");
include_once("inc/Data_Access/CourseRepository.php");
include_once("inc/Helpers/Str.php");
include_once("inc/Helpers/Validator.php");

$username = isset($_POST["username"]) ? Str::sanitize($_POST["username"]) : "";
$phone = isset($_POST["phone"]) ? Str::sanitize($_POST["phone"]) : "";
$postal = isset($_POST["postal"]) ? Str::sanitize($_POST["postal"]) : "";
$pass = isset($_POST["pass"]) ? Str::sanitize($_POST["pass"]) : "";
$confirmPass = isset($_POST["confirmPass"]) ? Str::sanitize($_POST["confirmPass"]) : "";
$courses = isset($_POST["courses"]) ? $_POST["courses"] : [];

// Define validation rule messages
$rules = array(
    'empty' => 'This field cannot be empty',
    'valid_phone' => 'Must be in the format of (NNN) NNN-NNNN',
    'valid_postal' => 'Must be in the format of A1A 1A1, with or without spaces, case insensitive',
    'strong_pass' => 'Password does not meet the required strength, please try again',
    'pass_match' => 'Password does not match',
    'hours_min' => 'Selected course hours cannot be less than 10 hours per week',
    'hours_max' => 'Selected course hours cannot exceed 20 hours per week'
);

$val = new Validator();
$error_flag = false;
$rule = "";
$totalHours = 0;

// On submit
if (isset($_POST["submit"])) {

    $total = 0;
    $selectedCourses = array();

    // Get an array of selected courses
    foreach ($courses as $courseId) {
        array_push($selectedCourses, CourseRepository::GetById($courseId));
    }

    // Iterate through the array and sum the weekly hours
    foreach ($selectedCourses as $course) {
        $totalHours += $course->getHours();
    }

    if (!$val->is_valid($username) ||
        !$val->is_phone($phone) ||
        !$val->is_postal($postal) ||
        !$val->is_strong_pass($pass) ||
        !$val->compare($pass, $confirmPass) ||
        !$val->has_items($courses) ||
        $totalHours < 10 || $totalHours > 20) {
            $error_flag = true;
    }

    if (!$error_flag) {
        // Create a student from the data
        $student = new Student(
            $username,
            $courses
        );

        // Store the student object in the session
        session_start();
        $_SESSION["student"] = $student;

        // Redirect to result page
        header("Location: results.php");
        die();
    }
} else if (isset($_POST["reset"])) {
    // Clear form fields
    $username = "";
    $phone = "";
    $postal = "";
    $pass = "";
    $confirmPass = "";
    $courses = [];
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 5 - Course Registration System</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Student</h2>
                    </div>
                    <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $username; ?>">
                                <?php if (!$val->is_valid($username) && isset($_POST["submit"])) : ?>
                                    <span class="text-danger"><?= $val->error_to_string($rules['empty']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" placeholder="(nnn) nnn-nnnn" value="<?= $phone; ?>">
                                <?php if (!$val->is_phone($phone) && isset($_POST["submit"])) : ?>
                                    <span class="text-danger"><?= $val->error_to_string($rules['valid_phone']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postal" class="col-sm-2 control-label">Postal Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="postal" placeholder="A1A 1A1" value="<?= $postal; ?>">
                                <?php if (!$val->is_postal($postal) && isset($_POST["submit"])) : ?>
                                    <span class="text-danger"><?= $val->error_to_string($rules['valid_postal']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pass" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <small>6+ characters, 1+ uppercase letter, 1+ lowercase letter, 1+ numeric character and one non-alphanumeric character.</small>
                                <input type="password" class="form-control" name="pass" placeholder="Password" value="<?= $pass; ?>">
                                <?php if (!$val->is_strong_pass($pass) && isset($_POST["submit"])) : ?>
                                    <span class="text-danger"><?= $val->error_to_string($rules['strong_pass']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmPass" class="col-sm-2 control-label">Re-enter Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="confirmPass" placeholder="Re-enter password" value="<?= $confirmPass; ?>">
                                <?php if (!$val->compare($pass, $confirmPass) && isset($_POST["submit"])) : ?>
                                    <span class="text-danger"><?= $val->error_to_string($rules['pass_match']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="page-header">
                            <h2>Select Courses</h2>
                        </div>
                        <p class="alert alert-info" role="alert">Total weekly hours must be greater than or equal to 10 and less than or equal to 20</p>
                        <?php if ((isset($_POST["submit"])) && ($totalHours < 10 || $totalHours > 20)) : ?>
                            <p class="alert alert-danger" role="alert">Total weekly hours must be between 10 and 20</p>
                        <?php endif; ?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <?php foreach (CourseRepository::GetAll() as $course) : ?>
                                <div class="col-sm-4">
                                    <div class="checkbox">
                                        <label style="font-size: 12px;">
                                            <input type="checkbox" name="courses[]" value="<?= $course->getId(); ?>" <?php if (in_array($course->getId(), $courses)) echo "checked"; ?>> <?= $course->toString(); ?>
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group" style="margin: 50px 0;">
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-lg btn-success">Submit</button>
                                <button type="submit" name="reset" class="btn btn-lg btn-danger">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>
