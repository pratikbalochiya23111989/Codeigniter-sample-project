 function check_email()
{	
	var email = $('#vEmail').val();
	if($.trim(email) !='')
	{
		var pattern = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
		var validpattern = pattern.test(email);
		if(!validpattern)
		{
			$('#err_email_area').show();
			$('#lblemailiderrmsg').html('Please enter your correct email id.');
			return 0;
		}
		else 
		{
			$('#err_email_area').hide();
			return 1;
		}
	}
	else
	{
		$('#err_email_area').show();
		$('#lblemailiderrmsg').html('Please enter your email id.');
		return 0;
	}
}
function check_password(){
	var password = $.trim($('#vPassword').val());
	var pattern =  /^[a-zA-Z0-9]{6,}$/;
	var validpattern = pattern.test(password);
	if(password != ''){
		if(!validpattern)   
		{   
			$('#err_password_area').show();
			$('#lblpassworderrmsg').html('Password must be greater than 6 alphanumeric characters.');
			return 0;
		}
		else {
			$('#err_password_area').hide();
			return 1;
		}
	}
	else {
		$('#err_password_area').show();
		$('#lblpassworderrmsg').html('Please enter your password.');
		return 0;
	}
}
function check_emapty_password(){
	var password = $.trim($('#vPassword').val());

	if(password != ''){
		$('#err_password_area').hide();
		return 1;
	}
	else {
		$('#err_password_area').show();
		$('#lblpassworderrmsg').html('Please enter your password.');
		return 0;
	}
}
function check_remember_me(){
	var checkbox_2 = $('#checkbox_2').val();
		
	if($.trim(checkbox_2).checked){
		$('#err_checkbox_area').hide();
		return 1;
	}
	else {
		$('#err_checkbox_area').show();
		$('#lblcheckBox').html('Please keep Me looged in.');
		return 0;
	}
}
function check_fname_validation() {
	var string = $('#vFirstName').val();
	if($.trim(string) != ''){
		var strRegex = new RegExp(/^[a-zA-Z()]+$/);
		var validstr = strRegex.test(string);
		if(!validstr){

			$('#err_fname_area').show();
			$('#lblfnameerrmsg').html('Please enter your correct firstname.');
			return 0;
		}
		else {
			$('#err_fname_area').hide();
			$('#lblfnameerrmsg').html('');
			return 1;
		}
	}
	else {
		$('#err_fname_area').show();
		$('#lblfnameerrmsg').html('Please enter your firstname.');
		return 0;
	}
}
function check_lname_validation() {	
	var string = $('#vLastName').val();
	if($.trim(string) != ''){
		var strRegex = new RegExp(/^[a-zA-Z()]+$/);
		var validstr = strRegex.test(string);
		if(!validstr){
			$('#err_lname_area').show();
			$('#lbllnameerrmsg').html('Please enter your correct lastname.');
			return 0;
		}
		else {
			$('#err_lname_area').hide();
			$('#lbllnameerrmsg').html('');
			return 1;
		}
	}
	else {
		$('#err_lname_area').show();
		$('#lbllnameerrmsg').html('Please enter your lastname.');
		return 0;
	}
}
function check_status(){
	var status = $('#eStatus').val();
	if($.trim(status) !=''){
		$('#err_status_area').hide();
		return 1;
	}
	else {
		$('#err_status_area').show();
		$('#lblstatuserrmsg').html('Please select your status.');
		return 0;
	}
}

function check_username_validation() {
	var string = $('#vUsername').val();
	if($.trim(string) != ''){
		var strRegex = new RegExp(/^[a-zA-Z. ()]+$/);
		var validstr = strRegex.test(string);
		if(!validstr){

			$('#err_uname_area').show();
			$('#lblunameerrmsg').html('Please enter correct username.');
			return 0;
		}
		else {
			if(string.length>=2 && string.length<=256)
			{
				$('#err_uname_area').hide();
				$('#lblunameerrmsg').html('');
				return 1;
			}
			else
			{
				$('#err_uname_area').show();
				$('#lblunameerrmsg').html('Username between 2 to 256 characters');
				return 0;
				
			}
		}
	}
	else {
		$('#err_uname_area').show();
		$('#lblunameerrmsg').html('Please enter username.');
		return 0;
	}
}
function check_category_validation() {	
	var string = $('#iCategoryId').val();
	if($.trim(string) != ''){
		$('#err_category_area').hide();
		$('#lblcategoryerrmsg').html('');
		return 1;
	
	}
	else {
		$('#err_category_area').show();
		$('#lblcategoryerrmsg').html('Please select category.');
		return 0;
	}
}
function check_voice_validation() {	
	var string = $('#iVoiceId').val();
	if((string) != ''){
		$('#err_voice_area').hide();
		$('#lblvoiceerrmsg').html('');
		return 1;
	
	}
	else {
		$('#err_voice_area').show();
		$('#lblvoiceerrmsg').html('Please select voice.');
		return 0;
	}
}
function check_title_validation() {	
	var string = $('#tTitle').val();
	if($.trim(string) != ''){
		var strRegex = new RegExp(/^[a-zA-Z0-9_ -&]*$/);
		
		var validstr = strRegex.test(string);
		if(!validstr){
			$('#err_title_area').show();
			$('#lbltitleerrmsg').html('Please enter correct Title name.');
			return 0;
		}
		else {
			if(string.length>=2 && string.length<=256)
			{
				$('#err_title_area').hide();
				$('#lbltitleerrmsg').html('');
				return 1;
			}
			else
			{
				$('#err_title_area').show();
				$('#lbltitleerrmsg').html('Title between 2 to 256 characters');
				return 0;
				
			}
		}
		
	}
	else { 
		$('#err_title_area').show();
		$('#lbltitleerrmsg').html('Please enter title.');
		return 0;
	}
}
function check_code_validation() {	
	var string = $('#vCode').val();
	if($.trim(string) != ''){
		$('#err_code_area').hide();
		$('#lblcodeerrmsg').html('');
		return 1;
	
	}
	else {
		$('#err_code_area').show();
		$('#lblcodeerrmsg').html('Please enter code.');
		return 0;
	}
}
function check_description(){
	var editorData = CKEDITOR.instances.tContent.getData();
	if($.trim(editorData)!=''){
		$('#tContent').removeClass('inputbordererr');
		$('#err_description_area').hide();
		return 1;
	}
	else {
		$('#tContent').addClass('inputbordererr');
		$('#lbldescriptionerrmsg').html('Please enter description.');
		$('#err_description_area').show();
		return 0;
	}	
}
function check_validsound(status)
{
	var a = $.trim(status.substring(status.lastIndexOf('.') + 1).toLowerCase());
	if(a == 'mp3'  ||a == 'MP3' ||a == 'm4a' ||a == 'M4A' ||a == 'wave' ||a == 'WAVE'){
        $('.msgformat1').hide();
		$('#err_sound_area').hide();
        return 1;
   		}
    else{
    	if(a=='')
    	{
    		$('#err_sound_area').show();
	       	$('#lblsounderrmsg').html('Please select sound file.');
	       	return 0;
    	}
    	else
    	{
    		$('.msgformat1').show();
	    	$('#err_sound_area').show();
	       	$('#lblsounderrmsg').html('Please select valid sound file.');
			return 0;
    	}
   	}
}
function checkValidImage(status)
{	
	var id=document.getElementById(status);
	var val =id.value;
	var a = $.trim(val.substring(val.lastIndexOf('.') + 1).toLowerCase());

	if(a == 'jpg'  ||a == 'JPG' ||a == 'jpeg' ||a == 'JPEG' ||a == 'png'){

	        var size = parseFloat(id.files[0].size/1024).toFixed(2);
	        if(size>6000)
	        {
	        	$('.msgformat1').show();
		    	$('#err_photo_area').show();
		       	$('#lblphotoerrmsg').html('Image size should not be greater than 6 MB');
				return 0;
	        }
		else
		{
			 $('.msgformat1').hide();
			$('#err_photo_area').hide();
			$('#lblphotoerrmsg').hide();    
	        return 1;
		}
       
	}
	else{
    	$('.msgformat1').show();
    	$('#err_photo_area').show();
       	$('#lblphotoerrmsg').html('Error while uploading.');
		return 0;
   	}
}

function check_image_validation() {	
	var string = $('#vIcon').val();
	if($.trim(string) != ''){
		$('#err_photo_area').hide();
		$('#lblphotoerrmsg').hide();    
        return 1;
	}
	else
	{
    	$('#err_photo_area').show();
       	$('#lblphotoerrmsg').html('Please select Icon.');
		return 0;
	}
}

function check_photo_validation() {	
	var string = $('#vPhoto').val();
	if($.trim(string) != ''){
		$('#err_vPhoto_area').hide();
		$('#lblvphotoerrmsg').hide();    
        return 1;
	}
	else
	{
    	$('#err_vPhoto_area').show();
       	$('#lblvphotoerrmsg').html('Please select Icon.');
		return 0;
	}
}