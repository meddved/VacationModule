<?php

/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 17:16
 */

/**
 * Class Autoloader
 * 
 * @see https://thomashunter.name/blog/simple-php-namespace-friendly-autoloader-class/
 */
class Autoloader
{
    static public function loader($className)
    {
        $filename = "src/" . str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
spl_autoload_register('Autoloader::loader');