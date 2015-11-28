<?php
/**
 * Home page
 */

use Core\Language;

?>

<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form id="loginForm" role="form" method="post">
			<fieldset>
				<h2>Please Sign In</h2>
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
				<?php endif; ?>
				<div class="form-group">
                    <input type="text" name="student_id" id="student_id" class="form-control input-lg" placeholder="21354" tabindex="1">
				</div>
				<div class="form-group">
                    <input type="password" name="student_password" id="student_password" class="form-control input-lg" placeholder="Password" tabindex="2">
				</div>
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<label>&nbsp;</label>
                        <input type="submit" name="submit" class="btn btn-lg btn-success btn-block" value="Sign In" tabindex="3">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<label>New user?</label>
						<a href="/Lab9/Register" class="btn btn-lg btn-primary btn-block" tabindex="4">Create Account</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
