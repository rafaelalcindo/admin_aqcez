<?php

	class Db_connectio{

		private $connection;

		public function __construct(){
			$this->connection = new mysqli("localhost","root","","projeto_aqcez");
		}

		public function getConnection(){
			return $this->connection;
		}

		public function query($sql){
			return $this->connection->query($sql);
		}

	}

	