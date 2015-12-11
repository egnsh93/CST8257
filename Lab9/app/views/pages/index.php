<?php
/**
 * Home page
 */

use Core\Language;

?>

<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>

<?php if (\Helpers\Session::get('loggedin') == false) : ?>
	<p>In order to access our registration system, you must first <a href="/Lab9/Login/">login</a> or <a href="/Lab9/Register/">create an account</a></p>

<?php else : ?>
	<p>Under construction</p>
<?php endif; ?>
