<?php

class RouteProcessor implements BaseRouter
{
    private $defaultControllerName = 'User';
    private $defaultActionName = 'index';
    private $uri;
    
    public function __construct($uri)
    {
        $this->uri = $uri;
    }
    
    public function redirectRequest()
    {
        $controller = $this->getController();
        $action = $this->getAction();
        $controller->$action();
    }
    
    protected function getController()
    {
        $parts = explode('/', $this->uri);
        if(isset($parts[0]) && !empty($parts[0]))
        {
            $controllerName = $parts[0].'_Controller'; 
        }
        else
        {
           $controllerName =  $this->defaultControllerName.'_Controller';
        }
        return new $controllerName;  
    }
    
    protected function getAction()
    {
        $parts = explode('/', $this->uri);
        if(isset($parts[1]) && !empty($parts[1]))
        {
            $actionName = $parts[1]; 
        }
        else
        {
            $actionName =  $this->defaultActionName;
        }
        return $actionName;  
    }
}

