<?php

class Request
{
    private $baseUrl;
    private $uri;
    
    public function __construct($moduleId)
    {
        $this->baseUrl = $_SERVER['HTTP_HOST'];
        $this->uri = isset($_SERVER['REDIRECT_URL'])?$_SERVER['REDIRECT_URL']:'';   
    }
    
    public function getUri()
    {
        return trim($this->uri,'/');
    }
}

