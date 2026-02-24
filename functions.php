<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://github.com/timber/starter-theme
 */

namespace App;

use Timber\Timber;
use Deepspace\WPVite;

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';
require_once get_template_directory() . '/lib/declutter.php';
require_once get_template_directory() . '/lib/acf.php';
require_once get_template_directory() . '/lib/utilities.php';
new WPVite(isChild: false);


Timber::init();
new StarterSite();
