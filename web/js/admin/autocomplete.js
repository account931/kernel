//JQ autocomplete UI,(+ must include JQ_UI.js + JQ_UI.css in index.php)
$(document).ready(function(){
	
	//to make this script works only on SiteController/ViewOne
	if (typeof usersX === 'undefined') { 
	    //alert ('false');
		return false;
	}
	
	
	
	//array which will contain all products for autocomplete
	var arrayAutocomplete = [];
	
	
	//Loop through passed php object, object is echoed in JSON in Controller Product/action Shop
	for (var key in usersX) {
		arrayAutocomplete.push(  { label: usersX[key]['email'], value: usersX[key]['email'] }  ); //gets name of every user and form in this format to get and lable and value(Name & ID)

	}
	

	
    //Autocomplete itself
    $( function() {

		
		

	//connect autocomplete array to input
        $( "#userID" ).autocomplete({
            source: arrayAutocomplete   //source autocom array
        });
		
	
		
   } );
   
   
   
   


});