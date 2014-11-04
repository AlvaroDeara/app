<?php
/**
* Clase Group
*
* Clase para el manejo de los grupos
* @author Juan Daniel Alvaro Deara 
*/

class Group extends AppController{

	public function __contruct(){
		parent::__contruct();
	}
	
	/**
	* Metodo index
	*
	* Metodo que sirve para listar los grupos
	* @return void no regresa ningun valor
	*/
	public function index(){
		$groups = $this->Group->find("groups", "all");	
		$this->set("groups", $groups);
	}
	
	/**
	* Metodo add
	*
	* Metodo que sirve para agregar grupos
	* @return void no regresa ningun valor
	*/
	public function add(){
		if($_POST){
			if($this->Group->save("groups", $_POST)){
				$this->redirect(array("controller"=>"groups", "action"=>"index"));
			}else{
				$this->redirect(array("controller"=>"groups", "action"=>"add"));
			}
		}
	}
	
	/**
	* Metodo edit
	*
	* Metodo que sirve para editar grupos
	* @param int $id Identificador unico del grupo a editar
	*/
	public function edit($id = null){
		if($_POST){
			$this->Group->update("groups", $_POST);
			$this->redirect(array("controller"=>"groups", "action"=>"index"));
		}else{
			$groups = $this->Group->find("groups", "all",  array(
				'conditions'=>'id='.$id,
				'fields'=>'*'
				)
			);
			$this->set("groups", $groups);
		}
		
	}
	
	/**
	* Metodo delete
	*
	* Metodo que sirve para eliminar grupos
	* @param int $id Identificador unico del grupo a eliminar
	*/
	public function delete($id = null){
		if($_GET){
			$groups = $this->Group->delete('groups', 'id = '.$id);
			$this->redirect(array("controller"=>"groups", "action"=>"index"));
		}
	}	
}