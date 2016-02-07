$(document).ready(function(){
    $.material.init();
   $('.dlt_task').bind('click',function (e) {
   var result=confirm("Are you sure you want to delete this task?");
    if (!result) {
    	e.preventDefault();
    }
       
    });

 


});