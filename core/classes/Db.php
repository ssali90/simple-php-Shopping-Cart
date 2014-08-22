<?php

class Db
{

	/**
	* holds our sql statements
	*
	* @var string
	*/
	private $_stmt;
	
	/**
	* stores database connection
	*
	*/
	private $_pdo;
	
	/**
	* the databese user
	*
	* @var string
	*/
	private $_user = 'root';
	
	/**
	* the databse access password
	*
	* @var string
	*/
	private $_pass = 'your password';
	
	/**
	* name of the database the products are stored
	*
	* @var string
	*/
	private $_db = 'your db name';
	
	/**
	* database host
	*
	* @var string
	*/
	private $_host = 'your host';
	
	/**
	* name of table we are quering
	*
	* @var string
	*/
	private $_table;
	
	/**
	* the constructor
	*/
	public function __construct()
	{
		try 
		{
			$this->_pdo = new PDO("mysql: host={$this->_host}; dbname={$this->_db}", "{$this->_user}", "{$this->_pass}");
		} catch(PDOException $e) 
		{
			die($e->getMessage());
		}
	}
	
	/**
	* returns the name of the table we are quering
	*
	* @param string table
	* @return this
	*/
	public function table($table) 
	{
		$this->_table = $table;
			return $this;
	}
	
	/**
	* prepares our sql query
	*
	* @param string action
	* @param array $where
	* @return bool
	*/
	private function query($action, $where = [])
	{
		if(count($where)) 
		{
			$opperators = ['=', '>', '<', 'LIKE'];
			$opperator = $where[1];
		
			if(in_array($opperator, $opperators))
			{
			//first value in where array
				$field = $where[0];
				
				$sql = "{$action} FROM {$this->_table} WHERE {$field} {$opperator} ?";
				
				// 3rd value in where array
					$value = $where[2];
					
					$this->execute($sql, $value);
			}
		} else 
		{
			$sql = "{$action} FROM {$this->_table}";
				
				$this->execute($sql);
		}
		
		return false;
	}
	
	/**
	* Deletes data from database
	*
	* @param array params
	* @return this
	*/
	public function delete($params) 
	{
		$this->query('DELETE', $params);
			return $this;
	}
	
	/**
	* gets information from specified field in database
	*
	* @param array params
	* @return this
	*/
	public function get($params)
	{
		$this->query('SELECT *', $params);
			return $this;
	}
	
	/**
	* gets all data from the specified table
	*
	* @return this
	*/
	public function getAll() 
	{
		$this->query('SELECT *');
			return $this;
	}
	
	/**
	* counts the amout rows a query returns
	*
	* @return int
	*/
	public function count() 
	{
		return $this->_stmt->rowCount();
	}
	
	/**
	* returns the result of the execited query in an object
	*
	* @return obj
	*/
	public function fetchObj()
	{
		return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
	/**
	* returns the first row of the executed query
	* 
	* @return Obj
	*/
	public function first() {
		return $this->fetchObj()[0];
	}
	
	/**
	* binds the pdo params and executes the query
	*
	* @var string sql
	* @var string value
	* @return bool
	*/
	public function execute($sql, $value = null) 
	{
		$prep = $this->_stmt = $this->_pdo->prepare($sql);
			
		if($prep)
		{
			$this->_stmt->execute([$value]);
		} 
		
		return false;
	}
	
}

?>
