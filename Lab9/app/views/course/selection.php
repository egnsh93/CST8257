<?php
/**
 * Course selection page
 */

use Core\Language;

?>

<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>

<p>Only courses that you have not already registered in will appear in this list</p>

<select id="yearDropdown">
    <option name="year" value="2014">2014</option>
    <option name="year" value="2015">2015</option>
    <option name="year" value="2016">2016</option>
</select>

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
			<?php foreach ($data['course_list'] as $course) : ?>
				<tr>
					<td><?= $course->CourseCode; ?></td>
					<td><?= $course->Title; ?></td>
					<td><?= $course->WeeklyHours; ?></td>
					<td><?= $course->Term; ?></td>
					<td><input type="checkbox" name="course[]" value="<?= $course->CourseCode; ?>_<?= $course->Term; ?>"></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>