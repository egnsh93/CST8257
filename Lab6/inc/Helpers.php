<?php

/* Check if a file is empty */
function file_is_empty($data) {
	return $data == "" ? true : false;
}

/* Check if an array has items.
 * More readable wrapper for count()
 */
function has_items($data) {
	return count($data);
}

/* Iterate through an array and display error messages */
function display_errors($errors) {
	// Iterate through error array
	foreach ($errors as $error) {
		if (isset($error['nofile'])) {
			echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;';
			echo $error['nofile'] . "<br>";
		} else if (isset($error['invalid'])) {
			echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;';
			echo $error['invalid'] . "<br>";
		}
	}
}

/* Create a directory if it does not already exist */
function create_dir_not_exists($location) {
	if (!file_exists($location)) {
		mkdir($location);
	}
}


?>