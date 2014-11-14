<?php

abstract class Module
{
    private $router;
    private $request;
    private $moduleId;
    private $parent;

    public function __construct($config = '', $moduleId = '', $parent = null)
    {
        $this->moduleId = $moduleId;
        $this->request = new Request($moduleId);
        $this->parent = $parent;
        
        if ($config !== '')
        {
            $config = require $config;
            $this->prepareConfiguration($config);
        }
    }

    public function start()
    {
        $this->processRequest();
    }

    public function setRouter($router)
    {
        if ($router !== null && $router instanceof BaseRouter)
            $this->router = $router;
        else
            throw new Exception("Router is null or wrong object.");
    }

    public function getRouter()
    {
        return $this->router;
    }

    protected function prepareConfiguration($config)
    {
        foreach ($config as $key => $value)
        {
            $this->$key = $value;
        }
    }

    //WARNING: The worst code in the world detected
    protected function processRequest()
    {
        if(!empty($this->moduleId))
        {
            $pos = strpos($this->request->getUri(), $this->moduleId);
            $uri = substr_replace($this->request->getUri(), '', $pos, strlen($this->moduleId));
        }
        else
        {
            $uri = $this->request->getUri();
        }
        $uri = trim($uri, '/');
        $parts = explode('/', $uri);
        if (count($parts) > 2 && isset($this->modules[$parts[0]]))
        {
            $moduleId = $parts[0];
            array_shift($parts);
            $moduleName = $moduleId . '_Module';
            $path = /* realpath($this->basePath). */'/' . $this->modules[$moduleId]['basePath'];
            Autoloader::importClass(array($moduleName => $path));
            $module = new $moduleName('', $moduleId, $this);
            $module->start();
        }
        else
        {
            $router = new RouteProcessor($uri);
            $router->redirectRequest();
        }
    }
}
