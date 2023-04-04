<?php

class Model_Product_Row extends Model_Core_Table_Row
{
	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_Product');
	}

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();

		if (array_key_exists($this->status, $statuses)) 
		{
			return $statuses[$this->status];
		}
		return $statuses[Model_Product::STATUS_DEFAULT];
	}
}