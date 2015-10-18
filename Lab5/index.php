<?php
// Include required classes
include_once("inc/Entities/Student.php");
include_once("inc/Data_Access/CourseRepository.php");

// On submit
if (isset($_POST["submit"])) {
	// Store submission data
	$username = $_POST["username"];
	$phone = $_POST["phone"];
	$postal = $_POST["postal"];
	$pass = $_POST["pass"];
	$confirmPass = $_POST["confirmPass"];
	$courses = $_POST["courses"];

	// Validate the data

	// Create a student from the data
	$student = new Student($username, $phone, $postal, $pass, $courses);

	// Redirect to result page

	var_dump($student);

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
								<input type="text" class="form-control" name="username" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-sm-2 control-label">Phone</label>
							<div class="col-sm-10">
								<input type="tel" class="form-control" name="phone" placeholder="(nnn) nnn-nnnn">
							</div>
						</div>
						<div class="form-group">
							<label for="postal" class="col-sm-2 control-label">Postal Code</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="postal" placeholder="A1A 1A1">
							</div>
						</div>
						<div class="form-group">
							<label for="pass" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="pass" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<label for="confirmPass" class="col-sm-2 control-label">Re-enter Password</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="confirmPass" placeholder="Re-enter password">
							</div>
						</div>
						<div class="page-header">
							<h2>Select Courses</h2>
						</div>
						<p class="alert alert-info" role="alert">Max 20 hrs/week, Min 10 hrs/week</p>
						<div class="form-group">
							<div class="col-sm-12">
								<?php foreach (CourseRepository::GetAll() as $course) : ?>
								<div class="col-sm-6">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="courses[]" value="<?= $course->getId(); ?>"> <?= $course->toString(); ?>
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
								<button type="reset" name="reset" class="btn btn-lg btn-danger">Reset</button>
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