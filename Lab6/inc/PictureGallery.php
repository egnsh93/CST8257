<?php

// Include helper functions
include("inc/Helpers.php");

// Define image/thumbnail destination server paths
define("ORIGINAL_IMAGE_DESTINATION", "./originals/");
define("IMAGE_DESTINATION", "./images/");
define("THUMB_DESTINATION", "./thumbnails/");

// Define image/thumbnail dimensions
define("IMAGE_MAX_WIDTH", 800);
define("IMAGE_MAX_HEIGHT", 600);
define("THUMB_MAX_WIDTH", 100);
define("THUMB_MAX_HEIGHT", 100);

// Hold on to upload errors
$errors = [];
$files = [];
$outputImage = "";

// Allowed file types
$allowedTypes = [
	'image/jpeg',
	'image/jpg',
	'image/gif',
	'image/png',
];

// If form is submitted
if (isset($_POST["submit"])) {

	// Iterate through selected files
	foreach ($_FILES['selectedFiles']['error'] as $key => $error) {

		if ($error == UPLOAD_ERR_OK) {

			// Set the image name
			$tmp_name = $_FILES['selectedFiles']['tmp_name'][$key];
			$name = $_FILES['selectedFiles']['name'][$key];

			// Get image info
			$details = getimagesize($tmp_name);

			// If the file extension is good
			if (in_array($details['mime'], $allowedTypes)) {

				// Create the required image directories
				create_dir_not_exists(ORIGINAL_IMAGE_DESTINATION);
				create_dir_not_exists(IMAGE_DESTINATION);
				create_dir_not_exists(THUMB_DESTINATION);

				// Move the temporary files into the original directory
				move_uploaded_file($tmp_name, ORIGINAL_IMAGE_DESTINATION . $name);

				// Return an image resource id for the selected image type
				switch ($details['mime']) {
				case "image/jpeg":
				case "image/jpg":
					$originalResource = imagecreatefromjpeg(ORIGINAL_IMAGE_DESTINATION . $name);
					$outputImage = "imagejpeg";
					break;
				case "image/gif":
					$originalResource = imagecreatefromgif(ORIGINAL_IMAGE_DESTINATION . $name);
					$outputImage = "imagegif";
					break;
				case "image/png":
					$originalResource = imagecreatefrompng(ORIGINAL_IMAGE_DESTINATION . $name);
					$outputImage = "imagepng";
					break;
				}

				// Create a new full sized image
				$full_size_image = imagecreatetruecolor(IMAGE_MAX_WIDTH, IMAGE_MAX_HEIGHT);
				imagecopyresampled($full_size_image, $originalResource, 0, 0, 0, 0, IMAGE_MAX_WIDTH, IMAGE_MAX_HEIGHT, $details[0], $details[1]);

				// Create a new thumbnail image
				$thumb_image = imagecreatetruecolor(THUMB_MAX_WIDTH, THUMB_MAX_HEIGHT);
				imagecopyresampled($thumb_image, $originalResource, 0, 0, 0, 0, THUMB_MAX_WIDTH, THUMB_MAX_HEIGHT, $details[0], $details[1]);

				// Save the resampled images
				$outputImage($full_size_image, IMAGE_DESTINATION . $name);
				$outputImage($thumb_image, THUMB_DESTINATION . $name);

			} else {
				// Invalid file type
				array_push($errors, [
					'invalid' => $name . ' is not a valid image. Skipping upload...',
				]);
			}

		} else {
			if ($error == UPLOAD_ERR_NO_FILE) {
				array_push($errors, [
					'nofile' => 'You must choose a file. Please try again',
				]);
			}
		}
	}
}

?>