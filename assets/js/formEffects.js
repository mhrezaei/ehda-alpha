//requires JQuery, JQueryUI and BOOTSTRAP

//======================================================================================
function formEffect_errorIfEmpty(selector)
{
	if(!$(selector).val() || $(selector).val()=="0") {
		formEffect_markError(selector , "error");
		return 1;
	}
	else {
		formEffect_markError(selector , "success");
		return 0;
	}
}

//======================================================================================
function formEffect_errorIfLang(selector , lang)
{
	var isPersian = formEffect_isPersian($(selector).val()) ; 
	alert(isPersian);
	
	if(isPersian && lang!="fa"){
		formEffect_markError(selector , "error");
		return 1;
	}
	if(!isPersian && lang=="fa"){
		formEffect_markError(selector , "error");
		return 1;
	}
	else {
		formEffect_markError(selector , "success");
		return 0;
	}
}

//======================================================================================
function formEffect_isPersian(string)
{
	 var p=/@"^([\u0600-\u06FF]+\s?)+$"/;
	if(string.match(p))
		return true;
	else
		return false;
}

//======================================================================================
function formEffect_markError(selector , handle)
{
	if(handle=="success") 
		$(selector).parent().parent().addClass("has-success").removeClass('has-error');
	else if(handle=="null" || handle=="reset")
		$(selector).parent().parent().removeClass('has-error').removeClass('has-success');
	else //including "error"
		$(selector).parent().parent().addClass("has-error").removeClass('has-success');//.effect	("shake"	,{times:2},100);

}

//======================================================================================
function formEffect_autoDirection(selector)
{
	var $object    = $(selector) ;
	var $persChars = ['ا','آ','ب','پ','ت','س','ج','چ','ح','خ','د','ذ','ر','ز','ژ','س','ش','ص','ض','ط','ظ','ع','غ','ف','ق','ک','گ','ل','م','ن','و','ه','ی','ء','1','2','3','4','5','6','7','8','9','0',' '];
	var $isPersian = false ; 
	
	
	$object.on("keyup",function() {
		var $string    = $object.val() ;
		var $firstChar = $string.substr(0,1) ; 
		var $isPersian = false ; 
		var $i=0;

		if(!$string) {
			$object.attr("dir","rtl") ; 
			return;
		}
		
		
	    for ($i = 0 ; $i<45 ; $i++) {
	        if ($persChars[$i] == $firstChar) {
	            $isPersian = true;
				break ; 
	        }
	    }
		
		if($isPersian) {
			$object.attr("dir","rtl");
		}
		else 
			$object.attr("dir","ltr");
			
	});


}
