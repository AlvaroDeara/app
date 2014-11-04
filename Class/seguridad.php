<?php
/**
* password_hash();
* Crea un nuevo hash de contraseña
*/

/**
* crypt();
* Soporta de forma nativa varios algoritmos hash
*/

/**
* MD5 Y SHA1
* Ya no se recomienda para generar contraseñas
*/

/**
*
* Clase para el manejo de contraseñas
*
*/

class Seguridad{
	
	public function __construct(){
		$this->checkBlowfish();
	}
	
	private function checkBlowfish(){
		if(!defined("CRYPT_BLOWFISH") && !CRYPT_BLOWFISH){
			echo "Algoritmo Blowfish no soportado";
			die();
		}
	}
	
	public function getPassword($password, $dig = 7 ){
		$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$salt = sprintf('$2a$%02d$',$dig);
		
		for($i=0; $i < 22; $i++){
			$salt .= $set_salt[mt_rand(0,22)];
		}
		
		return crypt($password, $salt);
	}
	
	public function isValid($pass1, $pass2){
		if(crypt($pass1, $pass2) == $pass2){
			return true;
		}
		
		return false;
	}
	
	//v 5.5
	public function passwordVerify($pass1,$pass2){
		if(password_verify($pass1, $pass2)){
			return true;
		}
		return false;
	}
}

$ob = new Seguridad;

$hashDB = '$2a$07$747712G1H/IB76871657KuPoIDzqKRkKdg9R5kq6gF6ZkO/.qO0pm';

//echo $ob->getPassword('hola');

if($ob->isValid("hola",$hashDB)){
	echo "Usuario Valido";
}else{
	echo "Usuario invalido";
}


/**
* Extraccion de Datos
* - Fuerza bruta
* - Diccionario de Datos
* - Rainbow tables
*/

/**
* BLOWFISH
* $2a$, $2x$ o $2y$
* + 2 numeros de iteraccion
* + 22 Caracteres
*/

/**
* SALT
* Es un hash creado por el programador quien agrega
* una cadena explicita a la formacion de la contraseña.
*/
?>