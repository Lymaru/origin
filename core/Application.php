<?php

class Application extends Module
{
    private static $app;
    
    public function __construct($config='')
    {
        session_start();
        parent::__construct($config);
    }
    
    public static function create($config='')
    {
        if(null === self::$app)
        {
            self::$app = new Application($config);   
        }
        return self::$app;
    }
}
