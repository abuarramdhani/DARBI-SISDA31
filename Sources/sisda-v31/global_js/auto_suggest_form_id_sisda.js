function suggest(inputString){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#sisda_id').addClass('load');
		$.post("include/auto_suggest_id_sisda.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#sisda_id').removeClass('load');
			}
		});
	}
}

function fill(thisValue) {
	$('#sisda_id').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 0);
}