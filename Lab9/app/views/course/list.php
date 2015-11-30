<?php
/**
 * Course listing page
 */

use Core\Language;

?>

<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>

<table id="courseOfferings" class="table table-striped">
	<thead>
		<tr>
			<th>Code</th>
			<th>Course Title</th>
			<th>Term</th>
		</tr>
	</thead>
	<tbody>
		<?php if (isset($data['registered_courses'])) : ?>
			<?php if (!count($data['registered_courses'])) : ?>
				<tr>
					<td colspan="4">No courses registered</td>
				</tr>
			<?php endif; ?>

			<?php foreach ($data['registered_courses'] as $course) : ?>
				<tr>
					<td><?= $course->CourseCode; ?></td>
					<td><?= $course->Title; ?></td>
					<td><?= $course->SemesterCode; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>