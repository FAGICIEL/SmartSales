<?php
	class DbTable 
	{
		public $mindez_code;
		public $_result ;
		public $_queryStatus ;
		public $_tableName ;
		public $_condition;
		public $_sort;
		public $_limit;
		public $_group;
		public $_tableFields;
		public $_data;
		//
		private $_query ;
		private $_mysql_error ;
		private $_affected_row;
		//	insert data method
		function insert ($tableName="") 
		{
			if (empty($tableName)) {
				$tableName = $this->_tableName;
			}
			$this -> _query = ' INSERT INTO ' . $tableName . ' (' . $this->_tableFields . ') VALUES (' . $this -> _data . ')';
			$this->_queryStatus = mysql_query ( $this -> _query ) ;
			if ( ! $this->_queryStatus ) 
			{
				$this->_mysql_error = mysql_error() ;
				$this->_result = -1;
				$this->_queryStatus = false;
				return false ;
			}
			$this->_result 		= mysql_insert_id () ;
			return $this->_result ;
		}
		//	update data method
		function update ($tableName="") 
		{
			if (empty($tableName)) {
				$tableName = $this->_tableName;
			}
			if (! empty($this->_limit))
			{
				$this -> _query = ' UPDATE ' . $tableName . ' SET ' . $this -> _data . ' WHERE ' . $this -> _condition . ' LIMIT ' . $this -> _limit ;
			}
			else 
			{
				$this -> _query = ' UPDATE ' . $tableName . ' SET ' . $this -> _data . ' WHERE ' . $this -> _condition;
			}
			$this->_queryStatus = mysql_query ($this -> _query);
			//--- annulation de la portée
			$this->_limit = '';
			//
			if ( ! $this->_queryStatus ) 
			{
				$this->_mysql_error = mysql_error();
				return -1 ;
			}
			$this->_result = mysql_affected_rows ();
			return $this->_result;
		}
		//	delete data method
		function delete ($tableName="") 
		{
			if (empty($tableName)) {
				$tableName = $this->_tableName;
			}
			//
			if (empty($this -> _limit))
			{
				$limit = '';
			}
			else 
			{
				$limit = ' LIMIT ' . $this -> _limit;
			}
			//
			$this -> _query = ' DELETE FROM ' . $tableName . ' WHERE ' . $this -> _condition . $limit;
			$this->_queryStatus = mysql_query ($this -> _query);
			//--- annulation de la portée
			$this->_limit = '';
			//
			if ( ! $this->_queryStatus ) 
			{
				$this->_mysql_error = mysql_error();
				return -1 ;
			}
			$this->_result = mysql_affected_rows();
			return $this->_result ;
		}
		//	select data method
		function select ($tableName="") 
		{
			if (empty($tableName)) {
				$tableName = $this->_tableName;
			}
			$this -> _query = ' SELECT ' . $this -> _tableFields . ' FROM ' . $tableName ;
			if (! empty ($this -> _condition)) 
				$this -> _query .= ' WHERE ' . $this -> _condition;
			if (! empty ($this -> _group)) 
				$this -> _query .= ' GROUP BY ' . $this -> _group;
			if (! empty ($this -> _sort))
				$this -> _query .= ' ORDER BY ' . $this -> _sort;
			if (! empty ($this->_limit)) 
				$this -> _query .= ' LIMIT ' . $this -> _limit;
			$this->_queryStatus = mysql_query ($this -> _query);
			//--- annulation de la portée
			$this->_limit = $this -> _group = $this -> _sort = '';
			//
			if (! $this->_queryStatus) 
			{
				$this->_mysql_error = mysql_error() ;
				return false ;
			}
			$this->_result = $this->_queryStatus ;
			return $this->_result;
		}
		//	sort row by id
		function fetch_row () 
		{
			$data = array () ;
			$i = 0 ;
			while ($result = mysql_fetch_row ($this->_result)) 
			{
				foreach ($result as $key => $value)
					$result [$key] = clean4Html($value);
				$data [$i] = $result;
				$i ++ ;
			}
			return $data ;
		}
		//	sort row by fieldname
		function fetch_assoc () 
		{
			$data = array () ;
			foreach (mysql_fetch_assoc ($this->_result) as $result) 
			{
				foreach ($result as $key => $value)
					$result [$key] = clean4Html($value);
				$data [] = $result ;
			}
			return $data ;
		}
		//
		function getQuery () 
		{
			return $this->_query ;
		}
		//
		function getInsertId () 
		{
			return mysql_insert_id () ;
		}
		//
		function getNumRows () 
		{
			return mysql_num_rows( $this->_result ) ;
		}
		//
		function getMysqlError () 
		{
			return $this->_mysql_error ;
		}
	}
?>