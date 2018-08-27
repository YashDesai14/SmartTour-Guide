<?php
	class Database{
		public $host;
		public $user;
		public $password;
		public $database;
		public $connection;
		public $id;
		public $id_no;
		public $row;
		
		function __construct(){
			$this->host="localhost";
			$this->user="root";
			$this->password="";
			$this->database="travel_database";
		}
		
		function connect(){
			$this->connection=mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("cannot connect");
		}
		
		function insertData($insertQuery){
			return mysqli_query($this->connection,$insertQuery);
		}
		
		function updateData($updateQuery){
			return mysqli_query($this->connection, $updateQuery);
		}
		
		function selectData($selectQuery){
			return mysqli_query($this->connection,$selectQuery);
		}
	}

?>

	