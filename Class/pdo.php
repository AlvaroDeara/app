<?php
/**
* Clase ClassPDO
*
* Clase que se enlaza a la base de datos
* @author Juan Daniel Alvaro  Deara
*/

class ClassPDO{
	private $connection;
	private $dsn;
	private $username;
	private $password;

	public function __construct(){
		$this->dsn = 'mysql:host=127.0.0.1;dbname=test';
		$this->username = 'root';
		$this->password = '';
		$this->connection();
	}

	private function connection(){
		try{
			$this->connection = new PDO(
				$this->dsn,
				$this->username,
				$this->password
			);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "ERROR: " . $e->getMessage();
			die();
		}		

}

	public function find($table = null, $query = null, $options = array()){
		$fields = '*';
		$parameters = '';

		if(!empty($options['fields'])){
			$fields  = $options['fields'];
		}

		if(!empty($options['conditions'])){
			$parameters = ' WHERE '.$options['conditions'];
		}

		if(!empty($options['group'])){
			$parameters  .= ' GROUP BY '.$options['group'];
		}		

		if(!empty($options['order'])){
			$parameters  .= ' ORDER BY '.$options['order'];
		}

		if(!empty($options['limit'])){
			$parameters  .= ' LIMIT '.$options['limit'];
		}

		switch ($query) {
			case 'all':{
				$sql = "SELECT $fields FROM ".$table.' '.$parameters;
				$this->result = $this->connection->query($sql);
				break;
			}
			case 'count':{
				$sql = "SELECT COUNT(*) FROM ".$table.' '.$parameters;
				$result = $this->connection->query($sql);
				$this->result = $result->fetchColumn();
				break;
			}
			case 'first':{
				$sql = "SELECT $fields FROM ".$table.' '.$parameters;
				$result = $this->connection->query($sql);
				$this->result = $result->fetch();
				break;
			}
			
			default:
				$sql = "SELECT $fields FROM ".$table.' '.$parameters;
				$this->result = $this->connection->query($sql);
				break;
		}

		return $this->result;

	}

	public function save($table = null, $data = array()){
		$sql = "SELECT * FROM $table";
		$result = $this->connection->query($sql);

		for ($i=0; $i < $result->columnCount(); $i++) { 
			$meta = $result->getColumnMeta($i);
			$fields[$meta['name']]=null;
		}

		$fieldsToSave="id";
		$valueToSave="NULL";

		foreach ($data as $key => $value) {
			if(array_key_exists($key, $fields)){
				$fieldsToSave .= ", ".$key;
				$valueToSave  .= ", "."\"$value\""; 
			}
		}

		$sql = "INSERT INTO $table ($fieldsToSave)VALUES($valueToSave);";

		$this->result = $this->connection->query($sql);

		return $this->result;
	}

	public function update($table = null, $data = array()){
		$sql = "SELECT * FROM $table";
		$result = $this->connection->query($sql);

		for ($i=0; $i < $result->columnCount(); $i++) { 
			$meta = $result->getColumnMeta($i);
			$fields[$meta['name']]=null;
		}		

		if(array_key_exists("id", $data)){
			//Update
			$fieldsToSave = "";
			$id = $data["id"];
			unset($data["id"]);
			$i = 0;

			foreach ($data as $key => $value) {
				if(array_key_exists($key, $fields)){
					//if($i==0){
					if($i==0 && count($data) != 1){
						$fieldsToSave .= $key."="."\"$value\", ";
					}elseif($i == count($data)-1){
						$fieldsToSave .= $key."="."\"$value\"";
					}else{
						$fieldsToSave .= $key."="."\"$value\", ";
					}
				}
				$i++;
			}

			$sql = "UPDATE $table SET $fieldsToSave WHERE $table.id ='$id';";
		}
		$this->result = $this->connection->query($sql);
		return $this->result;		
	}


//EJEMPLO LOGIN
public function query ($table = null, $data=null){
$username= $data["username"];
$password= $data["password"];

/*

$sql "SELECT * FROM users WHERE username ='{$username}'and password = '{password}'";
//Regresa en un  arreglo  el  resultado
$result = $this->connection->query($sql);
$this->result=$result->fetch();

		return $this->result;

	//FORMA DE SOLUCIONARLO EN MYSQL--------------------------------------------------------
	$username = mysql_real_escape_string($data["username"]);		
	$password = mysql_real_escape_string($data["password"]);


	//sprintf texto preformateado 
	$sql = sprintf("SELECT * FROM users WHERE username = '%s' AND password ='%S'",$username, $password);


*/

	//SOLUCION PDO
	$sql = $this ->connection->prepare('SELECT * FROM users WHERE username=? AND password=?');
	$sql->execute(array($username, $password));
	$this->result=$sql->fetchAll();
	return $this->result;

}

//EJEMPLO LOGIN


	public function delete($table = null, $condition = null){
		$sql = "DELETE FROM $table WHERE $condition";
		$result = $this->connection->query($sql);
		//$this->result = $result->fetch();
	}
	
	public function getLastId($table = null){
		$sql = "SELECT MAX(id) FROM $table";
		$result = $this->connection->query($sql);
		$p = $this->result = $result->fetch();
		echo $p['MAX(id)'];
	}

}

$db = new ClassPDO();