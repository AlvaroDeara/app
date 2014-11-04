<?php
/**
* Clase User
*
* Clase para el manejo de los usuarios
* @author Daniel Alvaro Deara 
*/

class User extends AppController{

	public function __contruct(){
		parent::__contruct();
	}
	
	/**
	* Metodo index
	*
	* Metodo que sirve para listar los usuarios
	* @return void no regresa ningun valor
	*/
	public function index(){
		$users = $this->User->find("users", "all");	
		$this->set("users", $users);
	}
	
	/**
	* Metodo add
	*
	* Metodo que sirve para agregar usuarios
	* @return void no regresa ningun valor
	*/
	public function add(){
		if($_POST){


		$filter = new validations;
		var_dump($filter->isInt($_POST['age' ], 18, 99));
	}
/*
		$groups = $this->User->find("groups", "all");	
		$this->set("groups", $groups);
		if($_POST){
			if($this->User->save("users", $_POST)){
				$this->redirect(array("controller"=>"users", "action"=>"index"));
			}else{
				$this->redirect(array("controller"=>"users", "action"=>"add"));
			}
		}
		*/
	}
	
	/**
	* Metodo edit
	*
	* Metodo que sirve para editar Usuarios
	* @param int $id Identificador unico del usuario a editar
	*/
	public function edit($id = null){
		if($_POST){

			$filter = new validations();
			$password = new password();

			$_POST["password"] = $filter->sanitizeText($_POST["password"]);
			$_POST["password"] = $pass->getPassword($_POST["password"]);



			if($this->User->update("users", $_POST)){
			$this->redirect(array("controller"=>"users", "action"=>"index"));
		}else{
			$this->redirect(array("controller"=>"users", "action"=>"edit"));
		}


			$users = $this->User->find("users", "first",  array(
				"conditions"=>"users.id=$id"
				));


			$this->set("user",$user);

			/*
				'fields'=>'*'
				)
			);
			$this->set("users", $users);
			
			$groups = $this->User->find("groups", "all");	
			$this->set("groups", $groups);

			*/
		}
		
	}
	
	/**
	* Metodo delete
	*
	* Metodo que sirve para eliminar usuarios
	* @param int $id Identificador unico del usuario a eliminar
	*/
	public function delete($id = null){
		if($_GET){
			$users = $this->User->delete('users', 'id = '.$id);
			$this->redirect(array("controller"=>"users", "action"=>"index"));
		}
	}	


	public function login{
 /*	if ($_POST){
 		$user = $this->User->query("users", $_POST);
 		if(!empty($user)){


 		print_r($users);
}
 	}*/

 	if($_POST){
 		$pass = new password();
 		$filter = new validations();
 		$auth = new Authorization();


 		$username = filter->sanitizeText($_POST["username"]);
 		$password = filter->sanitizeText($_POST)["password"]);

$options['conditions'] = " username = '$username'";
$user = $this->User->find("users", "first" , $options);
if ($pass -> isValid($password, $user['password'])){
	$auth->login($user);
	$this->redirect(array("controller"=>"users", "action"=>"index"));

}else{
	echo "usuario invalido";

}
 	}

	}


}