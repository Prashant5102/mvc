<?php 

class Model_Core_Table
{
	protected $tableName = NULL;
 	protected $primaryKey = NULL;
	protected $adapter = NULL; 

	public function __construct()
	{
		
	}


	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey; 
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

 	public function setAdapter($adapter)
 	{
 		$this->adapter = $adapter;
 		return $this;
 	}

 	public function getAdapter()
 	{
 		if ($this->adapter) {
 			return $this->adapter;
 		}
 		$adapter = new Model_Core_Adapter();
 		$this->setAdapter($adapter);
 		return $adapter;
 	}

 	public function fetchAll($query)
 	{
 		$adapter = $this->getAdapter();
 		$results = $adapter->fetchAll($query);
 		return $results;
 	}

 	public function fetchRow($query)
 	{
 		$adapter = $this->getAdapter();
 		$results = $adapter->fetchRow($query);
 		return $results;
 	}

 	public function insert($data)
 	{
 		$columns = "`" . implode("`, `", array_keys($data)) . "`";
		$values = "'" . implode("', '", array_values($data)) . "'";
		$query = 'INSERT INTO `'.$this->tableName.'`('.$columns.') VALUES ('.$values.')';
		return $this->getAdapter()->insert($query);
	}

	public function update($data, $conditions)
	{
		$newData = "";
		foreach($data as $key => $value){
    		$newData .= "`".$key."` = '".$value."', ";
		}
		$newData = rtrim($newData, ", "); 

		if (!is_array($conditions)) {
			$query = "UPDATE `{$this->getTableName()}` SET {$newData}";
			return $this->getAdapter()->update($query);
				
		}
		
		$keys = array_keys($conditions);
		$values = array_values($conditions);
		$condition = "";
		if (count($keys) != 1) {
			for ($i=0; $i < count($keys); $i++) {
				$condition .= "`".$keys[$i]."` = '".$values[$i]."' AND ";
			}
			$condition = rtrim($condition, " AND");
		}

		else {
				
			if (!is_array($values[0])) {
				for ($i=0; $i < count($keys); $i++) { 
					$condition = "`".$keys[$i]."` = '".$values[$i]."'";
				}
			}

			else {
				$valueString = implode(',', $values[0]);
				$condition = "`".$keys[0]."` IN (".$valueString.")";
			}

		}
		$query = "UPDATE `{$this->getTableName()}` SET {$newData} WHERE {$condition}";
		return $this->getAdapter()->update($query);		
	}

	public function delete($conditions)
	{

		$keys = array_keys($conditions);
		$values = array_values($conditions);

		if (count($keys) != 1) {
			for ($i=0; $i < count($keys); $i++) {
				$condition .= "`".$keys[$i]."` = '".$values[$i]."' AND ";
			}
			$condition = rtrim($condition, " AND");
		}

		else {
			
			if (!is_array($values[0])) {
				for ($i=0; $i < count($keys); $i++) { 
					$condition = "`".$keys[$i]."` = '".$values[$i]."'";
				}
			}

			else {
				$valueString = implode(',', $values[0]);
				$condition = "`".$keys[0]."` IN (".$valueString.")";
			}

		}

		$query = "DELETE FROM `{$this->tableName}` WHERE {$condition}";
		return $this->getAdapter()->delete($query);
	}

	public function load($value, $col = null)
    {
        $col = (!$col) ? $this->getPrimaryKey() : $col;
        $sql = "SELECT * FROM `{$this->getTableName()}` WHERE `{$col}` = '{$value}'";
        return $this->getAdapter()->fetchRow($sql);
    }

 }
