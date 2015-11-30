<?php
/**
 * Course selection page
 */

use Core\Language;

?>

<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>

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

<p>Only courses that you have not already registered in will appear in this list</p>

<form method="post" action="">
	<div class="form-group">
		<label for="yearDropdown">Offering Year</label>
		<select class="form-control" name="yearDropdown" id="yearDropdown">
			<option name="year" value="" selected="selected">Please select an offering year</option>
		    <option name="year" value="2014">2014</option>
		    <option name="year" value="2015">2015</option>
		    <option name="year" value="2016">2016</option>
		</select>
	</div>

	<div id="courseOfferings"></div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Code</th>
				<th>Course Title</th>
				<th>Hours</th>
				<th>Term</th>
				<th>Select</th>
			</tr>
		</thead>
		<tbody>
			<?php if (isset($data['course_list'])) : ?>
				<?php if (!count($data['course_list'])) : ?>
					<tr>
						<td colspan="5">No offering year selected</td>
					</tr>
				<?php endif; ?>
				<?php foreach ($data['course_list'] as $course) : ?>
					<tr>
						<td><?= $course->CourseCode; ?></td>
						<td><?= $course->Title; ?></td>
						<td><?= $course->WeeklyHours; ?></td>
						<td><?= $course->Term; ?></td>
						<td><input class="checkbox" type="checkbox" name="courses[]" value="<?= $course->CourseCode; ?>_<?= $course->Term; ?>_<?= $course->YearNum; ?>"></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>

	<input name="submit" type="submit" class="btn btn-success" value="Submit">
</form>