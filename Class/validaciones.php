<?php

/**
 * Clase para validar filtro de datos 
 * 
 * coleccion de funciones para validadr filtro de datos,  rangos y valores 
 * 
 *@author Daniel Alvaro Deara 
 */

class validations{
/**
 * Método  IsInt 
 * Metodo  que  sirve para  deteminar si un número  es valido, opcionalente de un  rango 
 * @param $number numero a evaluar 
 * @param $min_range valore inferior del rango
 * @param $max_range valor superior del rango
 * @return bool valor booleano resultado de la validación 
 */

public function isInt($number, $min_range = null, $max_range = null){
	//rango de numeros 
	$options =  array();

	if($min_range && $max_range){
		$options = array("option"=>
			array(
				"min_range"=>$min_range,
				"max_range"=>$max_range
				)
			);
	}else{
		if($min_range){

			$options = array(
				array(
					"min_range"=>$min_range
					)
				);
		}

if($max_range){

			$options = array(
				array(
					"max_range"=>$max_range
					)
				);
	}
}



//Para filtrar los datos 
if(filter_var($number, FILTER_VALIDATE_INT, $options)){
	return true;
		}
return false; 

	}	



/*

public function isEmail($email){
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);

	//APLICAMOS  EL FILTRADO

	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		return true;
	}
	return false;
}


public function sanitizeText($string){
$string = filter_var($string, FILTER_SANITIZE_CHARS){
	return $string;
}

}


}

$filter = new validations();
*/
}
?>
