<?php 

class Model_Core_Adapter
{
	public $config = [
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'dbname' => 'project-prashant-panchal'
	];

	public $connect = null;

	public function connect(){
		
		if ($this->connect != null) {
			return $this->connect;
		}

		$connect = mysqli_connect(
			$this->config['host'],
			$this->config['username'],
			$this->config['password'],
			$this->config['dbname']
		);
		return $connect;
	}

	public function fetchAll($query){

		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);	
		}
		return false;
	}

	public function fetchRow($query){

		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();	
		}
		return false;
	}

	

	public function insert($query){

		$connect = $this->connect();
		$result = mysqli_query($connect, $query);

		if (!$result) {
			return false;
		}
		return $connect->insert_id;
	}

	public function update($query){

		$connect = $this->connect();
		$result = mysqli_query($connect, $query);

		if (!$result) {
			return false;
		}
		return true;
	}

	public function delete($query){

		$connect = $this->connect();
		$result = mysqli_query($connect, $query);

		if (!$result) {
			return false;
		}
		return true;
	}
}

?>