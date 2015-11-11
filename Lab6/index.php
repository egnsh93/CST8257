<?php include("inc/PictureGallery.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Lab 6 - Photo Gallery</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" href="lightbox/css/lightbox.css">
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="page-header">
				<h1>My Image Gallery</h1>
			</div>

			<?php if (has_items($errors)) : ?>
				<div class="alert alert-danger" role="alert">
					<?= display_errors($errors); ?>
				</div>
			<?php endif; ?>

			<form name="uploadFile" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="selectedFiles">File to upload</label>
					<input type="file" id="selectedFiles" name="selectedFiles[]" multiple="multiple">
					<p class="help-block">Allowed: JPEG, JPG, GIF, PNG</p>
				</div>
				<button name="submit" type="submit" class="btn btn-success">Upload</button>
			</form>
		</div>

		<div class="row">
			<div class="page-header">
				<h2>Uploaded Images</h2>
			</div>

			<?php
				$images = glob(IMAGE_DESTINATION . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
				$thumbs = glob(THUMB_DESTINATION . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
			?>

			<?php foreach ($thumbs as $index => $thumb) : ?>
				<div class="col-md-2" style="margin-bottom: 20px;">
					<a href="<?= $images[$index]; ?>" data-lightbox="gallery"><img src="<?= $thumb; ?>"></a>
				</div>
			<?php endforeach; ?>

		</div>
	</div>

	<!-- Include Lightbox scripts -->
	<script src="lightbox/js/lightbox-plus-jquery.min.js"></script>

</body>

</html>