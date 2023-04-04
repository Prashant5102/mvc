<?php
require_once 'Model/Core/Request.php';
class Model_Core_Url 
{
	
	public function getCurrentUrl()
	{

		return $_SERVER['REQUEST_SCHEME']. '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}

   public function getUrl($action = null, $controller = null, $params = [],$resetParam = false)
   {

	   	$request = new Model_Core_Request;

	   	$final = $request->getParam();


	   	if ($resetParam) {
	   		$final = [];
	   	}

	   	if ($action) {
	   		$final['a'] = $action;
	   	}
	   	else{
	   		$final['a'] = $request->getActionName();
	   	}

	   	if ($controller) {
	   		$final['c'] = $controller;
	   	}
	   	else{
	   		$final['c'] = $request->getControllerName();
	   	}

	   	if ($params) {

			$final = array_merge($final,$params);
	    }

	   	$queryString = http_build_query($final);
	   


		$requestUri = trim($_SERVER['REQUEST_URI'],$_SERVER['QUERY_STRING']);

		$url =  $_SERVER['REQUEST_SCHEME']. '://'.$_SERVER['HTTP_HOST'].$requestUri.$queryString;

		return $url;
	   	
   }
}

?>