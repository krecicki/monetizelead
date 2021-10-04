<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-cloud"></span> API Integration
	</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li class="active">API Integration</li>
</ol>
<h1>Instructions</h1>
<div class="row">
<div class="col-md-12">
<ul>
	<li>Add &lt;script src="https://monetizelead.com/client/REPLACE WITH YOUR USERNAME/integration/choice.integration-min.js"&gt;&lt;script&gt; in the head section</li>
	<li><p>Add a javascript api_callback function in the head section your page. Notice the name it must be exactly api_callback with a single parameter. An example function is given below in the example section.</p>
	<p>NOTE: This api_callback function is only required if you want to do something after api call is complete.</p></li>
	<li>Use data-api attribute to your form fiels you want to submit. See the example section below for more details</li>
</ul>

<h1>Example</h1>
<p>
The API expects the following fields
<ol>
<li>apiKey</li>
<li>name</li>
<li>email</li>
<li>phone</li>
<li>zipcode</li>
<li>leadTypes</li>

</ol>
</p>
<p>
  For API to properly read values you must add data-api attribute to relavent fields.Also, make sure you add data-api='lead-gen' attribute to a button that will trigger the API call.
</p>
<p>
Add data-api='name' attribute to your name field.
</p>
<p>
Add data-api='email' attribute to your email field.
</p>
<p>
Add data-api='phone' attribute to your phone field.
</p>
<p>
Add data-api='zipcode' attribute to your zip code field.
</p>
<p>
Add a input type hidden field and use data-api='leadTypes' attribute and set value="COMMA SEPARATED LEAD TYPES".
</p>
<p>
Add a input type hidden field and use data-api='apiKey' attribute and set value="YOUR_API_KEY". Your key is ab3df-34fcf-34fab-9bc23-44af8
</p>
<p>
To redirect somewhere else after the user has submitted the form use the following code inside of api_callback function below. Use window.location.replace("http://www.google.com"); 
</p>
<p>
The following sample shows a real world example.
</p>
<pre>
&lt;html&gt;
	&lt;head&gt;	
		&lt;title>API Integration Sample&lt;/title&gt;
		&lt;script type="text/javascript" src="https://monetizelead.com/client/REPLACE WITH YOUR USERNAME/integration/choice.integration-min.js"&gt;&lt;/script&gt;
		&lt;script&gt;
			function api_callback(response)
			{
				$('#message').html("status:" + response.status + "&lt;br/&gt;" + "message: " + response.message);
				console.log(response);

			}
		&lt;/script&gt;
		&lt;style type="text/css"&gt;
			input[type='text']{
				width:50%;
			}
			span{width:200px;display:inline-block;}
		&lt;/style&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;form&gt;
			&lt;input data-api='apiKey' type="hidden" name="apiKey" value="ab3df-34fcf-34fab-9bc23-44af8"/&gt;
			&lt;p&gt;&lt;span&gt;Name:&lt;/span&gt;&lt;input type="text" data-api='name' name="name"/&gt;&lt;/p&gt;
			&lt;p&gt;&lt;span&gt;Email:&lt;/span&gt;&lt;input type="text" data-api='email' name="email"/&gt;&lt;/p&gt;
			&lt;p&gt;&lt;span&gt;Phone:&lt;/span&gt;&lt;input type="text" data-api='phone' name="phone"/&gt;&lt;/p&gt;
			&lt;p&gt;&lt;span&gt;ZipCode:&lt;/span&gt;&lt;input type="text" data-api='zipcode' name="zipcode"/&gt;&lt;/p&gt;				
			&lt;input type="hidden" data-api="leadTypes" value="LeadType1,LeadType2,LeadType3"/&gt;				
			&lt;input type="button" id="btn" data-api='lead-gen' value="Invoke API"/&gt;
			&lt;br/&gt;
			&lt;span id="message"&gt;&lt;/span&gt;
		&lt;/form&gt;	
	&lt;/body&gt;
&lt;/html&gt;
</pre>
</div>
</div>
</div>