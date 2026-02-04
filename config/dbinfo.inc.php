<?php
	
	class SUMON {
		var $DB_HOST;
		var $DB_NAME;
		var $DB_USER;
		var $DB_PASSW;
		var $DB_LINK;
							//For paging Variable
		var $LIMIT_START;
		var $REC_COUNT;
		var $REC_NUM_DISP;
		var $PAGE_NUMBER;
		
		function SUMON() {
			$this->DB_HOST = "localhost";		
			$this->DB_NAME = "polarbd_fna";
			$this->DB_USER = "polarbd_polard";
			$this->DB_PASSW = "polar123";
			$this->DB_LINK = mysql_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSW) or die("ERROR: MYSQL CONNECTION ERROR...PROJECT NEW");
			mysql_select_db($this->DB_NAME, $this->DB_LINK) or die(mysql_error($this->DB_LINK));
		}
		
		function query($sql) {
			$data = mysql_query($sql, $this->DB_LINK) or die(mysql_error($this->DB_LINK));
			return $data;
		}
		
		function getValueFromTable($val, $tab, $cond) {
			$sql = "select $val from $tab $cond";
			//echo $sql;
			$data = $this->query($sql);
			$row = mysql_fetch_array($data);
			return $row[$val];
		}
		
		
		function insert($tableName, $column, $values) {
			$sql = "insert into $tableName($column) values($values)";
			$this->query($sql); //if in the class
			//$ob->query($sql); //if outside the class
		}	
		
		function isExist($tableName, $cond) {
			$sql = "select *from $tableName $cond";
			//echo $sql;
			$data = $this->query($sql);
			//echo mysql_num_rows($data);
			return mysql_num_rows($data);
		}
	}
	
	$ob = new SUMON();
?>