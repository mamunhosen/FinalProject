	
$(document).ready(function($) {

	$('#updateImage').on('change', function(event) {
		
		var image = this.files[0]; 

		
		$('#imagePreview').html(''); 

		var reader = new FileReader(); 
		reader.onload = function(e){ 
			$('<img src="' + e.target.result + '" class="thumbnail img-responsive" width="210"  alt="Loading..">').appendTo($('#imagePreview'));
			
		}
		reader.readAsDataURL(image); // this gives our file to the FileReader() and uses the onload function to do our bidding.
	});
		$('#Image').on('change', function(event) {
		
		var image = this.files[0]; 

		
		$('#imagePreview').html(''); 

		var reader = new FileReader(); 
		reader.onload = function(e){ 
			$('<img src="' + e.target.result + '" class="thumbnail img-responsive" width="210"  alt="Loading..">').appendTo($('#imagePreview'));
			
		}
		reader.readAsDataURL(image); // this gives our file to the FileReader() and uses the onload function to do our bidding.
	});
});