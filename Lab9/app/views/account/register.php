<?php
/**
 * Home page
 */

use Core\Language;

?>

<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form id="registerForm" role="form" method="post">
			<h2>Please Sign Up</h2>
			<hr class="colorgraph">
			<?php if (isset($error)) : ?>
			<div class="errors">
				<div class="alert alert-danger" role="alert">
					<ul class="fa-ul">
						<?php foreach ($error as $err => $value) : ?>
						<li><i class="fa-li fa fa-fw fa-exclamation-circle"></i><?= $value ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php else : ?>
				<?php if ($data['success']) : ?>
					<div class="alert alert-success" role="alert"><i class="fa fa-fw fa-check-circle"></i><?= $data['success'] ?></div>
				<?php endif; ?>
			<?php endif; ?>
			<div class="form-group">
				<label for="student_id">Student ID:</label>
				<input type="text" name="student_id" id="student_id" class="form-control input-lg" placeholder="21354" tabindex="1">
			</div>
			<div class="form-group">
				<label for="student_id">Student Name:</label>
				<input type="text" name="student_name" id="student_name" class="form-control input-lg" placeholder="John Doe" tabindex="2">
			</div>
			<div class="form-group">
				<label for="student_id">Student Phone:</label>
				<input type="tel" name="student_phone" id="student_phone" class="form-control input-lg" placeholder="(613) 555-5555" tabindex="3">
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="student_id">Password:</label>
						<input type="password" name="student_password" id="student_password" class="form-control input-lg" placeholder="Password" tabindex="4">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="student_id">Confirm Password:</label>
						<input type="password" name="student_password_confirmation" id="student_password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="5">
					</div>
				</div>
			</div>	
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" name="submit" value="Create Account" class="btn btn-primary btn-block btn-lg" tabindex="6"></div>
				<div class="col-xs-12 col-md-6"><a href="/Lab9/Login" class="btn btn-success btn-block btn-lg" tabindex="7">Sign In</a></div>
			</div>
		</form>
	</div>
</div>