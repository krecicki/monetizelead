(function(){
	'use strict';
	if(!window.jQuery)
	{
	   var script = document.createElement('script');
	   script.type = "text/javascript";
	   script.src = "https://code.jquery.com/jquery-3.2.1.min.js";
	   document.getElementsByTagName('head')[0].appendChild(script);
	}
	//register window load event
	window.addEventListener('load', 
	  function() { 
		//jquery has been loaded
		//instruct users to use data-api-FIELD on variables
		//e.g data-api-name = name field
		var name = jQuery("[data-api='name']");
		var email = jQuery("[data-api='email']");
		var phone = jQuery("[data-api='phone']");
		var zipcode = jQuery("[data-api='zipcode']");	
		var apikey = jQuery("[data-api='apiKey']");	
		var lead_types = jQuery("[data-api='leadTypes']");
		var btn = jQuery("[data-api='lead-gen']");

		if(btn)
		{
			btn.click(function(){
				event.preventDefault();
				event.stopImmediatePropagation();
				var data = {
						action: 'lead_gen', 
						leadData: {'apiKey': apikey.val(),'name':name.val(),'email':email.val(),'phone':phone.val(),'zipcode':				zipcode.val(),'lead_types':lead_types.val()}
							
						}; 

						console.log(data);
						//var endpoint = '../api/lead_gen';
						var endpoint = 'http://monetizelead.com/client/{USERNAME}/api/lead_gen';
						jQuery.post(endpoint,data, function(response) {
							console.log(response);
							if(api_callback)
								api_callback(response);
							else
								alert(response.status);						
						}, "json");
			});
				
		}
			
	  }, false);
	  
})();
