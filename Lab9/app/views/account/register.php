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
			<?php if ($data['success']) : ?>
				<div class="alert alert-success" role="alert"><i class="fa fa-fw fa-check-circle"></i><?= $data['success'] ?></div>
			<?php endif; ?>
			<div class="form-group">
				<label for="student_id">Student ID:</label>
				<input type="text" name="student_id" id="student_id" class="form-control input-lg" placeholder="21354" tabindex="1" value="<?= $_POST['student_id']; ?>">
				<?php if ($error['Student Id']) : ?>
					<span class="text-danger"><?= $error['Student Id']; ?></span>
				<?php endif; ?>
				<?php if ($error['exists']) : ?>
					<span class="text-danger"><?= $error['exists']; ?></span>
				<?php endif; ?>
			</div>
			<div class="form-group">
				<label for="student_id">Student Name:</label>
				<input type="text" name="student_name" id="student_name" class="form-control input-lg" placeholder="John Doe" tabindex="2" value="<?= $_POST['student_name']; ?>">
				<?php if ($error['Student Name']) : ?>
					<span class="text-danger"><?= $error['Student Name']; ?></span>
				<?php endif; ?>
			</div>
			<div class="form-group">
				<label for="student_id">Student Phone:</label>
				<input type="tel" name="student_phone" id="student_phone" class="form-control input-lg" placeholder="(613) 555-5555" tabindex="3" value="<?= $_POST['student_phone']; ?>">
				<?php if ($error['Student Phone']) : ?>
					<span class="text-danger"><?= $error['Student Phone']; ?></span>
				<?php endif; ?>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="student_id">Password:</label>
						<input type="password" name="student_password" id="student_password" class="form-control input-lg" placeholder="Password" tabindex="4">
						<?php if ($error['Student Password']) : ?>
							<span class="text-danger"><?= $error['Student Password']; ?></span>
						<?php endif; ?>
						<a data-toggle="modal" href="#passwordRequirements">Password requirements</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="student_id">Confirm Password:</label>
						<input type="password" name="student_password_confirmation" id="student_password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="5">
						<?php if ($error['Student Password Confirmation']) : ?>
							<span class="text-danger"><?= $error['Student Password Confirmation']; ?></span>
						<?php endif; ?>
					</div>
				</div>
			</div>	
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<label for="submit">&nbsp;</label>
					<input type="submit" name="submit" value="Create Account" class="btn btn-primary btn-block btn-lg" tabindex="6">
				</div>
				<div class="col-xs-12 col-md-6">
					<label>Already registered?</label>
					<a href="/Lab9/Login" class="btn btn-success btn-block btn-lg" tabindex="7">Sign In</a>
				</div>
			</div>
		</form>

		<!-- Modal -->
		<div class="modal fade" id="passwordRequirements" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4>Strong password requirements</h4>
					</div>
					<div class="modal-body">
						<ul>
							<li>At least six characters in length</li>
							<li>Contain at least one uppercase letter</li>
							<li>Contain at least one lowercase letter</li>
							<li>Contain at least one digit</li>
							<li>Contain at least one non-alphanumeric character</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
