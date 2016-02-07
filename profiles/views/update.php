<?php
session_start();
include_once("../vendor/autoload.php");
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
use \app\profile\profile;
use \app\utility\debuger;
use \app\utility\configuration;
use \app\utility\message;
$updateProfile=new profile;
//$profile_id=$_GET['id'];
$user_id=$_REQUEST['user_id'];
//debuger::debug($_FILES);
if ($_FILES['update_image_name']['name']) {


$sourceFile=$_FILES['update_image_name']['tmp_name'];
$imageOrginalName=$_FILES['update_image_name']['name'];
$destination=$_SERVER['DOCUMENT_ROOT'].configuration::UPLOAD_DIR;
$_REQUEST['img_name']=$imageOrginalName;
$_REQUEST['user_id']=$user_id;
$imageName=$updateProfile->updateInfoWithImage($_REQUEST);

//debuger::debug($imageName);
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
  $updateProfile->updateInfoWithoutImage($_REQUEST);

}





//$updateProfile=$profile->update($id);
?>