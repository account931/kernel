(function(){ //START IIFE (Immediately Invoked Function Expression)
$(document).ready(function(){
   
   
	
    //on email click remove class of UNREAD message
   $(document).on("click", '.mail', function() { 
       $(this).removeClass("boldX");
   });	
	   
	   
});
// end ready	
}()); //END IIFE (Immediately Invoked Function Expression)