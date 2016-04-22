<?php
/**
 * Created by PhpStorm.
 * User: rahilasule
 * Date: 4/21/16
 * Time: 1:25 AM
 */
define("LOG_FILE", __DIR__.'/temp/errors.log');
define("DEST_LOGFILE", "3");

function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }

    switch ($errno) {
        case E_USER_ERROR:
            echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
            echo "  Fatal error on line $errline in file $errfile";
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            echo "Aborting...<br />\n";
            exit(1);
            break;

        case E_USER_WARNING:
            echo "<b>Oops! Warning: </b> [$errno] $errstr<br />\n";
            error_log("<b>Oops! Warning: </b> [$errno] $errstr<br />\n", DEST_LOGFILE, LOG_FILE);
            break;

        case E_USER_NOTICE:
            echo "<b>Oops! Notice:</b> [$errno] $errstr<br />\n";
            break;

        default:
            echo "Oops! Unknown error type: [$errno] $errstr<br />\n";
            break;
    }

    return true;
}

$old_error_handler = set_error_handler("myErrorHandler");

