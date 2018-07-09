<?php

Class Model{

	function __construct(){
		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}

	public function getConnection(){
		if($this->conn->connect_errno)
         {
          echo "no se pudo conectar: " . $this->conn->connect_error;
          return;
         }else{
          return $this->conn;
         }
	}
}

?>