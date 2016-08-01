<?php require_once "vendor/autoload.php"; ?>

<?php
define('DIR_BASE', __DIR__);
define('DIR_LAYOUTS', DIR_BASE . '/layouts');
define('DIR_PAGES', DIR_BASE . '/pages');
define('DIR_PARTIALS', DIR_BASE . '/partials');

// Let the magic begin
XL\Template::display();
