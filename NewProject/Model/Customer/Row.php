<?php

class Model_Customer_Row extends Model_Core_Table_Row
{
	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_Customer');
	}

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();

		if (array_key_exists($this->status, $statuses)) 
		{
			return $statuses[$this->status];
		}
		return $statuses[Model_Customer::STATUS_DEFAULT];
	}
}