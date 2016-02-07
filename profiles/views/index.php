<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
include_once("../vendor/autoload.php");
use \app\profile\profile;
use \app\utility\debuger;
use \app\utility\message;

if (isset($_GET['user_id'])) {
	$user_id=$_GET['user_id'];
}
$profile=new profile;
$postCount=new profile;
$commentCount=new profile;
$shareCount=new profile;

$singleProfile=$profile->index($user_id);
$postCount=$postCount->postCount($user_id);
$commentCount=$commentCount->commentCount($user_id);
$shareCount=$shareCount->shareCount($user_id);




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
	<title>Profile</title>
	<link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Raleway">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet"  href="//fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet"  href="../public/css/profileStyle.css">
	<link rel="stylesheet"  href="../public/css/bootstrap-material-design.css">
	<link rel="stylesheet"  href="../public/css/ripples.min.css">

</head>
<body>
    <!-- nav -->

    <div class="container navItem">
    	<div class="row">
    		<div class="col-sm-12">
    			<ul class="nav nav-tabs">
			      <div class="dropdown pull-right">
		             <button class="dropdown-toggle btn btn-default btn-raised" type="button" id="dropdownMenu1" data-toggle="dropdown">
		              Settings <span class="caret"></span>
		             </button>
		             <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		              <li role="separator" class="divider"></li>
		              <li><a href="#" data-toggle="modal" data-target=".ProfileEdit" > Edit Profile </a></li>
					  <li role="separator" class="divider"></li>
					  <li>
		               <form method="post" action="delete.php">
		                <input type="hidden" name="user_id" value="<?php echo $user_id?>">
		                <input type="hidden" name="profile_id" value="<?php echo $singleProfile['profile_id']?>">
		                <input type="submit" value="Remove Profile"/>
		                <!-- <li><a href="delete.php?profile_id=<?php echo $singleProfile['profile_id']?>&user_id=<?php echo $user_id?>">Remove Profile</a></li> -->
		               	
		               </form>
		              </li>
		             </ul>
                   </div> 
			        <!-- <li role="presentation"><a href="#" data-toggle="modal" data-target=".ProfileEdit" > Edit Profile </a></li> -->
			        
                </ul>
    		</div>
    	</div>
    </div>

<!-- Modal for Edit Profile -->
<div class="modal fade ProfileEdit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			   <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Profile</h4>
			</div>
			<hr>

			<div class="modal-body">
			   <div class="container">
			     <form action="update.php?id=<?php echo $singleProfile['profile_id']?>" method="post" enctype="multipart/form-data">
			       <input type="hidden" name="user_id" value="<?php echo $singleProfile['user_id']?>">
				   	<div class="row">
				   	<!-- Update Image-->
				   		<div class=" col-sm-6 col-md-3 updateImage">
				   			<div class="form-group">
				   			    <label for="updateImage">Update Image</label>
				   			    <input type="file" name="update_image_name" id="updateImage">
				   				<div id="imagePreview" class="img-responsive">
				   					<img src="../public/profile_pic/<?php echo $singleProfile['img_name'] ?>" alt="<?php echo $singleProfile['user_name']?>" title="<?php echo $singleProfile['user_name']?>">
				   				</div>
				   			</div>
				   		</div>
				   		<!-- Permanent Address-->
				   		<div class="col-sm-6 col-md-3 updateAddressField">
				   			<div class="form-group">
				   				<label for="updatePermanentAddress" class="control-label">Permanent Address:<span class="star">*</span></label>
				   				<input type="text" class="form-control" name="updatePermanentAddress" value="<?php echo $singleProfile['permanent_address'] ?>" required>
				   			</div>
				   		</div>
				   		<!-- Present Address-->
				   	   <div class=" col-sm-6 col-md-3 updateAddressField">
				   			<div class="form-group">
				   				<label for="updatePermanentAddress" class="control-label">Present Address:<span class="star">*</span></label>
				   				<input type="text" class="form-control" name="updatePresentAddress" value="<?php echo $singleProfile['present_address'] ?>" required>
				   			</div>
				   	   </div>
			   		</div>  
			   		<div class="row">
			   		<!-- About Me-->
			   			<div class="col-md-9">
			   				<div class="form-group">
				   				<label for="updateAboutMe" class="control-label">About Me:</label>
				   				<textarea class="form-control" rows="3" name="updateAboutMe" id="updateAboutMe" value=""><?php echo $singleProfile['about_me'] ?></textarea>
				   			</div>
			   			</div>
			   		</div> 
			   		<div class="row">
			   		<!-- Nationality -->
			   			<div class="col-sm-6 col-md-3">
			   				<div class="form-group">
				   				<label for="updateNationality" class="control-label">Nationality:<span class="star">*</span></label>
				   				<input type="text" class="form-control" id="updateNationality" name="updateNationality" value="<?php echo $singleProfile['nationality'] ?>" required>
				   			</div>
			   			</div>
			   			<!-- Mobile-->
			   			<div class="col-sm-6 col-md-3">
			   				<div class="form-group">
				   				<label for="updatemobile" class="control-label">Mobile:<span class="star">*</span></label>
				   				<input type="text" class="form-control" id="updatemobile" name="updatemobile" value="<?php echo $singleProfile['mobile'] ?>" required>
				   			</div>
			   			</div>
			   			<!-- Alternative Email-->
			   			<div class="col-sm-6 col-md-3">
			   				<div class="form-group">
				   				<label for="updateEmail" class="control-label">Alternative Email:</label>
				   				<input type="email" class="form-control" id="updateEmail" name="updateEmail" value="<?php echo $singleProfile['alternative_email'] ?>">
				   			</div>
			   			</div>

					</div>
					
					<div class="row">
					<!-- Date Of Birth-->
					  <div class="col-sm-6 col-md-3">
			   				<div class="form-group">
				   				<label for="updateBirth" class="control-label">Date of Birth:</label>
				   				<input type="date" class="form-control" id="updateBirth" name="updateBirth" value="<?php echo $singleProfile['date_of_birth'] ?>">
				   			</div>
			   			</div>
			   			<!-- Radio Button for Gender-->
						<div class="col-sm-6 col-md-5 col-md-offset-1">
						    <div class="form-group">
						      <label class="control-label">Gender:<span class="star">*</span></label>
						        <div class="radio radio-primary">
						          <label>
						            <input name="gender" id="option1" value="Male" <?php echo ($singleProfile['gender']=='Male')?'checked':'' ?> type="radio">
						            Male
						          </label>
						        
						          <label>
						            <input name="gender" id="option2" value="Female" <?php echo ($singleProfile['gender']=='Female')?'checked':'' ?>  type="radio">
						            Female
						          </label>
						        </div>
						    </div>
						</div>
					</div>
			   	
			   	
			    </div>
			  </div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Close</button>
				  <button type="submit" class="btn btn-primary btn-raised">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

    <!-- profile contents -->
    <div class="container profileContents">
          	   <?php

          if (($_SESSION['failed_message'])!=NULL) { ?>
          <div class="row">
           <div class="col-sm-4 col-sm-offset-4">
            <div class="alert alert-danger">
            	<strong><ul><li><?php echo Message::f_flash() ?></li></ul></strong>
            </div>
           </div>
          </div> 
         <?php
          }
          elseif (($_SESSION['success_message'])!=NULL) { ?>
          <div class="row">
           <div class="col-sm-4 col-sm-offset-4">
            <div class="alert alert-success">
            	<strong><ul><li><?php echo Message::s_flash() ?></li></ul></strong>
            </div>
           </div>
          </div> 
          
        <?php
         } 
			
			?>
    	  <div class="row">
    		<div class="col-sm-3 image">
    			<img class="img-responsive thumbnail" src="../public/profile_pic/<?php echo $singleProfile['img_name'] ?>" alt="<?php echo $singleProfile['user_name']?>" title="<?php echo $singleProfile['user_name']?>">
    		</div>
    	
	    	<div class="col-sm-5">
	    		 <strong>Name: </strong><span><?php echo $singleProfile['user_name']?></span><br/><br/>
	    		 <strong>Present Address:</strong><span> <?php echo $singleProfile['present_address']?></span><br/><br/>
	    		 <strong>Permanent Address:</strong><span> <?php echo $singleProfile['permanent_address']?></span><br/><br/>
	    		 <strong>About Me:</strong>
	    		 <p><span><?php echo $singleProfile['about_me'] ?></span></p>

	    	</div>
	    	<div class="col-sm-4">
	    		 <div class="row">
	    		 	<div class="col-sm-4">
	    		 		<strong><?php echo $postCount['count(id)'];?></strong> <br/>Posts
	    		 	</div>
	    		 	<div class="col-sm-4">
	    		 		<strong><?php echo $commentCount['count(id)'];?></strong> <br/>Comments
	    		 	</div>
	    		 	<div class="col-sm-4">
	    		 		<strong><?php echo $shareCount['count(id)'];?></strong> <br/>Shares
	    		 	</div>
	    		 	<div class="col-sm-12 profileDetails">
	    		 		<i class="fa fa-map-marker"></i>&nbsp; <span title="Nationality"><?php echo $singleProfile['nationality']?></span> <br/><br/>
	    		 		<i class="fa fa-birthday-cake"></i>&nbsp; <span title="Date Of Birth"><?php echo $singleProfile['date_of_birth']?></span> <br/><br/>
	    		 		<i class="fa fa-<?php echo strtolower($singleProfile['gender'])?>"></i>&nbsp; <span title="Gender"><?php echo $singleProfile['gender']?></span> <br/><br/>
	    		 		<i class="fa fa-phone"></i>&nbsp; <span title="Cell Number"><?php echo $singleProfile['mobile']?></span> <br/><br/>
	    		 		<i class="fa fa-envelope"></i>&nbsp; <span title="Alternative Email"><?php echo $singleProfile['alternative_email']?></span> <br/><br/>
	    		 	</div>
	    		 </div>
	    	</div>
    	</div>
    </div>


	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>	
	<script type="text/javascript" src="../public/js/profile.js"></script>
	<script type="text/javascript" src="../public/js/updateImagePreview.js"></script>	
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="../public/js/ripples.min.js"></script>
	<script type="text/javascript" src="../public/js/material.min.js"></script>
</body>
</html>
					      
                
			   		




		              
