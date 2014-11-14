<?php

class Autoloader
{
    
    public static function load($classname)
    {
        $dirs = array(
            './core/',
            './protected/controller/',
            './protected/model/',
            './protected/agregated/',
        );
        $file = $classname.".php";
        foreach($dirs as $dir)
        {
            $d = realpath($dir);

            if(file_exists($d.DIRECTORY_SEPARATOR.$file))
            {
                include $d.DIRECTORY_SEPARATOR.$file;
                return;
            }
        }
        return false;
    }
}

spl_autoload_register(array('Autoloader', 'load'));