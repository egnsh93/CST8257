<?php
/**
 * Sample layout
 */

use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get();
?>

</div>

<!-- JS -->
<?php

//Array contains JS files required by template, regardless of view.
$jsFileArray = array(
    'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
);

//Add view specific js files to jsFileArray
if (isset($data['javascript'])){
    foreach ($data['javascript'] as &$jsFile) {
        array_push($jsFileArray, \Helpers\Url::templatePath() . "js/" . $jsFile . ".js");
    }
}

//Use the Assets helper to include the Javascript files. 
\Helpers\Assets::js($jsFileArray);

//hook for plugging in javascript
$hooks->run('js');

//hook for plugging in code into the footer
$hooks->run('footer');
?>

</body>
</html>
