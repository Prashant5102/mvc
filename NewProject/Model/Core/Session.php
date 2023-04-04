<?php

class Model_Core_Session
{
	public function __construct()
	{
		$this->start();
	}
	
	public function start()
	{
		if (!isset($_SESSION)) {
			session_start();
		}

		return $this;
	}

	public function destroy()
	{
		session_destroy();
		return $this;
	}

	public function getId()
	{
		return session_id();
	}

	public function set($key, $value)
	{
		$_SESSION[$key] = $value;
		return $this; 
	}

	public function unset($key)
	{
		unset($_SESSION[$key]);
		return $this;
	}

	public function get($key)
	{
		if (!$this->has($key)) {
			return null;
		}

		return $_SESSION[$key];
	}

	public function has($key)
	{
		if (array_key_exists($key, $_SESSION)) {
				return true;
			}
			return false;
	}
}
?>