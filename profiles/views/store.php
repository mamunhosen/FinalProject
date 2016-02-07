<?php
session_start();
include_once("../vendor/autoload.php");
use \app\profile\profile;
use \app\utility\debuger;
use \app\utility\configuration;
use \app\utility\message;
//debuger::debug($_FILES['image_name']);
$createProfile=new profile;
//$profile_id=$_GET['id'];
$user_id=$_REQUEST['user_id'];
if ($_FILES['image_name']['name']) {
$sourceFile=$_FILES['image_name']['tmp_name'];
$imageOrginalName=$_FILES['image_name']['name'];
$destination=$_SERVER['DOCUMENT_ROOT'].configuration::UPLOAD_DIR;
$_REQUEST['img_name']=$imageOrginalName;
$_REQUEST['user_id']=$user_id;
$imageName=$createProfile->storeInfoWithImage($_REQUEST);



$imageMoveToDirectory=move_uploaded_file($sourceFile,$destination.$imageName);
if ($imageMoveToDirectory) {
	header("Location:http://localhost/FinalProject/profiles/views/index.php?user_id=".$user_id);
}
else{
	Message::failed("File is not being uploaded!");
	header("Location:http://localhost/FinalProject/profiles/views/index.php?user_id=".$user_id);

	
}

}
else{

	 $createProfile->storeInfoWithoutImage($_REQUEST);

}


?>