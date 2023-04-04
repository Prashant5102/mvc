<?php

class Model_PaymentMethod_Row extends Model_Core_Table_Row
{
	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_PaymentMethod');
	}

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();

		if (array_key_exists($this->status, $statuses)) 
		{
			return $statuses[$this->status];
		}
		return $statuses[Model_PaymentMethod::STATUS_DEFAULT];
	}
}