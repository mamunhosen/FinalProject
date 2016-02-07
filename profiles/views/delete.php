<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
include_once("../vendor/autoload.php");
use \app\profile\profile;
use \app\utility\debuger;
use \app\utility\message;
$profile_id=$_POST['profile_id'];
$user_id=$_POST['user_id'];
$profile=new profile();

$profile_delete=$profile->profile_delete($profile_id,$user_id);

if ($profile_delete) {
$filename='../public/profile_pic/'.$profile_delete;
unlink($filename);
Message::success("profile Successfully Deleted!");
header("Location:http://localhost/FinalProject/profiles/views/create.php?user_id=".$user_id);
}
else{
	Message::failed("Profile is not being deleted!please try again");
	header("Location:http://localhost/FinalProject/profiles/views/index.php?user_id=".$user_id);

}


?>