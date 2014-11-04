<?php
class authorization{

	static function logged(){
		session_start();
		if(!$_SESSION['logged']){
			header("location: http://localhost/app/users/login");
			exit;
		}
	}
public function login($user){
	session_start();
	$_SESSION['logged'] = true;
	$_SESSION['username'] = $user["username"];

	$_SESSION['start'] = time();
	$_SESSION['expire'] = $_SESSION['start'] + (5*60);
}
public function logout(){

	//remove all session variables
	session_unset();
	//destroy the session
	session_destroy();
	echo"<script type='text/javascript'>
	alert('ha salido correctamente');
	window.location ='users/login';
	</script>";
}

}

?>