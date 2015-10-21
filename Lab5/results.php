<?php
// Include required classes
include_once("inc/Entities/Student.php");
include_once("inc/Data_Access/CourseRepository.php");

// Session
session_start();
$student = $_SESSION["student"];

// Build an array of selected courses
$selectedCourses = array();
foreach ($student->getCourses() as $courseId) {
    array_push($selectedCourses, CourseRepository::GetById($courseId));
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
                        <h2>Thank you, <?= $student->getUsername(); ?>, for using our online course registration system</h2>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Hours/week</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($selectedCourses as $course) : ?>
                                <tr>
                                    <td><?= $course->getId() . " " . $course->getName(); ?></td>
                                    <td><?= $course->getHours(); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><span class="pull-right"><strong>Total Hours</strong></span></td>
                                <td><strong><?= $student->getTotalWeeklyHours(); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <a class="btn btn-lg btn-success" href="index.php">Register another student</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>
