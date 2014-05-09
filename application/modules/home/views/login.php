<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<form method="post" name="fb_login">
	<input type="hidden"  name="uid" id="uid"/>
	<input type="hidden"  name="email" id="email"/>
	<input type="hidden"  name="firstname" id="firstname"/>
	<input type="hidden"  name="lastname" id="lastname"/>
	<input type="hidden"  name="middlename" id="middlename"/>
	<input type="hidden" value="<?php echo $token; ?>" id="access_token"/>
</form>
<div id="test">
</div>
<script>
	$(document).ready(function(){
		var a = $('#access_token').val();
		$.ajax({
        url: "https://graph.facebook.com/me?access_token="+a,
        dataType: 'json',
        success: function(response) {
            jsonData = response;
			document.forms.fb_login.uid.value=response.id;
			document.forms.fb_login.email.value=response.email;
			document.forms.fb_login.firstname.value=response.first_name;
			document.forms.fb_login.lastname.value=response.last_name;
			document.forms.fb_login.middlename.value=response.middle_name;
			document.forms.fb_login.access_token.value=response.access_token;
			document.forms.fb_login.submit();
        	}
		});
		
		
	});
	
</script>