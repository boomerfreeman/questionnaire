<?php

/**
 * Very-very-very simple autoloader
 */
class Autoloader
{
    public static function loader($className)
    {
        $file = str_replace('\\', '/', $className) . '.php';
        
        if (file_exists('class/' . $file)) {
            require 'class/' . $file;
        } elseif (file_exists('controller/' . $file)) {
            require 'controller/' . $file;
        } elseif (file_exists('model/' . $file)) {
            require 'model/' . $file;
        }
    }
}

spl_autoload_register('Autoloader::loader');
