<?php
namespace app\profile;
//session_start();
use \app\utility\debuger;
use \app\utility\configuration;
use \app\utility\message;

class Profile{
 public $profile_id='';
 public $user_id='';
 public $permanent_address='';
 public $present_address='';
 public $date_of_birth='';
 public $m_number='';
 public $gender='';
 public $nationality='';
 public $alternative_email='';
 public $image_name='';
 public $about_me='';

public function __construct(){
$conn = mysql_connect(configuration::HOSTNAME,configuration::USER,configuration::PASSWORD)or die("cannot connect");
mysql_select_db(configuration::DBNAME);


}

public function index($id){
$_profile=array();
$query="SELECT *
FROM users
INNER JOIN personal_details
ON users.user_id=personal_details.user_id where users.user_id=$id";
$result = mysql_query($query);
while ($row=mysql_fetch_assoc($result)) {
			$_profile[]=$row;
		}
return $_profile[0];

   
}

public function storeInfoWithImage($data){

	$user_id=$data['user_id'];
	$validImage=self::imageValidation($data['img_name']);
	$validNumber=self::NumberChecker($data['mobile']);
	if ($validImage!=NULL) {
		if ($validNumber) {
		$this->user_id=$data['user_id'];
		$this->permanent_address=$data['permanentAddress'];
		$this->present_address=$data['presentAddress'];
		$this->date_of_birth=$data['date_of_birth'];
		$this->m_number=$validNumber;
		$this->nationality=$data['nationality'];
		$this->gender=$data['gender'];
		$this->image_name=$validImage;
		$this->alternative_email=$data['alternative_email'];
		$this->about_me=$data['aboutMe'];
		$query="INSERT INTO `code`.`personal_details` (`profile_id`, `user_id`, `date_of_birth`, `gender`, `nationality`, `present_address`, `permanent_address`, `mobile`, `alternative_email`, `about_me`, `created_at`, `modified_at`, `deleted_at`, `img_name`) 
		VALUES (NULL, '$this->user_id', '$this->date_of_birth', '$this->gender', '$this->nationality', '$this->present_address', '$this->permanent_address', '$this->m_number', '$this->alternative_email', '$this->about_me', '', '', '', '$this->image_name');";
		
		if (mysql_query($query)) {
			Message::success("Profile Created Successfully!");
			return $validImage;

		
		}
		else{
			Message::failed("Profile is not being created!Please try again.");
			header("Location:create.php?user_id=".$this->user_id);
			die();
		}
		
		}
		else{
		Message::failed("Please give valid number between 11 to 16 digits !");
 		header("Location:http://localhost/FinalProject/profiles/views/create.php?user_id=".$user_id);
        die();
		}


	}
	else{

         Message::failed("Uploaded file is Invalid!");
         //debuger::debug($_SESSION['failed_message']);
         header("Location:http://localhost/FinalProject/profiles/views/create.php?user_id=".$user_id);
         die();
	

	}
	
}
public function storeInfoWithoutImage($data){
	$this->user_id=$data['user_id'];
	$validNumber=self::NumberChecker($data['mobile']);
	if ($validNumber) {
	$this->user_id=$data['user_id'];
	$this->permanent_address=$data['permanentAddress'];
	$this->present_address=$data['presentAddress'];
	$this->date_of_birth=$data['date_of_birth'];
	$this->m_number=$validNumber;
	$this->nationality=$data['nationality'];
	$this->gender=$data['gender'];
	$this->alternative_email=$data['alternative_email'];
	$this->about_me=$data['aboutMe'];
	$query="INSERT INTO `code`.`personal_details` (`profile_id`, `user_id`, `date_of_birth`, `gender`, `nationality`, `present_address`, `permanent_address`, `mobile`, `alternative_email`, `about_me`, `created_at`, `modified_at`, `deleted_at`) 
	VALUES (NULL, '$this->user_id', '$this->date_of_birth', '$this->gender', '$this->nationality', '$this->present_address', '$this->permanent_address', '$this->m_number', '$this->alternative_email', '$this->about_me', '', '', '');";
    if (mysql_query($query)) {
    Message::success("Profile Successfully Created!");
    header("Location:index.php?user_id=".$this->user_id);
	
    }
    else{
    Message::success("Profile is not being Created!Please try again");
    header("Location:create.php?user_id=".$this->user_id);
    die();

    }
	}
	else{
		Message::failed("Please give valid number between 11 to 16 digits !");
 		header("Location:http://localhost/FinalProject/profiles/views/create.php?user_id=".$this->user_id);
        die();

	}

	


}


public function postCount($id){
	$_count=array();
	$query="SELECT count(id) FROM categories WHERE categories.user_id=$id ";
	$result=mysql_query($query);
	while ($row=mysql_fetch_assoc($result)) {
			$_count[]=$row;
		}
		//debuger::debug($_count[0]);
	return $_count[0];
	

}
public function commentCount($id){
	$_count=array();
	$query="SELECT count(id) FROM comments WHERE comments.user_id=$id ";
	$result=mysql_query($query);
	while ($row=mysql_fetch_assoc($result)) {
			$_count[]=$row;
		}
		//debuger::debug($_count[0]);
	return $_count[0];
	

}
public function shareCount($id){
	$_count=array();
	$query="SELECT count(id) FROM shares WHERE shares.user_id=$id ";
	$result=mysql_query($query);
	while ($row=mysql_fetch_assoc($result)) {
			$_count[]=$row;
		}
		//debuger::debug($_count[0]);
	return $_count[0];
	

}

public function updateInfoWithImage($data){
    $this->user_id=$data['user_id'];
    
    $validNumber=self::NumberChecker($data['updatemobile']);
	$validImage=self::imageValidation($data['img_name']);
	
	//debuger::debug($validImage);
	if ($validImage!=FALSE) {
            //debuger::debug($validImage);
		if ($validNumber) {
			$this->profile_id=$data['id'];
			$this->permanent_address=$data['updatePermanentAddress'];
			$this->present_address=$data['updatePresentAddress'];
			$this->date_of_birth=$data['updateBirth'];
			$this->m_number=$validNumber;
			$this->nationality=$data['updateNationality'];
			$this->gender=$data['gender'];
			$this->image_name=$validImage;
			$this->alternative_email=$data['updateEmail'];
			$this->about_me=$data['updateAboutMe'];
		    $updateProfile="UPDATE personal_details SET permanent_address='$this->permanent_address',present_address='$this->present_address',gender='$this->gender',mobile='$this->m_number',
		    nationality='$this->nationality',date_of_birth='$this->date_of_birth',img_name='$this->image_name',about_me='$this->about_me',alternative_email='$this->alternative_email' WHERE profile_id=$this->profile_id";
		    if (mysql_query($updateProfile)) {
		    Message::success("Profile Successfully Updated!");

			return $validImage;
		    }
		    else
		    {
			Message::failed("Profile information is not being updated!");
			header("Location:http://localhost/FinalProject/profiles/views/index.php?user_id=".$this->user_id);

		    }
			
		}
		else{
		Message::failed("Please give valid number between 11 to 16 digits !");
 		header("Location:http://localhost/FinalProject/profiles/views/index.php?user_id=".$this->user_id);
 		die();

		}
	}
			
		
	

	else{
         Message::failed("Uploaded file is Invalid!");
         //debuger::debug($_SESSION['failed_message']);
         header("Location:http://localhost/FinalProject/profiles/views/index.php?user_id=".$this->user_id);
         die();
	}


}

 public function updateInfoWithoutImage($data){
 	$user_id=$data['user_id'];
 	$validNumber=self::NumberChecker($data['updatemobile']);
 	if ($validNumber) {
		$this->profile_id=$data['id'];
		$this->user_id=$data['user_id'];
		$this->permanent_address=$data['updatePermanentAddress'];
		$this->present_address=$data['updatePresentAddress'];
		$this->date_of_birth=$data['updateBirth'];
		$this->m_number=$validNumber;
		$this->nationality=$data['updateNationality'];
		$this->gender=$data['gender'];
		$this->alternative_email=$data['updateEmail'];
		$this->about_me=$data['updateAboutMe'];
		$updateProfile="UPDATE personal_details SET permanent_address='$this->permanent_address',present_address='$this->present_address',gender='$this->gender',mobile='$this->m_number',
		nationality='$this->nationality',date_of_birth='$this->date_of_birth',about_me='$this->about_me',alternative_email='$this->alternative_email' WHERE profile_id=$this->profile_id";
	      if (mysql_query($updateProfile)) {
		    Message::success("Profile Successfully Updated!");
            header("Location:http://localhost/FinalProject/profiles/views/index.php?user_id=".$this->user_id);
		    }
		  else{
			Message::failed("Profile information is not being updated! please try again!");
			header("Location:http://localhost/FinalProject/profiles/views/index.php?user_id=".$this->user_id);

		    }
 		
 	}
 	else{
 		Message::failed("Please give valid number between 11 to 16 digits !");
 		header("Location:http://localhost/FinalProject/profiles/views/index.php?user_id=".$user_id);
 		die();

 	}
       

 }


 static public function imageValidation($image){
    
	$imageParts=explode('.', $image);
	$imageExtension=array_pop($imageParts);
	$imageExtensionLowerCase=strtolower($imageExtension);
	if ($imageExtensionLowerCase=='jpg' || $imageExtensionLowerCase=='png' || $imageExtensionLowerCase=='jpeg') {
		return time().'_'.$image;
	}

	else{

		return FALSE;
	}

	}
 static public function NumberChecker($number){

	if (preg_match('/^[0-9]{0,15}$/', $number)) {
		return $number;
	}
	
    else{

    	return false;
 	}

}


public function profile_delete($profile_id,$user_id){
	
$profile_info=$this->index($user_id);
$img_name=$profile_info['img_name'];
$delete_profile="DELETE FROM personal_details WHERE profile_id=$profile_id";
if (mysql_query($delete_profile)) {
	return $img_name;
}
else{
	return false;
}



}


}
?>