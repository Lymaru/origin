<?php

class SessionManager
{
    private static $instance;
    
    private function __construct()
    {
        
    }
    
    public static function instance()
    {
        if(null == $this->instance)
        {
            $this->instance = new SessionManager();
        }
        return $this->instance; 
    }
    
    public function init($username)
    {
        session_start();
        $SESSION['username'] = $username;
    }
}

