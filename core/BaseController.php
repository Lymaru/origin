<?php

abstract class BaseController
{
    public $baseViewPath = '/protected/view/';
    public $baseView = '/protected/view/layers/base';
    
    //The worst code style ever
    protected function show($view, $vars=array())
    {
        $content = $this->showPart($view, $vars, true);
        extract(array('content' => $content));
        require($_SERVER['DOCUMENT_ROOT'].$this->baseView.'.php');
    }
    
    protected function showPart($view, $vars = array(), $return = false){
        ob_start();
        foreach($vars as $key=>$value)
        {
            if(is_object($value))
            {
                $arr = (array)$value;
                extract($arr);
            }
            else
            {
                extract(array($key=>$value));
            }
        }
        
        require($_SERVER['DOCUMENT_ROOT'].$this->baseViewPath.$view.'.php');
        $content = ob_get_contents(); 
        ob_end_clean();
        if($return){
            return $content;
        }else{
            echo $content;
        }
        
    }
    
    protected function redirect($url)
    {
        header('Location: '.$url,true);
    }
    
    protected function refresh($url,$time='0')
    {
        header("Refresh: $time; url=$url");
    }
}