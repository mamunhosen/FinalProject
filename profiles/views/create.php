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
 else{
 	$user_id=6;
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
	<title>Create Profile</title>
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
	<div class="container">
	   <?php if (($_SESSION['failed_message'])!=NULL) { ?>
		  <div class="row">
		  	<div class="col-sm-4 col-sm-offset-4">
		  	  <div class="alert alert-danger">
            	<strong><ul><li>
            	<?php echo Message::f_flash() ?>
            	</li></ul></strong>
              </div>
		  	</div>
		  </div>
		<?php 
		}
		elseif (($_SESSION['success_message'])!=NULL) { ?>

		 <div class="row">
		  	<div class="col-sm-4 col-sm-offset-4">
		  	  <div class="alert alert-success">
            	<strong><ul><li>
            	<?php echo Message::s_flash() ?>
            	</li></ul></strong>
              </div>
		  	</div>
		  </div>
			
		<?php
		}  
		?> 
		<div class="panel panel-info">
			<div class="panel-heading">
			   <h4><i class="fa fa-user-plus"></i> Create Profile</h4>
			</div>
			

			<div class="panel-body">
			   
			     <form action="store.php" method="post" enctype="multipart/form-data">
			      <input type="hidden" name="user_id" value="<?php echo $user_id?>">
				   	<div class="row">
				   	<!-- Upload Image-->
				   		<div class="col-md-4">
				   			<div class="form-group">
				   			    <input readonly="" class="form-control" placeholder="Upload Image" type="text">
				   			    <input type="file" name="image_name" id="Image">
				   				<div id="imagePreview">
				   					
				   				</div>
				   			</div>
				   		</div>
				   		<!-- Permanent Address-->
				   		<div class="col-md-4">
				   			<div class="form-group label-floating">
				   				<label for="permanentAddress" class="control-label">Permanent Address<span class="star">*</span></label>
				   				<input type="text" class="form-control" id="permanentAddress" name="permanentAddress" required>
				   			</div>
				   		</div>
				   		<!-- Present Address-->
		   		        <div class="col-md-4">
				   			<div class="form-group label-floating">
				   				<label for="presentAddress" class="control-label">Present Address<span class="star">*</span></label>
				   				<input type="text" class="form-control" id="presentAddress" name="presentAddress" required>
				   			</div>
				   		</div>
				   	</div>	  
				   		<!-- About Me-->
			   		<div class="row">
			   			<div class="col-sm-10 col-sm-offset-1">
			   				<div class="form-group label-floating">
				   				<label for="aboutMe" class="control-label">About Me</label>
				   				<textarea class="form-control" rows="1" name="aboutMe" id="aboutMe"> </textarea>
				   			</div>
			   			</div>
			   		</div> 
			   		<div class="row">
			   		 <!-- Nationality -->
			   			<div class="col-md-4">
			   				<div class="form-group label-floating">
				   				<label for="nationality" class="control-label">Nationality<span class="star">*</span></label>
				   				<input type="text" class="form-control" id="nationality" name="nationality" required>
				   			</div>
			   			</div>
			   			<!-- Mobile-->
			   			<div class="col-md-4">
			   				<div class="form-group label-floating">
				   				<label for="mobile" class="control-label">Mobile<span class="star">*</span></label>
				   				<input type="text" class="form-control" id="mobile" name="mobile" required>
				   			</div>
			   			</div>
			   			<!-- Alternative Email-->
			   			<div class="col-md-4">
			   				<div class="form-group label-floating">
				   				<label for="email" class="control-label">Alternative Email<span class="star">*</span></label>
				   				<input type="email" class="form-control" id="email" name="alternative_email" required>
				   			</div>
			   			</div>

					</div>
					
				<div class="row">
					<!-- Date Of Birth-->
					  <div class="col-sm-6 col-md-4">
			   				<div class="form-group label-floating">
				   				<label class="control-label">Date of Birth<span class="star">*</span></label>
				   				<input type="date" class="form-control" name="date_of_birth">
				   			</div>
			   			</div>
			   			<!-- Radio Button for Gender-->
						<div class="col-sm-6 col-md-4">
						    <div class="form-group">
						      <label class="control-label">Gender<span class="star">*</span></label>
						        <div class="radio radio-primary">
						          <label>
						            <input name="gender" value="Male"  type="radio" required>
						            Male
						          </label>
						        
						          <label>
						            <input name="gender" value="Female" type="radio">
						            Female
						          </label>
						        </div>
						    </div>
						</div>
			    </div>
			  </div>
				<div class="panel-footer">
				  <button type="reset" class="btn btn-warning btn-raised">Reset</button>
				  <button type="submit" class="btn btn-info btn-raised">Create</button>
				</div>
			</form>
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


					
			   	
			   	
			   		
				  
            	