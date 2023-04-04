<?php

class Controller_Core_Action {
    protected $adapter = null;
    protected $request = null;
    protected $message = null;
    protected $view = null;

    public function getView()
    {
        if ($this->view) {
            return $this->view;
        }
        $view = new Model_Core_View();
        $this->setView($view);
        
        return $view;
    }

    public function setView(Model_Core_View $view) 
    {
        $this->view = $view;
        return $this;
    }

    
    public function setMessage(Model_Core_Message $message)
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage()
    {
        if ($this->message) {
            return $this->message;
        }
        $message = Ccc::getModel('Core_Message');
        $this->setMessage($message);
        return $message;
    }

    public function setUrlModel(Model_Core_Url $url)
    {
        $this->url = $url;
        return $this;
    }

    public function getUrlModel()
    {
        if ($this->url) {
            return $this->url;
        }
        $url = new Model_Core_Url();
        $this->setUrlModel($url);
        return $url;
    }


    public function redirect($action=null, $controller=null, $params=null, $resetParam=false)
    {
        $url = $this->getUrlModel()->getUrl($action, $controller, $params, $resetParam);
        header("location: {$url}");
    }

    protected function setRequest(Model_Core_Request $request)
    {
        $this->request = $request;
        return $this->request;
    }

    public function getRequest()
    {
    	if ($this->request) {
    		return $this->request;
    	}
    	$request = new Model_Core_Request();
    	$this->setRequest($request);
        return $this->request;
    }

    protected function setAdapter(Model_Core_Adapter $adapter)
    {
        $this->adapter = $adapter;
        return $this->adapter;
    }

    public function getAdapter()
    {
    	if ($this->adapter) {
    		return $this->adapter;
    	}
    	$adapter = new Model_Core_Adapter();
    	$this->setAdapter($adapter);
        return $this->adapter;
    }

    public function errorAction($action)
	{
		throw new Exception("Method:{$action} does not exists", 1);
		
	}

    public function getTemplate($templatePath)
    {
        require "view".DS.$templatePath;
    }

    public function render()
    {
        return $this->getView()->render();
    }

}
