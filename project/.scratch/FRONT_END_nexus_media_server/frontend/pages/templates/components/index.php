<?php
/**
 * components/index.php
 *
 * This file serves as an index for including all PHP files in the components directory.
 * It requires the FormInput.php file and includes all other PHP files found in the directory.
 */

require_once "FormInput.php";
require_once "Toast.php";


/**
 * Include all PHP files in the components directory, excluding the current index file.
 */
foreach (glob(__DIR__ . '/*.php') as $file) {
    if ($file !== __FILE__) {
        require_once $file;
    }
}