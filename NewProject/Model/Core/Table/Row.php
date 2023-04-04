<?php

class Model_Core_Table_Row
{
	
	protected $data = [];
	protected $table = null;
	protected $tableClass = 'Model_Core_Table';

	function __construct()
	{
		
	}

	public function getTableName()
	{
		return $this->getTable()->getTableName();
	}

	public function getPrimaryKey()
	{
		return $this->getTable()->getPrimaryKey();
	}

	public function setTableClass($tableClass)
	{
		$this->tableClass = $tableClass;
		return $this;
	}

	public function __set($key, $value)
	{	
		$this->data[$key] = $value;
		return $this;
	}

	public function __get($key = null)
	{
		if ($key == null) {
			return $this->data;
		}
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}
		return null;
	}

	public function __unset($key)
	{
		if (!array_key_exists($key, $this->data)) {
			return null;
		}
		unset($this->data[$key]);
	}

	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}

	public function getTable()
	{
		if($this->table){
			return $this->table;
		}
		$table = new ($this->tableClass);
		$this->table = $table;
		return $table;
	}

	public function setTableObject($tableObject)
	{
		$this->tableObject = $tableObject;
		return $this;
	}

	public function getTableObject()
	{
		if ($this->tableObject) {
			return $this->tableObject;
		}

		$tableObject = new Model_Core_Table();
		$this->setTableObject($tableObject);
		return $tableObject;
	}

	public function setId($id)
	{
		$this->data[$this->getTable()->getPrimaryKey()] = (int) $id;
		return $this;
	}

	public function getId()
	{
		$primaryKey = $this->getTable()->getPrimaryKey();
		return (int) $this->$primaryKey;
	}

	public function setData($data)
	{
		$this->data = array_merge($this->data, $data);
		return $this;
	}

	public function getData($key = null)
	{
		if ($key == null) {
			return $this->data;
		}
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}
		return null;
	}

	public function addData($key, $value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key)
	{
		if (!array_key_exists($key, $this->data)) {
			return null;
		}
		unset($this->data[$key]);
		return $this;
	}

	public function fetchAll($query)
	{
		$result = $this->getTable()->fetchAll($query);
		if (!$result) {
			return null;
		}
		$rows = [];
		foreach ($result as $row) {
			 $rows[] = (new $this())->setData($row);
		}
		return $rows;
	}

	public function fetchRow($query)
	{
		$row = $this->getTable()->fetchRow($query);
		if (!$row) {
			return null;
		}
		$this->setData($row);
		return $this;
	}

	public function load($id, $column = null)
	{
		if (!$column) {
			$column = $this->getTable()->getPrimaryKey();
		}

		$query = "SELECT * FROM `{$this->getTable()->getTableName()}` WHERE `{$column}` = '{$id}'";
		$row = $this->getTable()->fetchRow($query);

		if ($row) {
			$this->setData($row);
		}
		return $this;
	}

	public function save()
	{
		if ($id = $this->getId()) {
			$condition = [$this->getPrimaryKey() => $id];
			return $this->getTable()->setTableName($this->getTableName())->setPrimaryKey($this->getPrimaryKey())->update($this->getData(), $condition);
		}
		return $this->getTable()->setTableName($this->getTableName())->insert($this->getData());
	}

	public function delete()
	{
		$condition = [$this->getPrimaryKey() => $this->getId()];
		if (!array_values($condition)) {
			return false;
		}

		$result = $this->getTable()->setTableName($this->getTableName())->delete($condition);
		if (!$result) {
			return false;
		}
		return true;
	}
	
}
