(function(){ //START IIFE (Immediately Invoked Function Expression)
$(document).ready(function(){
	
   
    //====================
    //click on invoice in admin/views/load-out-index.php
    $(document).on("click", '.invoice-one', function() {      //for newly generated 
	   runAjaxToGetInvoice(this);
	});
   
	   
    //=================
    function runAjaxToGetInvoice(context){
		//alert(context.getAttribute("data-invoic-id"));
		var ajax_url = urlX + "/index.php?r=admin/invoice-load-out/ajax_get_invoice";
		alert(ajax_url);
		
		// send  data  to  PHP handler  ************ 
        $.ajax({
            url: ajax_url,
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
			//passing the ID of invoice load out
            data: { 
			    serveInvoiceLoadOutID: context.getAttribute("data-invoic-id")
			},
            success: function(data) {
                // do something;
				console.log(data);
				//getAjaxAnswer_andBuild_6_month(data, idX); //data => return from php script //idX => id of clicked room
				//$(".loader").hide(3000); //hide the loader
				buildAnswer(data);
				scrollResults("#invoiceSelected", ".parent().");
				
            },  //end success
			error: function (error) {
				$("#invoiceSelected").stop().fadeOut("slow",function(){ $(this).html("Failed")}).fadeIn(2000);
				scrollResults("#invoiceSelected", ".parent().");
				//console.log(data);
            }	
        });
		
		
	}

	//======================
	//Build ajax success
    function buildAnswer(data){
		  var calendar =      
            '<br><input type="button" value="<<" id="prevDay" class="btn btn-success"/>' +
            '<input type="button" value=" Calendar" id="calendarPick" class="btn btn-danger"/>' +
            '<input type="button" value=">>" id="nextDay" class="btn btn-success"/>' +
            '<br><br>';
		
		  var textX = '<div class="col-sm-12 col-xs-12"><h3><center>Запит</center></h3> </div>' + 
		              '<div class="col-sm-12 col-xs-12  list-group-item header-color">' + 
		                 '<div class="col-sm-6 col-xs-6 word-breakX">Номер накладної</div>' + '<div class="col-sm-6 col-xs-6 word-breakX">' + data.invoiceLoadOut.invoice_unique_id + '</div>' +
						 '<div class="col-sm-6 col-xs-6 word-breakX">Користувач </div>'     + '<div class="col-sm-6 col-xs-6 word-breakX">' + data.invoiceLoadOut.user_id + '</div>' +
					  '</div>' +
					  calendar;
					  
		  $("#invoiceSelected").stop().fadeOut("slow",function(){ $(this).html(textX)}).fadeIn(2000);	
	}



    // Advanced Scroll the page to results  #resultFinal
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	function scrollResults(divName, parent)  //arg(DivID, levels to go up from DivID)  //scrollResults("#roomNumber", ".parent().");
	{   //if 2nd arg is not provided while calling the function with one arg
		if (typeof(parent)==='undefined') {
		
            $('html, body').animate({
                scrollTop: $(divName).offset().top
                //scrollTop: $('.your-class').offset().top
             }, 'slow'); 
		     // END Scroll the page to results
		} else {
			//if 2nd argument is provided
			var stringX = "$(divName)" + parent + "offset().top";  //i.e constructs -> $("#divID").parent().parent().offset().top
			$('html, body').animate({
                scrollTop: eval(stringX)         //eval is must-have, crashes without it
                }, 'slow'); 
		}
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	
	
	function scroll_toTop() 
	{
	    $("html, body").animate({ scrollTop: 0 }, "slow");	
	}
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************




	
	   
});
// end ready		
	
}()); //END IIFE (Immediately Invoked Function Expression)