<?php

class Model_ShippingMethod_Row extends Model_Core_Table_Row
{
	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_ShippingMethod');
	}

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();

		if (array_key_exists($this->status, $statuses)) 
		{
			return $statuses[$this->status];
		}
		return $statuses[Model_ShippingMethod::STATUS_DEFAULT];
	}
}