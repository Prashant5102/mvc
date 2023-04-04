<?php
class Model_Category_Row extends Model_Core_Table_Row
{

	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_Category');
	}

	public function getStatusOptions()
	{
		return $this->getTable()->getStatusOptions();
	}

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();

		if (array_key_exists($this->status, $statuses)) 
		{
			return $statuses[$this->status];
		}
		return $statuses[Model_Category::STATUS_DEFAULT];
	}

	public function getParentCategories()
	{
		$query = "SELECT `category_id`, `path` FROM `{$this->getTable()->getTableName()}`";
		$categories = $this->getTable()->getAdapter()->fetchPairs($query);


		return $categories;
	}

	public function updatePath()
	{
		
	}
}

?>