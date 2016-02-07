<?php
namespace app\utility;

class Message{

	static public function success($message){

		$_SESSION['success_message'] = $message;


	}
	static public function failed($message){

		$_SESSION['failed_message'] = $message;


	}

	static public function s_flash($data=""){
       
       $message = $_SESSION['success_message'];
       $_SESSION['success_message'] = ""; 
       return $message;
    }
    static public function f_flash($data=""){
       
       $message = $_SESSION['failed_message'];
       $_SESSION['failed_message'] = ""; 
       return $message;
    }
}

?>