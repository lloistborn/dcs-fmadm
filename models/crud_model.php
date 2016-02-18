<?php 
	class crud_model extends base_model {

		private function connect() {
			if(!mysql_connect('localhost', 'root', '')) {
				throw new Exception("Connection to database server failed", 1);
			}			

			if(!mysql_select_db('spksma')) {
				throw new Exception("Database not found", 1);
			}
		}

		private function disconnect() {
			mysql_close();
		}

		public function get($table, $offset = null) {
			try {
				$this->connect();

				if($offset != null) {
					// query with limit
					$query = mysql_query("select * from `$table` LIMIT $offset, 20");
				}
				else {
					$query = mysql_query("select * from `$table`");
				}
				if (!$query) {
					die('invalid query');
				}

				$rows = array();
				while($r = mysql_fetch_assoc($query)) {
				    $rows[] = $r;
				}

				return json_encode($rows);

				$this->disconnect();

			} catch (Exception $e) {
				$this->disconnect();
				throw new Exception($e, 1);
			}	
		}

		public function get_where($table, $array_data, $limit = null)
		{
			try {
				$this->connect();

				$condition = array_keys($array_data);

				$query = mysql_query("select * from `$table` where ".$condition[0]."=".$array_data[$condition[0]]);

				if (!$query) {
					die('invalid query');
				}

				$rows = array();
				while($r = mysql_fetch_assoc($query)) {
				    $rows[] = $r;
				}

				return json_encode($rows);

				$this->disconnect();

			} catch (Exception $e) {
				$this->disconnect();
				throw new Exception($e, 1);
			}	
		}
	}
?>