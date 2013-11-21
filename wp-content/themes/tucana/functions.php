<?php

/**
This file was not meant not to replace your functions.php file. 
Just copy and paste the codes below into your own functions.php file.
*/

/**
 * Slightly Modified Options Framework
 */
require_once ('admin/index.php');

define( 'FUNCTIONS_PATH', TEMPLATEPATH . '/functions/' );
define('ADMIN_PATH',TEMPLATEPATH,'/admin/');

require_once (FUNCTIONS_PATH.'aq_resizer.php');
require_once (FUNCTIONS_PATH.'post-types.php');
require_once (FUNCTIONS_PATH.'metabox.php');
require_once (FUNCTIONS_PATH.'theme-functions.php');
require_once (FUNCTIONS_PATH.'theme-widgets.php');
require_once (FUNCTIONS_PATH.'shortcodes.php');
require_once (ADMIN_PATH . 'tinymce/shortcodes-generator.php');