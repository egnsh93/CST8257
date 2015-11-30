<?php
/**
 * Course confirmation page
 */

use Core\Language;

?>

<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>

<p>If you are satisfied with the selection, please click the save button to finalize your course registration for this year</p>

<form method="post" action="">
	<table id="courseOfferings" class="table table-striped">
		<thead>
			<tr>
				<th>Code</th>
				<th>Course Title</th>
				<th>Hours</th>
				<th>Term</th>
			</tr>
		</thead>
		<tbody>
			<?php if (isset($data['courses'])) : ?>
				<?php foreach ($data['courses'] as $course) : ?>
					<?php foreach ($course as $key => $value) : ?>
					<tr>
						<td><?= $value->CourseCode; ?></td>
						<td><?= $value->Title; ?></td>
						<td><?= $value->WeeklyHours; ?></td>
						<td><?= $value->Term; ?></td>
					</tr>
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<input name="submit" type="submit" class="btn btn-success" value="Confirm selection">
</form>