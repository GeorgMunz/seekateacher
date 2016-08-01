<?php require_once __DIR__ . "/../../../vendor/autoload.php"; ?>

<?php
define('DIR_BASE', __DIR__);
define('DIR_LAYOUTS', DIR_BASE . '/layouts');
define('DIR_PAGES', DIR_BASE . '/pages');
define('DIR_PARTIALS', DIR_BASE . '/partials');
define('DIR_DATA', DIR_BASE . '/_data');

// Let the magic begin
XL\Template::display();